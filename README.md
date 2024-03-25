# ERP EMPRESA

Desenvolvido nos seguintes frameworks:

- Laravel v11 (api)
- VueJS v3 (app)

Bibliotecas ou pacotes utilizados:

- Laravel Sail (api)
- Sanctum (api)
- Vuex (app)
- Tailwind (app)
- PrimeVue (app)

Inicializando a api:

1) Configurar o docker e instalando pacotes composer
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
2) Iniciar os containers
```
.vendor/bin/sail up -d
```
3) Criar e configurar o arquivo .env copiando do arquivo .env.example
4) Executar as migrations com seeders
```
.vendor/bin/sail art migrate --seed
```

Inicializando o app:

1) Instalar os pacotes npm: `npm install`
2) Executar a aplicação na porta 3000: `npm run dev -- --port 3000`

Para testar a aplicação, a primeira página é a de login onde foi criado um acesso de usuário ao executar a migrate com os seeder.

Use este acesso para realizar o login na aplciação:

Usuário: admin.test@example.com

Senha: password
