#!/usr/bin/env python3
"""
Importador do Blogger (poiesisdoire.blogspot.com) para WordPress.

1. Crawleia todo o Atom feed (paginação automática)
2. Sanitiza HTML (remove estilos inline, classes do Blogger, tracking)
3. Classifica cada post no modelo de conteúdo do portal:
   - post (Artigo) → categorias: Filosofia, Educação, Política, Cultura, Cotidiano
   - publicacao (Publicação Acadêmica) → tipo: artigo-periodico, capitulo-livro, etc.
   - livro (Livro) → participação: autor, organizador, coautor
   - material (Material didático)
4. Gera um arquivo JSON com todos os posts limpos e classificados
5. Importa via WP-CLI para o WordPress

Uso:
    python3 import-blogger.py                    # só gera o JSON
    python3 import-blogger.py --import            # gera JSON + importa via WP-CLI
"""

import argparse
import json
import os
import re
import sys
import time
import urllib.request
import xml.etree.ElementTree as ET
from datetime import datetime
from html.parser import HTMLParser

BLOG_FEED = "https://poiesisdoire.blogspot.com/feeds/posts/default"
OUTPUT_JSON = os.path.join(os.path.dirname(__file__), "blogger-export.json")
A = "{http://www.w3.org/2005/Atom}"


def fetch_all_entries():
    """Busca todos os posts do Blogger via Atom feed com paginação."""
    entries = []
    start_index = 1
    page_size = 100

    while True:
        url = f"{BLOG_FEED}?max-results={page_size}&start-index={start_index}"
        print(f"  Fetching: start-index={start_index}...")
        try:
            resp = urllib.request.urlopen(url, timeout=30)
            data = resp.read()
        except Exception as e:
            print(f"  Error: {e}")
            break

        root = ET.fromstring(data)
        page_entries = root.findall(f"{A}entry")

        if not page_entries:
            break

        entries.extend(page_entries)
        print(f"    Got {len(page_entries)} entries (total: {len(entries)})")

        if len(page_entries) < page_size:
            break

        start_index += page_size
        time.sleep(0.5)  # rate limiting

    return entries


def clean_html(raw_html):
    """Remove markup do Blogger e normaliza o HTML."""
    if not raw_html:
        return ""

    # Remove tracking pixels: <img ... width="1" ...>
    raw_html = re.sub(
        r'<img[^>]*?width\s*=\s*["\']1["\'][^>]*?/?\s*>', "", raw_html, flags=re.I
    )
    # Remove <script> e <style>
    raw_html = re.sub(r"<script[^>]*>.*?</script>", "", raw_html, flags=re.S | re.I)
    raw_html = re.sub(r"<style[^>]*>.*?</style>", "", raw_html, flags=re.S | re.I)
    # Remove style="" inline
    raw_html = re.sub(r'\sstyle="[^"]*"', "", raw_html)
    # Remove classes específicas do Blogger
    raw_html = re.sub(r'\sclass="[^"]*?(?:blogger|separator|MsoNormal)[^"]*?"', "", raw_html, flags=re.I)
    # Remove divs .separator vazios
    raw_html = re.sub(r'<div[^>]*separator[^>]*>\s*</div>', "", raw_html, flags=re.I)
    # Remove tags <div> e </div> solitárias que sobraram de separators
    raw_html = re.sub(r'<div[^>]*>\s*</div>', "", raw_html, flags=re.I)
    # Normaliza parágrafos quebrantados pelo Blogger
    raw_html = re.sub(r"</p>\s*<p[^>]*>", "\n\n", raw_html)
    # Remove &nbsp;
    raw_html = raw_html.replace("&nbsp;", " ")
    # Limpa whitespace
    raw_html = re.sub(r"[ \t]+", " ", raw_html)
    raw_html = re.sub(r"\n\s*\n", "\n\n", raw_html)
    raw_html = raw_html.strip()
    return raw_html


def extract_first_image(html_content):
    """Extrai URL da primeira imagem do conteúdo."""
    match = re.search(r'<img[^>]+src=["\']([^"\']+)["\']', html_content)
    if match:
        return match.group(1)
    return ""


def classify_post(title, content, published_year):
    """
    Classifica o post em um dos tipos de conteúdo do portal.
    Retorna (post_type, taxonomy_term, category_slug).
    """
    text = (title + " " + content[:2000]).lower()

    # --- LIVRO ---
    livro_keywords = [
        "adquira", "clube de autores", "amazon", "compre o livro",
        "adquirir o livro", "lançamento", "obra disponível",
        "exemplar", "livro impresso", "e-book", "ebook",
        "o homem que não sabia ser santo",
    ]
    if any(w in text for w in livro_keywords):
        if "organizador" in text or "organizada" in text:
            return ("livro", "organizador", None)
        elif "coautor" in text or "participa" in text:
            return ("livro", "coautor", None)
        else:
            return ("livro", "autor", None)

    # --- MATERIAL ---
    material_keywords = [
        "download", "baixe aqui", "material didático", "apostila",
        "plano de ensino", "slide", "exercício", "gabarito",
        "pdf", "arquivo para download",
    ]
    if any(w in text for w in material_keywords):
        tipo = "apostila"
        if "slide" in text or "apresentação" in text:
            tipo = "slide"
        elif "exercício" in text or "lista" in text:
            tipo = "exercicio"
        elif "plano de ensino" in text:
            tipo = "plano-ensino"
        return ("material", tipo, None)

    # --- PUBLICAÇÃO ACADÊMICA ---
    pub_keywords = [
        "publicado", "artigo", "periódico", "doi", "issn",
        "publicação", "revista acadêmica", "capítulo de livro",
        "trabalho apresentado", "anais", "evento científico",
        "seminário de pesquisa", "congresso",
    ]
    # Se parecer muito acadêmico (citações, referências, notas de rodapé)
    academic_patterns = [
        r"\([\w\s]+,\s*\d{4}\)",  # (Autor, ano) citação
        r"refer[eê]ncia", r"notas?", r"bibliografia",
        r"abstract", r"palavras?-chave",
    ]
    is_academic = any(w in text for w in pub_keywords) or any(
        re.search(p, text) for p in academic_patterns
    )

    if is_academic:
        if "tese" in text or "dissertação" in text:
            return ("publicacao", "tese-dissertacao", None)
        elif "resenha" in text:
            return ("publicacao", "resenha-academica", None)
        elif "verbete" in text:
            return ("publicacao", "verbete", None)
        elif "capítulo" in text:
            return ("publicacao", "capitulo-livro", None)
        else:
            return ("publicacao", "artigo-periodico", None)

    # --- ARTIGO (post normal) ---
    # Determinar categoria
    cat_map = {
        "filosofia": ["filosofia", "filósofo", "ética", "existência", "ser", "pensamento"],
        "educacao": ["educação", "ensino", "professor", "aluno", "escola", "pedagogia", "aprendizagem", "ufrb", "universidade"],
        "politica": ["política", "governo", "eleição", "democracia", "presidente", "partido", "estado", "direita", "esquerda"],
        "cultura": ["cultura", "arte", "literatura", "música", "cinema", "teatro", "livro", "leitura"],
        "cotidiano": ["cotidiano", "crônica", "reflexão", "vida", "pessoal", "relato"],
    }

    # Pontuação por categoria
    scores = {}
    for cat, keywords in cat_map.items():
        score = sum(1 for kw in keywords if kw in text)
        if score > 0:
            scores[cat] = score

    if scores:
        best_cat = max(scores, key=scores.get)
    else:
        best_cat = "cultura"  # fallback

    # Se menciona religião explicitamente, vai para filosofia ou cultura
    if any(w in text for w in ["bíblia", "cristão", "igreja", "deus", "fé"]):
        if "filosofia" not in scores:
            best_cat = "filosofia"

    return ("post", None, best_cat)


def extract_year(published_text):
    if published_text:
        return published_text[:4]
    return "2026"


def parse_entry(entry):
    """Parseia uma entry do Atom e retorna um dict padronizado."""
    title_el = entry.find(f"{A}title")
    title = title_el.text.strip() if title_el is not None and title_el.text else "(Sem título)"
    title = re.sub(r"\s+", " ", title)

    published_el = entry.find(f"{A}published")
    published = published_el.text if published_el is not None else ""

    updated_el = entry.find(f"{A}updated")
    updated = updated_el.text if updated_el is not None else published

    content_el = entry.find(f"{A}content")
    raw_content = content_el.text if content_el is not None and content_el.text else ""

    # Links (alternate)
    link_el = entry.find(f'{A}link[@rel="alternate"]')
    permalink = link_el.get("href") if link_el is not None else ""

    # Author
    author_el = entry.find(f"{A}author")
    author_name = ""
    if author_el is not None:
        name_el = author_el.find(f"{A}name")
        if name_el is not None and name_el.text:
            author_name = name_el.text

    # Labels/categories
    labels = [
        cat.get("term")
        for cat in entry.findall(f"{A}category")
        if cat.get("term")
    ]

    # Clean content
    clean = clean_html(raw_content)
    first_image = extract_first_image(raw_content)

    # Classification
    year = extract_year(published)
    post_type, tax_term, category = classify_post(title, raw_content, year)

    # Generate excerpt
    excerpt = re.sub(r"<[^>]+>", "", clean)[:300].strip()
    if len(excerpt) >= 300:
        excerpt = excerpt[:297] + "..."

    return {
        "title": title,
        "slug": "",
        "content": clean,
        "excerpt": excerpt,
        "date": published,
        "updated": updated,
        "permalink": permalink,
        "author": author_name,
        "labels": labels,
        "image": first_image,
        "post_type": post_type,
        "taxonomy_term": tax_term,
        "category": category,
        "year": year,
    }


def generate_wp_cli_commands(posts):
    """Gera um script bash com comandos WP-CLI para importar os posts."""
    lines = [
        "#!/bin/bash",
        "# Script gerado pelo import-blogger.py",
        "# Execute: bash import-wp.sh",
        "",
        'WP="/Applications/Local.app/Contents/Resources/extraResources/bin/wp-cli/posix/wp"',
        'export MYSQL_HOME="/Users/tarcisio/Library/Application Support/Local/run/ZbAP20zeY/conf/mysql"',
        'export PHPRC="/Users/tarcisio/Library/Application Support/Local/run/ZbAP20zeY/conf/php"',
        'export PATH="/Users/tarcisio/Library/Application Support/Local/lightning-services/mysql-8.4.0/bin/darwin-arm64/bin:$PATH"',
        'export PATH="/Users/tarcisio/Library/Application Support/Local/lightning-services/php-8.2.29+0/bin/darwin-arm64/bin:$PATH"',
        "",
        'echo "Importando posts..."',
        "",
    ]

    count = {"post": 0, "publicacao": 0, "livro": 0, "material": 0}

    for i, post in enumerate(posts):
        pt = post["post_type"]
        count[pt] = count.get(pt, 0) + 1

        # Sanitize title for WP-CLI
        safe_title = post["title"].replace('"', '\\"')

        # Build content (escape single quotes for shell)
        content = post["content"]
        # Save content to a temp file to avoid shell escaping issues
        content_file = f"/tmp/wp-post-{i}.html"
        with open(content_file, "w") as f:
            f.write(content)

        post_type_arg = pt
        status = "publish"

        cmd = f'$WP post create --post_type="{post_type_arg}" --post_title="{safe_title}" --post_status="{status}" --post_content="$(cat {content_file})"'

        # Set date
        if post["date"]:
            cmd += f' --post_date="{post["date"]}"'

        # Set excerpt
        if post["excerpt"]:
            safe_excerpt = post["excerpt"].replace('"', '\\"')
            cmd += f' --post_excerpt="{safe_excerpt}"'

        # Set category (for posts)
        if pt == "post" and post["category"]:
            cmd += f' --post_category=\'{post["category"]}\''

        short_title = post["title"][:50]
        lines.append(f"echo '  [{i+1}/{len(posts)}] {pt}: {short_title}...'")
        lines.append(cmd)
        lines.append(f"rm -f {content_file}")
        lines.append("")

    lines.append('echo ""')
    lines.append(f'echo "Resumo: {count["post"]} artigos, {count["publicacao"]} publicações, {count["livro"]} livros, {count["material"]} materiais"')
    lines.append(f'echo "Total: {len(posts)} posts"')

    return "\n".join(lines)


def write_json(posts, filepath):
    """Salva os posts processados em JSON."""
    data = {
        "source": "https://poiesisdoire.blogspot.com",
        "exported_at": datetime.now().isoformat(),
        "total": len(posts),
        "posts": posts,
    }
    with open(filepath, "w", encoding="utf-8") as f:
        json.dump(data, f, ensure_ascii=False, indent=2)
    print(f"\nJSON salvo em: {filepath}")


def main():
    parser = argparse.ArgumentParser(description="Importa posts do Blogger para WordPress")
    parser.add_argument("--import", action="store_true", dest="do_import",
                        help="Importa para o WordPress via WP-CLI após gerar o JSON")
    args = parser.parse_args()

    print("=" * 60)
    print("Importador Blogger → Irenilson Barbosa")
    print("=" * 60)

    print("\n1. Buscando posts do Atom feed...")
    entries = fetch_all_entries()
    print(f"   Total de entries: {len(entries)}")

    print("\n2. Processando e classificando posts...")
    posts = []
    for entry in entries:
        post = parse_entry(entry)
        posts.append(post)

    # Summary
    pt_counts = {}
    cat_counts = {}
    for p in posts:
        pt = p["post_type"]
        pt_counts[pt] = pt_counts.get(pt, 0) + 1
        if p["category"]:
            cat_counts[p["category"]] = cat_counts.get(p["category"], 0) + 1

    print(f"\n   Classificação:")
    for pt, count in sorted(pt_counts.items()):
        print(f"     {pt}: {count}")
    if cat_counts:
        print(f"   Categorias (artigos):")
        for cat, count in sorted(cat_counts.items()):
            print(f"     {cat}: {count}")

    # Write JSON
    write_json(posts, OUTPUT_JSON)

    # Generate WP-CLI script
    wp_script = os.path.join(os.path.dirname(__file__), "import-wp.sh")
    script_content = generate_wp_cli_commands(posts)
    with open(wp_script, "w", encoding="utf-8") as f:
        f.write(script_content)
    os.chmod(wp_script, 0o755)
    print(f"Script WP-CLI gerado: {wp_script}")

    # Import if requested
    if args.do_import:
        print("\n3. Importando para WordPress...")
        import subprocess
        result = subprocess.run(["bash", wp_script], capture_output=False)
        if result.returncode == 0:
            print("\n✓ Importação concluída!")
        else:
            print(f"\n✗ Erro na importação (código: {result.returncode})")

    print("\n✓ Pronto!")


if __name__ == "__main__":
    main()
