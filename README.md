📌 Instalação e Otimização do Projeto Laravel
🚀 Instalação
Após clonar o repositório, siga os passos abaixo no terminal para evitar problemas:

Instalar as dependências do Composer

bash
Copiar
Editar
composer install
Configurar o arquivo .env

bash
Copiar
Editar
copy .env.example .env
Importante:

Altere o local do banco de dados, a porta e, caso tenha senha, insira no campo correspondente.

Certifique-se de que o banco de dados está criado antes de prosseguir.

Gerar a chave da aplicação

bash
Copiar
Editar
php artisan key:generate
Rodar as migrações do banco de dados

bash
Copiar
Editar
php artisan migrate
⚡ Otimização e Limpeza de Cache
Para realizar uma limpeza rápida e otimizar o carregamento dos arquivos, execute os comandos abaixo:

bash
Copiar
Editar
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan view:clear
php artisan cache:clear
composer dump-autoload
Essa limpeza ajuda a evitar conflitos de cache e garante que todas as alterações sejam aplicadas corretamente.
