# Arquitetura de Conteúdo

## Visão Geral

O portal possui 4 seções de conteúdo, cada uma com seu próprio Post Type e organização taxonômica.

---

## 1. Artigos (Posts)

**Post Type:** `post` (nativo do WordPress)

Conteúdo editorial do blog: ensaios, reflexões, textos de opinião.

### Categorias (taxonomia nativa `category`)

| Categoria | Slug | Descrição |
|-----------|------|-----------|
| Filosofia | `filosofia` | Ensaios filosóficos |
| Educação | `educacao` | Reflexões sobre ensino e pedagogia |
| Política | `politica` | Análise política e social |
| Cultura | `cultura` | Crítica cultural, arte, literatura |
| Cotidiano | `cotidiano` | Crônicas e textos do dia a dia |

*Categorias podem ser expandidas conforme necessidade.*

### Metadados

- **Subtítulo** (field: `subtitulo`) — Exibido abaixo do título no single
- **Tempo de leitura** (field: `tempo_leitura`) — Calculado automaticamente
- **Destaque** (field: `destaque_tipo`) — `hero`, `grid`, `nenhum`

---

## 2. Publicações Acadêmicas

**Post Type:** `publicacao`

Artigos acadêmicos, capítulos de livros, papers, teses e resenhas publicadas em periódicos ou eventos.

### Taxonomy: `tipo-de-publicacao` (hierárquica)

| Termo | Slug | Descrição |
|-------|------|-----------|
| Artigo em Periódico | `artigo-periodico` | Artigo publicado em revista acadêmica |
| Capítulo de Livro | `capitulo-livro` | Capítulo em obra coletiva |
| Trabalho em Anais | `trabalho-anais` | Publicado em anais de evento |
| Resenha Acadêmica | `resenha-academica` | Resenha crítica publicada |
| Tese / Dissertação | `tese-dissertacao` | Teses e dissertações |
| Verbete | `verbete` | Verbete de enciclopédia/dicionário |

### Metadados

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `ano_publicacao` | number | Ano da publicação |
| `periodico` | text | Nome do periódico ou veículo |
| `doi` | text | DOI (Digital Object Identifier) |
| `link_externo` | url | Link para o original (quando disponível) |
| `citacao_abnt` | textarea | Citação formatada em ABNT |

---

## 3. Livros

**Post Type:** `livro`

Divulgação de livros onde Irenilson é autor, organizador ou coautor, com links de afiliado para compra.

### Taxonomy: `participacao` (hierárquica)

| Termo | Slug | Descrição |
|-------|------|-----------|
| Autor | `autor` | Irenilson é o autor principal |
| Organizador | `organizador` | Irenilson organizou a obra |
| Coautor | `coautor` | Participou como coautor/capítulo |

### Metadados

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `isbn` | text | ISBN do livro |
| `ano` | number | Ano de publicação |
| `editora` | text | Nome da editora |
| `sinopse` | textarea | Resumo da obra |
| `numero_paginas` | number | Total de páginas |
| `capa` | image | Imagem da capa |
| `link_amazon` | url | Link de afiliado Amazon |
| `link_marinete` | url | Link de afiliado outra loja |

---

## 4. Materiais

**Post Type:** `material`

Materiais didáticos e acadêmicos disponíveis para download (alunos e público geral).

### Taxonomy: `tipo-de-material` (hierárquica)

| Termo | Slug | Descrição |
|-------|------|-----------|
| Plano de Ensino | `plano-ensino` | Planos de disciplina |
| Apostila | `apostila` | Material completo de curso |
| Artigo | `artigo` | Artigos para leitura |
| Slide | `slide` | Apresentações de aula |
| Exercício | `exercicio` | Listas de exercícios |
| E-book | `ebook` | Material complementar |

### Metadados

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `arquivo` | file | Arquivo para download (PDF preferencialmente) |
| `descricao` | textarea | Descrição do material |
| `ano` | number | Ano de referência |

---

## Resumo das Taxonomias

| Post Type | Taxonomy | Tipo |
|-----------|----------|------|
| `post` (Artigos) | `category` | Nativa (hierárquica) |
| `post` (Artigos) | `post_tag` | Nativa (não hierárquica) |
| `publicacao` | `tipo-de-publicacao` | Hierárquica |
| `livro` | `participacao` | Hierárquica |
| `material` | `tipo-de-material` | Hierárquica |
