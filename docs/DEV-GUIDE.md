# Guia de Desenvolvimento

## Convenções

### Geral
- Idioma: português (código, comentários, commits)
- Commits atômicos: uma funcionalidade por commit
- Prefixo de commit: `feat:`, `fix:`, `docs:`, `refactor:`, `style:`

### PHP
- Namespace: `IrenilsonBarbosa\Core` no plugin
- Classes no padrão `class-{nome}.php`
- Prefixo de funções: `irenilson_barbosa_`
- Evitar funções no global namespace; usar classes e métodos estáticos

### CSS / theme.json
- Cores sempre via CSS custom properties do WP (`var:preset|color|{slug}`)
- Espaçamento via presets do `theme.json` (`var:preset|spacing|{size}`)
- Tipografia via `theme.json` presets de font-size e font-family
- Não usar unidades fixas (px) para font-size; usar `clamp()` ou presets

### Templates HTML (FSE)
- Blocos core do WordPress sempre que possível
- Comentários HTML `<!-- wp:... -->` para estrutura
- Patterns para seções reutilizáveis

## Check-list antes de commitar

- [ ] Templates válidos (sem erro de bloco)
- [ ] Cores seguem a paleta de `docs/COLORS.md`
- [ ] Responsivo testado (mobile 375px, tablet 768px, desktop 1440px)
- [ ] Acessibilidade: contraste, foco visível, `alt` em imagens
- [ ] Sem quebra de layout no editor de blocos

## Comandos úteis

```bash
# Ativar tema via WP-CLI
wp theme activate irenilson-barbosa

# Listar CPTs registrados
wp post-type list

# Listar taxonomias
wp taxonomy list
```

## Fluxo de Trabalho

1. Editar `theme.json` para ajustes de design system
2. Editar templates HTML para estrutura
3. Adicionar CSS via `editor.css` ou style variations
4. Adicionar lógica PHP no plugin `irenilson-barbosa-core`
5. Verificar no frontend e no editor de blocos
6. Documentar em `docs/` qualquer decisão relevante
