# Plano de Desenvolvimento — Portal Editorial Irenilson Barbosa

**WordPress 7.0.2** | **PHP 8.2** | **MySQL 8.4** | **Nginx**

---

## 1. Arquitetura do Projeto

```
wp-content/
├── themes/
│   └── irenilson-barbosa/       ← Tema personalizado (block theme)
│       ├── assets/
│       │   ├── css/
│       │   │   └── editor.css
│       │   └── fonts/           (opcional, se usar fontes locais)
│       ├── parts/
│       │   ├── header.html
│       │   ├── footer.html
│       │   └── sidebar.html
│       ├── patterns/            (padrões reutilizáveis do tema)
│       ├── styles/              (variações de estilo)
│       ├── templates/
│       │   ├── home.html        ← Home principal (revista)
│       │   ├── single.html      ← Post individual (leitura)
│       │   ├── page.html
│       │   ├── archive.html
│       │   ├── search.html
│       │   ├── 404.html
│       │   └── index.html       ← fallback
│       ├── functions.php
│       ├── style.css
│       ├── theme.json           ← Paleta, tipografia, presets
│       └── screenshot.png
│
├── plugins/
│   ├── index.php
│   └── irenilson-barbosa-core/  ← Plugin de funcionalidades
│       ├── irenilson-barbosa-core.php
│       ├── includes/
│       │   ├── class-setup.php       (CPTs, taxonomias)
│       │   ├── class-magazine.php    (destaques, grids)
│       │   └── class-reading.php     (tempo de leitura, metadados)
│       └── assets/
```

---

## 2. Tema: `irenilson-barbosa`

### 2.1 Identidade Visual

**Paleta de cores:**

| Cor | Uso | HEX |
|-----|-----|-----|
| Marrom escuro | Títulos, texto principal, footer | `#3E2C1B` |
| Marrom claro | Bordas, separadores, subtítulos | `#8B7355` |
| Bege | Fundo principal da página | `#F5F0E8` |
| Bege claro | Fundo de cards, sidebar | `#FAF7F2` |
| Verde militar | Detalhes, links, accent | `#4A5D3E` |
| Verde oliva | Hover, tags, elementos secundários | `#6B7F5E` |
| Branco | Fundo de destaque, overlays | `#FFFFFF` |

**Tipografia:**
- Títulos: **Literata** ou **Source Serif 4** (Google Fonts) — serifada para autoridade
- Corpo: **Inter** ou **Source Sans 3** — limpa e legível para leitura digital
- Ou usar uma única família tipográfica com pesos variáveis (ex: **IBM Plex Serif**)

**Sensação visual:**
- Fundo bege quente (não branco puro) para leitura confortável
- Espaçamento generoso (rhythm vertical amplo)
- Sem elementos religiosos ou institucionais
- Minimalismo editorial com acentos na cor verde militar

### 2.2 Layout da Home (Revista)

```
┌─────────────────────────────────────────────────┐
│  HEADER (logo, navegação minimalista)            │
├─────────────────────────────────────────────────┤
│                                                   │
│  ★ HERO — Destaque principal (full-width)         │
│    Imagem grande | Título | Resumo | Categoria    │
│                                                   │
│  ┌─────────────┐ ┌─────────────┐ ┌─────────────┐ │
│  │ Card 1      │ │ Card 2      │ │ Card 3      │ │
│  │ (destaque)  │ │ (destaque)  │ │ (destaque)  │ │
│  └─────────────┘ └─────────────┘ └─────────────┘ │
│                                                   │
│  ──── Separador temático ────                     │
│                                                   │
│  ┌──────────────────────────────────────────┐    │
│  │ Últimos Ensaios                           │    │
│  │ Lista vertical com imagem à esquerda     │    │
│  │ Título, resumo, data, tempo de leitura   │    │
│  └──────────────────────────────────────────┘    │
│                                                   │
│  ──── Newsletter / Destaque Secundário ────      │
│                                                   │
│  ┌─────────────┐ ┌─────────────┐ ┌─────────────┐ │
│  │ Card 4      │ │ Card 5      │ │ Card 6      │ │
│  └─────────────┘ └─────────────┘ └─────────────┘ │
│                                                   │
├─────────────────────────────────────────────────┤
│  FOOTER (links, direitos autorais)               │
└─────────────────────────────────────────────────┘
```

### 2.3 Layout do Post (Leitura)

```
┌─────────────────────────────────────────────────┐
│  HEADER minimalista                               │
├─────────────────────────────────────────────────┤
│                                                   │
│  Categoria ● 5 min de leitura                     │
│                                                   │
│  # Título do Ensaio                               │
│                                                   │
│  Por Irenilson Barbosa — 12 jun 2026              │
│                                                   │
│  [Imagem de destaque - opcional, larga]           │
│                                                   │
│  ┌──────────────────────────────────────────┐    │
│  │                                          │    │
│  │  Conteúdo do post (largura otimizada:    │    │
│  │  ~700px para leitura confortável)        │    │
│  │                                          │    │
│  │  • Citações com destaque                 │    │
│  │  • Imagens full-width                    │    │
│  │  • Notas de rodapé estilizadas           │    │
│  │                                          │    │
│  └──────────────────────────────────────────┘    │
│                                                   │
│  ──── Compartilhar / Tags ────                    │
│                                                   │
│  ┌──────────────┐   Artigos Relacionados          │
│  │ Card         │   (grid 3 cards no final)       │
│  └──────────────┘                                  │
│                                                   │
├─────────────────────────────────────────────────┤
│  FOOTER                                           │
└─────────────────────────────────────────────────┘
```

### 2.4 Arquivos do Tema

**`style.css`** — Cabeçalho do tema com metadados
**`theme.json`** — Configurações:
- Paleta de cores personalizada
- Presets de espaçamento e tipografia
- Layout widths (content: 700px, wide: 1200px)
- `appearanceTools: true`

**`functions.php`** — Setup mínimo:
- Registrar menus de navegação
- Registrar suporte a logo personalizado
- Carregar assets (CSS/JS extras se necessário)
- Remover estilos padrão do WP se atrapalharem

**Templates HTML (block theme):**
- `home.html` — Layout magazine (hero + grid + lista)
- `single.html` — Leitura limpa com metadados
- `page.html` — Página padrão
- `archive.html` — Listagem de categoria/tag
- `404.html`
- `search.html`

**Parts:**
- `header.html` — Nav + logo
- `footer.html` — Créditos + links

---

## 3. Plugin: `irenilson-barbosa-core`

### 3.1 Funcionalidades

| Funcionalidade | Descrição |
|----------------|-----------|
| **Custom Post Types** | `ensaio` (post type principal), `resenha`, `nota` (textos curtos) |
| **Taxonomias** | `tema` (categoriação temática, ex: Filosofia, Educação, Política), `tag` padrão |
| **Home Magazine** | Meta-box para marcar posts como "destaque do hero", "destaque grid" |
| **Tempo de Leitura** | Cálculo automático baseado no número de palavras |
| **Metadados de Post** | Subtítulo, local/data do ensaio (quando relevante) |
| **Author Box** | Bio do autor com foto, redes sociais, mini-currículo |
| **Artigos Relacionados** | Baseados na taxonomia `tema` |

### 3.2 Estrutura do Plugin

```
irenilson-barbosa-core/
├── irenilson-barbosa-core.php        ← Plugin header + bootstrap
├── includes/
│   ├── class-setup.php               ← CPTs, taxonomias, flush rewrites
│   ├── class-magazine.php            ← Destaques, home query, meta-boxes
│   ├── class-reading-time.php        ← Cálculo de tempo de leitura
│   ├── class-related-posts.php       ← Query de posts relacionados
│   └── class-author-box.php          ← Author box customizado
└── assets/
    └── admin.css                     ← Estilos para o admin (se necessário)
```

---

## 4. Fases de Implementação

### Fase 1 — Setup do Tema Base
- [ ] Criar estrutura de diretórios do tema
- [ ] Configurar `theme.json` (cores, tipografia, layout)
- [ ] Criar `style.css` com cabeçalho do tema
- [ ] Criar `functions.php` com setup básico
- [ ] Criar `index.html`, `header.html`, `footer.html`
- [ ] Ativar o tema e verificar funcionamento básico

### Fase 2 — Template Home (Revista)
- [ ] Criar `home.html` com hero + grid destaque
- [ ] Configurar query loops para seções da home
- [ ] Estilizar cards e hero

### Fase 3 — Template Single (Leitura)
- [ ] Criar `single.html` com layout otimizado para leitura
- [ ] Estilizar tipografia, citações, imagens
- [ ] Adicionar breadcrumb de categoria + metadados

### Fase 4 — Demais Templates
- [ ] `archive.html`, `page.html`, `search.html`, `404.html`
- [ ] Variações com e sem sidebar

### Fase 5 — Plugin de Funcionalidades
- [ ] Criar plugin e registrar CPT `ensaio` + taxonomy `tema`
- [ ] Implementar tempo de leitura
- [ ] Implementar meta-box de destaque na home
- [ ] Implementar author box
- [ ] Implementar artigos relacionados

### Fase 6 — Refinamentos
- [ ] Responsividade
- [ ] Performance (carregamento condicional de assets)
- [ ] Micro-animações (hover em cards, transições)
- [ ] Acessibilidade

---

## 5. Decisões Técnicas

| Decisão | Opção | Motivo |
|---------|-------|--------|
| Tipo de tema | **Block Theme (FSE)** | WP 7.0 suporta nativamente; templates em HTML facilitam manutenção |
| Grid/CSS | **CSS Grid + Flexbox** no `theme.json` e CSS nativo | Sem dependência de framework |
| Tipografia | Google Fonts ou fontes do tema | Carregar com `wp_enqueue_style` |
| Ícones | **SVG inline** ou **Dashicons** | Sem peso extra de bibliotecas |
| CPT vs Taxonomia | `ensaio` (CPT) + `tema` (taxonomia hierárquica) | Separa conteúdo editorial do blog padrão |
| Relacionados | `WP_Query` com `tax_query` | Simples e sem plugin extra |

---

## 6. Paleta de Cores Detalhada

```json
"palette": [
  { "slug": "marrom-escuro",  "name": "Marrom Escuro",  "color": "#3E2C1B" },
  { "slug": "marrom-claro",   "name": "Marrom Claro",   "color": "#8B7355" },
  { "slug": "bege",           "name": "Bege",            "color": "#F5F0E8" },
  { "slug": "bege-claro",     "name": "Bege Claro",      "color": "#FAF7F2" },
  { "slug": "verde-militar",  "name": "Verde Militar",   "color": "#4A5D3E" },
  { "slug": "verde-oliva",    "name": "Verde Oliva",     "color": "#6B7F5E" },
  { "slug": "branco",         "name": "Branco",          "color": "#FFFFFF" }
]
```

---

*Este plano pode ser ajustado conforme o feedback. O foco é construir um portal que priorize a experiência de leitura e a identidade visual do autor.*
