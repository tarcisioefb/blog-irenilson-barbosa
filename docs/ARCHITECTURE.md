# Arquitetura do Projeto

## Stack

| Camada | Tecnologia |
|--------|------------|
| CMS | WordPress 7.0.2 (pt_BR) |
| PHP | 8.2.29 |
| Banco | MySQL 8.4.0 |
| Servidor | Nginx |
| Ambiente | Local WP (Local by Flywheel) |
| Tema ativo | `irenilson-barbosa-v2` — Classic PHP Theme |
| Plugin | `irenilson-barbosa-core` — CPTs, Taxonomias, Metadados |

## Estrutura de Diretórios

```
/
├── app/
│   ├── .envrc              ← Config do Local WP (gitignored)
│   ├── public/              ← WordPress core + wp-content
│   │   └── wp-content/
│   │       ├── themes/
│   │       │   ├── irenilson-barbosa/        ← Tema FSE (descontinuado)
│   │       │   └── irenilson-barbosa-v2/     ← Tema ativo (Elite base)
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
├── docs/                    ← Documentação do projeto
│
├── *.php                    ← Scripts avulsos (import-blogger, images, etc.)
└── .gitignore
```

## Scripts na raiz

| Script | Função |
|--------|--------|
| `import-blogger.py` | Crawleia blog antigo e classifica posts |
| `import-wp.php` | Importa JSON do Blogger para WordPress |
| `assign-user-images.php` | Cria usuário + baixa imagens |
| `assign-images.php` | Continua download de imagens |
| `cleanup-import.php` | Remove posts que não se encaixam no perfil |
| `images.php` | Gera placeholders JPG para posts sem imagem |
| `pexels-images.php` | Substitui placeholders por fotos da Pexels API |
