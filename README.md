
## Instalação

Requerimento [Docker](https://www.docker.com/).

Executar os comandos abaixo:

```sh
docker compose up -d
composer install
cp .env.enxample .env
php artisan migrate --seed
```

Os comandos acima irão: 
- Baixar as imagens docker do PHP + Nginx, Postgres e Redis, e subir o servidor Nginx na porta :8080.
- Instalar todas as dependencias.
- Criar as tabelas necessárias e rodar uma seed para popular o banco de dados com dados de teste.


Na raiz do projeto tem um arquivo `teste.json` com a collection do insomnia para teste,  
e um arquivo `teste.csv` com dados para teste de importação  
