# Tema — `irenilson-barbosa-v2`

Classic PHP Theme. Baseado no layout do Elite Notícias.

## Estrutura

```
irenilson-barbosa-v2/
├── assets/
│   ├── ib.css              ← Estilos completos do tema
│   ├── ib.js               ← Comportamento (menu, busca, scroll)
│   └── ib-admin.js         ← Admin (seletor de mídia)
├── inc/
│   ├── template-tags.php   ← Helpers (cards, share, breadcrumb)
│   └── admin-settings.php  ← Central do Site (admin page)
├── template-parts/
├── front-page.php          ← Home (hero + seções por categoria)
├── single.php              ← Post (leitura + Facebook Comments)
├── archive.php             ← Listagens
├── page.php                ← Páginas estáticas
├── search.php              ← Busca
├── 404.php                 ← Página não encontrada
├── header.php              ← Topbar + nav + Facebook SDK
├── footer.php              ← Rodapé
├── sidebar.php             ← Sidebar (sobre + recentes)
├── functions.php           ← Setup do tema
└── style.css               ← Metadados do tema
```

## Templates principais

### front-page.php — Home (revista)
1. Hero: lead (imagem full + overlay) + 3 cards secundários (grid 2fr 1fr 1fr)
2. Strip "Mais recentes" com 3 links numerados
3. Seções por categoria (Filosofia, Educação, Política, Cultura, Cotidiano)
4. Seções de Publicações e Livros
5. Sidebar

### single.php — Leitura
- Breadcrumb, categoria, título, meta (autor, data, tempo de leitura)
- Imagem de destaque, share buttons, conteúdo
- Tags, Leia também (mesma categoria), Facebook Comments (se configurado)

## Central do Site

Admin page em `/wp-admin/admin.php?page=ib-ajustes`:
- Redes sociais
- Biografia da sidebar
- Textos do rodapé
- Fontes (títulos + corpo)
- Facebook App ID
