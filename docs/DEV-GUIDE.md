# Guia de Desenvolvimento

## Convenções

- Prefixo de funções no tema: `ib_`
- Prefixo de funções no plugin: `irenilson_barbosa_`
- Namespace do plugin: `IrenilsonBarbosa\Core`
- Classes no formato `class-{nome}.php`
- Commits atômicos, prefixo `feat:`, `fix:`, `refactor:`, `docs:`

## CSS

- Variáveis CSS em `:root` no `ib.css`
- Fontes injetadas dinamicamente via `wp_head` (configuráveis no admin)
- Classes com prefixo `eh-` (herdado do Elite Notícias)
- Cards sem fundo/borda — hover só com translateY

## Imagens

- Thumbnails contextuais via Pexels API (scripts na raiz)
- Placeholders JPG gerados com GD quando não há imagem
- API key da Pexels configurada no script (não no admin)

## Comandos úteis

```bash
# Ativar tema
wp theme activate irenilson-barbosa-v2

# Ativar plugin
wp plugin activate irenilson-barbosa-core

# Executar script PHP no contexto WP
wp eval-file ../pexels-images.php

# Listar posts por tipo
wp post list --post_type=post,publicacao,livro,material --format=table
```
