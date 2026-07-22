=== Irenilson Barbosa Core ===
Contributors: zucatech
Tags: seo, lgpd, tts, newsletter, audit, security
Requires at least: 6.0
Tested up to: 7.0
Stable tag: 1.1.0
License: GPLv2 or later

Gerencia CPTs, SEO, LGPD, TTS, newsletter, audit log e segurança do portal editorial de Irenilson Barbosa.

== Description ==

Plugin funcionalidades do portal editorial — CPTs, taxonomias, metadados e componentes personalizados.

= Recursos =

== Custom Post Types ==
* **Livro** — obras do autor com taxonomia de participação (autor, organizador, coautor), ISBN, editora, páginas, ano, links de compra
* **Poiésis** — poemas com autor personalizável por poema, notas e excerpt
* **Publicação** — artigos acadêmicos com taxonomia tipo-de-publicacao
* **Material** — recursos educacionais para download, taxonomia tipo-de-material, URL do arquivo

== SEO ==
* Meta description e título personalizado por post (meta box lateral)
* Open Graph e Twitter Cards
* Schema: BlogPosting (posts), ScholarlyArticle (publicações), Article (poiesis/material), Book (livros)
* BreadcrumbList schema em todas as páginas
* WebSite + Person + Organization schema globais
* articleSection (categorias) e keywords (tags) no schema Article
* FAQ schema para posts com pergunta/resposta
* Sitemap nativo do WordPress com imagens via `wp_sitemaps_posts_entry`
* robots.txt dinâmico
* Título e description para arquivos, busca e 404

== LGPD ==
* Banner de cookies com opt-in/opt-out (localStorage)
* GA4 carregado apenas após consentimento
* Checkbox de consentimento no formulário de contato
* Política de privacidade (/privacidade/)
* Unsubscribe link na newsletter

== TTS (Text-to-Speech) ==
* Botão "Ouvir" em artigos, livros, publicações e materiais
* Leitura de título, autor, conteúdo e bio do autor
* Controles play/pause/stop
* Voz PT-BR automática
* Pausa entre seções (título, autor, corpo, notas, encerramento)

== Newsletter ==
* Cadastro via AJAX com validação
* Seleção manual de posts com preview (imagem, título, excerto)
* Envio HTML com CTA button
* Unsubscribe com confirmação amigável
* Lista de assinantes no admin
* Export CSV com BOM para Excel

== Segurança ==
* CSP: upgrade-insecure-requests (via LiteSpeed)
* HSTS: Strict-Transport-Security com max-age=31536000
* X-Frame-Options: SAMEORIGIN (anti-clickjacking)
* X-Content-Type-Options: nosniff
* Cross-Origin-Opener-Policy: same-origin
* XML-RPC desativado
* REST API restrita a autenticados (públicas: oembed, posts, pages, categories, tags, litespeed)
* Rate limit de login: 5 tentativas por IP/usuário em 15 min
* SMTP password criptografada (AES-256-CBC) no banco
* Tela de login personalizada com logo do site

== Auditoria (Audit Log) ==
* Registro de criação/edição/exclusão de posts
* Alterações em configurações
* Upload e exclusão de anexos
* Login, registro e atualização de perfil
* Filtros por ação e usuário
* Exportação CSV
* Visível apenas para administradores

== Imagens ==
* Geração automática de WebP e AVIF no upload (GD library)
* Fallback GD para AVIF (quando ImageMagick não suporta)
* Lazy loading com exceção para LCP (fetchpriority=high)
* Image sizes: ib-card (640x400), ib-thumb (220x150), ib-book-thumb (150x225)
* Wordpress CLI: `wp ib-convert`, `wp ib-thumb-avif`

== Admin ==
* Menu "Irenilson Barbosa" com abas: Geral, Home, Conteúdo, Aparência
* Categorias em destaque na home com ordenação drag-and-drop + botões ▲▼
* Submenu "Newsletter" com envio manual
* Submenu "Logs" (audit log) com filtros e export CSV
* Submenu "Tutoriais" com guias de publicação
* Dashboard widget com atalhos de criação
* Botão "Limpar cache" (LiteSpeed purge) na admin bar
* Botão "Reindexar Google" (ping sitemap) na admin bar
* Editor role: acesso a configurações, logs e tutoriais
* Profile do editor simplificado (sem cor do admin, atalhos, website)

== Tabela de Conteúdos (ToC) ==
* Extração automática de H2/H3 do artigo
* Índice collapsível entre o TTS e o conteúdo
* Links âncora com IDs automáticos
* Só aparece se houver 2+ headings

== Cache ==
* Botão de purge (LiteSpeed) na admin bar
* TTL do navegador: 0 (revalidação via ETag)
* Cache-Control via LiteSpeed

== Installation ==

1. Faça upload da pasta `irenilson-barbosa-core` para `/wp-content/plugins/`
2. Ative o plugin em "Plugins"
3. Configure em "Irenilson Barbosa" no menu admin

== Changelog ==

= 1.1.0 =
* SEO: BlogPosting schema, sameAs dinâmico, articleSection + keywords, image sitemap, FAQ schema
* ToC: tabela de conteúdos collapsível com links âncora
* Segurança: CSP, HSTS, XFO, COOP, REST restrita, rate limit login, SMTP criptografado
* Audit log com export CSV
* Tema: data BR nos metas, nowrap, sem separadores mobile
* Cache: TTL navegador 0 com revalidação ETag
* Imagens: fallback GD para AVIF, CLI wp ib-thumb-avif
* RSS feed com thumbnail
* Meta description automática no save

= 1.0.0 =
* Versão inicial
