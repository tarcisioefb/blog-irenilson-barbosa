# Sistema de Cores

## Filosofia

A paleta foi construída a partir das cores-base fornecidas, expandidas em shades (10 níveis cada) para criar um sistema coeso e funcional. O objetivo é transmitir **autoridade intelectual, serenidade e profundidade**, com um fundo quente que convida à leitura prolongada.

## Paleta Principal

### Marrom — Texto, Títulos, Elementos Primários
*Autoridade, solidez, aquecimento visual*

| Nível | HEX | Uso |
|-------|-----|-----|
| 50 | `#F5EFE6` | Fundo de hover em itens claros |
| 100 | `#E4D9C8` | Bordas sutis, separadores |
| 200 | `#D0C0A6` | Bordas, regras horizontais |
| 300 | `#B8A483` | Elementos decorativos |
| 400 | `#9E8A68` | Texto muted, placeholders |
| 500 | `#85704D` | Texto terciário, metadados |
| 600 | `#6D5940` | **Texto secundário** — corpo, resumos |
| 700 | `#584632` | Subtítulos, navegação |
| 800 | `#3E2C1B` | **Texto principal** — títulos, headings |
| 900 | `#2C1E11` | Hover de botões, máximos contrastes |

### Verde Militar — Accent, Links, Interativos
*Crescimento, conhecimento, sofisticação*

| Nível | HEX | Uso |
|-------|-----|-----|
| 50 | `#EDF2E8` | Fundo de tags, badges |
| 100 | `#D4DEC8` | Hover em tags, bordas decorativas |
| 200 | `#B5C6A2` | Elementos decorativos secundários |
| 300 | `#95AB7C` | Ícones, bullets |
| 400 | `#7A9360` | Texto de accent |
| 500 | `#6B7F5E` | Links hover, accent secundário |
| 600 | `#5C6E4C` | Links, accent primário |
| 700 | `#4A5D3E` | **Accent principal** — CTAs, links, bordas ativas |
| 800 | `#3B4A30` | Hover de accent |
| 900 | `#2C3823` | Máximo contraste verde |

### Bege — Backgrounds, Superfícies
*Conforto visual, leitura prolongada, sensação de papel*

| Nível | HEX | Uso |
|-------|-----|-----|
| 50 | `#FCFAF5` | Superfície de cards, sidebar |
| 100 | `#F5F0E8` | **Background da página** |
| 200 | `#EDE5D8` | Background alternativo, seções |
| 300 | `#E0D5C3` | **Bordas, divisores** |
| 400 | `#D0C0A8` | Elementos decorativos sutis |
| 500 | `#BFA88A` | Bege médio (elementos inativos) |
| 600 | `#A88D6D` | Bege escuro decorativo |
| 700 | `#8B7355` | — |
| 800 | `#6D5940` | — |
| 900 | `#503F2B` | — |

### Branco — Cards, Overlays, Destaques
*Pureza, destaque, respiro visual*

| Nível | HEX | Uso |
|-------|-----|-----|
| Base | `#FFFFFF` | Fundo de cards, modais, áreas de destaque |

## Mapeamento de Papéis (Design Tokens)

```
--bg-page:           bege-100  (#F5F0E8)
--bg-surface:        branco    (#FFFFFF)
--bg-surface-alt:    bege-50   (#FCFAF5)
--bg-section:        bege-200  (#EDE5D8)
--bg-tag:            verde-50  (#EDF2E8)

--text-primary:      marrom-800 (#3E2C1B)
--text-secondary:    marrom-600 (#6D5940)
--text-muted:        marrom-400 (#9E8A68)
--text-inverse:      branco    (#FFFFFF)

--accent-primary:    verde-700  (#4A5D3E)
--accent-hover:      verde-900  (#2C3823)
--accent-secondary:  verde-500  (#6B7F5E)
--accent-light:      verde-100  (#D4DEC8)

--border:            bege-300   (#E0D5C3)
--border-light:      marrom-100 (#E4D9C8)
--border-focus:      verde-700  (#4A5D3E)

--btn-primary-bg:         marrom-800 (#3E2C1B)
--btn-primary-text:       branco    (#FFFFFF)
--btn-primary-hover-bg:   marrom-900 (#2C1E11)
--btn-secondary-border:   marrom-300 (#B8A483)
--btn-secondary-text:     marrom-800 (#3E2C1B)
```

## Proporções de Uso

| Elemento | Cor |
|----------|-----|
| Background da página | bege-100 |
| Cards de post | branco |
| Cabeçalho | bege-100 com borda marrom-100 |
| Footer | marrom-800 com texto branco |
| Títulos | marrom-800 |
| Corpo do texto | marrom-600 |
| Links no texto | verde-600, hover verde-800 |
| Tags/Categorias | bg: verde-50, texto: verde-700 |
| Botão primário | bg: marrom-800, texto: branco |
| Botão secundário | border: marrom-300, texto: marrom-800 |
| Separadores | bege-300 |
| Citações em destaque | borda esquerda verde-700, bg bege-50 |

## Acessibilidade

Todos os pares de contraste respeitam WCAG AA:

- `marrom-800` sobre `bege-100` → ratio ~8.5:1 (AAA)
- `marrom-600` sobre `bege-100` → ratio ~5.2:1 (AA)
- `branco` sobre `marrom-800` → ratio ~9.8:1 (AAA)
- `verde-700` sobre `bege-100` → ratio ~4.8:1 (AA)
- `verde-700` sobre `branco` → ratio ~5.5:1 (AA)
