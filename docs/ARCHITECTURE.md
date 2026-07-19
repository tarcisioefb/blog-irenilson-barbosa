# Arquitetura do Projeto

## Stack

| Camada | Tecnologia |
|--------|------------|
| CMS | WordPress 7.0.2 (pt_BR) |
| PHP | 8.2.29 |
| Banco | MySQL 8.4.0 |
| Servidor | Nginx |
| Ambiente | Local WP (Local by Flywheel) |
| Tema | `irenilson-barbosa` — Block Theme (FSE) |
| Plugin | `irenilson-barbosa-core` — Funcionalidades |

## Estrutura de Diretórios

```
/
├── app/
│   ├── .envrc              ← Config do Local WP (gitignored)
│   ├── public/              ← WordPress core + wp-content
│   │   └── wp-content/
│   │       ├── themes/
│   │       │   ├── twentytwentyfive/  ← Tema padrão (não usado)
│   │       │   └── irenilson-barbosa/ ← Tema personalizado
│   │       └── plugins/
│   │           └── irenilson-barbosa-core/
│   ├── sql/                 ← Backup do banco
│   └── wp-config.php        ← Config WP (gitignored)
│
├── conf/                    ← Config Nginx, PHP, MySQL
│   ├── nginx/
│   ├── php/
│   └── mysql/
│
├── logs/                    ← Logs do servidor (gitignored)
│
├── docs/                    ← Documentação do projeto
│   ├── ARCHITECTURE.md
│   ├── COLORS.md
│   ├── CONTENT.md
│   ├── THEME.md
│   └── DEV-GUIDE.md
│
├── PLANO-DESENVOLVIMENTO.md
└── .gitignore
```

## Decisões Técnicas

| Decisão | Escolha | Justificativa |
|---------|---------|--------------|
| Tipo de tema | **Block Theme (FSE)** | Templates HTML, controle total via `theme.json`, sem PHP templates |
| Grid | **CSS Grid + Flexbox** nativo | Zero dependências, performático |
| Tipografia | Google Fonts via `wp_enqueue_style` | Carregamento otimizado |
| Ícones | SVG inline / Dashicons | Sem bibliotecas externas pesadas |
| Funcionalidades | Plugin próprio | Desacopla lógica do tema, permite troca de tema sem perder dados |
| Uploads | Gitignored | Conteúdo gerado pelo usuário |

## Fluxo de Desenvolvimento

1. `docs/` → documentar decisões antes de implementar
2. Tema → blocos e templates no `theme.json`
3. Plugin → PHP para CPTs, metadados, lógica
4. Commit atômico por funcionalidade
