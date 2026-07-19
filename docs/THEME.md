# Tema — `irenilson-barbosa`

Block Theme (Full Site Editing) — WordPress 7.0+

## Estrutura

```
irenilson-barbosa/
├── assets/
│   └── css/
│       └── editor.css         ← Estilos do editor de blocos
├── parts/
│   ├── header.html            ← Cabeçalho (logo + nav)
│   └── footer.html            ← Rodapé (créditos + links)
├── patterns/                  ← Padrões de bloco do tema
├── styles/                    ← Variações de estilo (opcional)
├── templates/
│   ├── home.html              ← Home magazine
│   ├── single.html            ← Post de leitura
│   ├── page.html              ← Página estática
│   ├── archive.html           ← Listagem de posts
│   ├── search.html            ← Resultados de busca
│   ├── 404.html               ← Página não encontrada
│   └── index.html             ← Fallback geral
├── functions.php              ← Setup do tema
├── style.css                  ← Header do tema
├── theme.json                 ← Config de design system
└── screenshot.png             ← Preview (1200x900px)
```

## Templates

### home.html — Revista

Layout em seções:
1. **Hero** — Post em destaque (imagem larga + título + resumo)
2. **Grid Destaques** — 3 cards lado a lado
3. **Lista de Últimos Artigos** — Timeline vertical com imagem à esquerda
4. **Grid Secundário** — 3 cards no final

### single.html — Leitura

Layout otimizado:
- Largura de conteúdo: ~700px (`contentSize` no `theme.json`)
- Breadcrumb com categoria + metadados
- Citações com borda verde
- Author box ao final
- Artigos relacionados

## Design Tokens (theme.json)

Ver `docs/COLORS.md` para a paleta completa. Os tokens são definidos no `theme.json` sob `settings.color.palette` e reutilizados nos templates via `var:preset|color|{slug}`.

## Funcionalidades do functions.php

- Registrar menus de navegação (`primary`, `social`)
- Suporte a logo personalizado
- Carregar Google Fonts (Literata + Inter)
- Carregar `editor.css`
- Remover estilos core não utilizados
