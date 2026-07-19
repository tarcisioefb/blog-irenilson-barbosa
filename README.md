# Blog Irenilson Barbosa

Portal editorial com foco em ensaios, pensamento contemporâneo e publicações acadêmicas.

**Autor:** Irenilson Barbosa — professor universitário, escritor e pesquisador.
**Stack:** WordPress 7.0 · PHP 8.2 · MySQL 8.4 · Nginx · Local WP

## Estrutura

```
├── app/public/wp-content/
│   ├── themes/irenilson-barbosa-v2/   ← Tema ativo
│   └── plugins/irenilson-barbosa-core/ ← CPTs, taxonomias, metadados
├── conf/               ← Configurações Nginx, PHP, MySQL
├── docs/               ← Documentação do projeto
└── *.php / *.py        ← Scripts de importação e manutenção
```

## Seções do site

| Seção | Post Type | Descrição |
|-------|-----------|----------|
| Artigos | `post` | Ensaios, reflexões, crônicas |
| Publicações | `publicacao` | Artigos acadêmicos, capítulos |
| Livros | `livro` | Obras com links de afiliado |
| Materiais | `material` | Downloads para alunos |

## Personalização

Acesse `/wp-admin/admin.php?page=ib-ajustes` para configurar:
- Redes sociais
- Biografia da sidebar
- Fontes (títulos e corpo, via Google Fonts)
- Facebook App ID (para comentários)
- Textos do rodapé

## Scripts úteis

```bash
# Importar posts do Blogger
python3 import-blogger.py

# Baixar imagens contextuais (Pexels)
wp eval-file pexels-images.php
```
