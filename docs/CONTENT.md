# Conteúdo — Modelo de Dados

## Visão Geral

4 seções de conteúdo, cada uma com seu Post Type e taxonomia.

## 1. Artigos (Posts)

**Post Type:** `post` (nativo)

Conteúdo editorial: ensaios, reflexões, textos de opinião.

**Categorias:** Filosofia, Educação, Política, Cultura, Cotidiano

**Metadados:** Subtítulo, tempo de leitura, tipo de destaque

## 2. Publicações Acadêmicas

**Post Type:** `publicacao`

**Taxonomia:** `tipo-de-publicacao` (hierárquica)
- Artigo em Periódico, Capítulo de Livro, Trabalho em Anais,
  Resenha Acadêmica, Tese/Dissertação, Verbete

**Metadados:** ano_publicacao, periodico, doi, link_externo, citacao_abnt

## 3. Livros

**Post Type:** `livro`

**Taxonomia:** `participacao` (hierárquica)
- Autor, Organizador, Coautor

**Metadados:** isbn, ano, editora, sinopse, numero_paginas,
link_amazon, link_marinete

## 4. Materiais

**Post Type:** `material`

**Taxonomia:** `tipo-de-material` (hierárquica)
- Plano de Ensino, Apostila, Artigo, Slide, Exercício, E-book

**Metadados:** arquivo, descricao, ano

## Plugin responsável

Todos os CPTs, taxonomias e metadados são registrados pelo plugin
`irenilson-barbosa-core` → `includes/class-setup.php`
