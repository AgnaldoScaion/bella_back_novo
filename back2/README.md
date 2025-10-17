# 🇮🇹 Bella Avventura - Sistema de Reservas

Sistema de gerenciamento de viagens e reservas para a Itália, desenvolvido em Laravel 12.

## 📋 Sobre o Projeto

Bella Avventura é uma plataforma de viagens que permite aos usuários:
- 🏨 Reservar hotéis na Itália
- 🍽️ Descobrir restaurantes autênticos
- 🗺️ Explorar pontos turísticos
- ✉️ Receber confirmações por email
- 📱 Gerenciar suas reservas

## 🛠️ Tecnologias

- **Backend:** Laravel 12.24.0
- **Database:** MySQL 8.0
- **PHP:** 8.2.12
- **Email:** Gmail SMTP
- **Frontend:** Blade Templates + Tailwind CSS

## ⚙️ Instalação Rápida

### Windows (PowerShell)
```powershell
# Clone o repositório
git clone <repo-url>
cd back2

# Execute o instalador automático
.\install.ps1
```

### Linux/Mac (Bash)
```bash
# Clone o repositório
git clone <repo-url>
cd back2

# Execute o instalador automático
chmod +x install.sh
./install.sh
```

## 🔧 Instalação Manual

### 1. Dependências
```bash
composer install --optimize-autoloader
npm install
```

### 2. Configuração
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configurar .env
```env
APP_NAME="Bella Avventura"
DB_CONNECTION=mysql
DB_DATABASE=bella_avventura
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. Database
```bash
# Criar banco de dados
mysql -u root -e "CREATE DATABASE bella_avventura"

# Rodar migrations
php artisan migrate

# (Opcional) Popular com dados de teste
php artisan db:seed
```

### 5. Iniciar Servidor
```bash
php artisan serve
```

Acesse: http://localhost:8000

## 📁 Estrutura do Projeto

```
back2/
├── app/
│   ├── Http/Controllers/
│   │   ├── ReservaController.php    # Gerencia reservas
│   │   ├── HotelController.php      # Dados dos hotéis
│   │   └── ...
│   ├── Models/
│   │   ├── Reserva.php              # Model de reservas
│   │   └── User.php
│   └── Mail/
│       └── ReservaConfirmacao.php   # Email de confirmação
├── database/
│   └── migrations/                   # Schema do banco
├── resources/
│   └── views/
│       ├── reservas/                 # Views de reservas
│       └── emails/                   # Templates de email
└── routes/
    └── web.php                       # Rotas da aplicação
```

## 🔍 Arquitetura de Dados

⚠️ **Importante:** Este projeto usa uma arquitetura híbrida:

### Banco de Dados MySQL
- ✅ Usuários
- ✅ Reservas
- ✅ Feedbacks
- ✅ Viagens

### Arrays Hardcoded (PHP)
- 🏨 Hotéis (HotelController.php)
- 🍽️ Restaurantes (RestauranteController.php)
- 🗺️ Pontos Turísticos (PontoTuristicoController.php)

📖 Para detalhes completos, veja: [ARQUITETURA_DADOS.md](./ARQUITETURA_DADOS.md)

## 📧 Configuração de Email

### Gmail App Password

1. Acesse: https://myaccount.google.com/apppasswords
2. Crie uma senha de app para "Mail"
3. Use no .env:
```env
MAIL_PASSWORD=sua-senha-de-16-digitos
```

📖 Guia completo: [CONFIGURACAO_EMAIL.md](./CONFIGURACAO_EMAIL.md)

## 🚀 Uso

### Fazer uma Reserva
1. Acesse `/hoteis`
2. Escolha um hotel
3. Preencha dados da reserva
4. Confirme via link no email

### API Endpoints
```
GET  /api/hoteis              - Listar hotéis
GET  /api/restaurantes        - Listar restaurantes
GET  /api/pontos-turisticos   - Listar pontos turísticos
POST /reservas                - Criar reserva
GET  /reservas/confirmar/{codigo} - Confirmar reserva
```

## 🐛 Troubleshooting

### Email não está sendo enviado
```bash
# Verificar logs
tail -f storage/logs/laravel.log

# Limpar cache
php artisan config:clear
php artisan view:clear
```

### Erro de conexão com banco
```bash
# Verificar configuração
php artisan db:show

# Testar conexão
php artisan migrate:status
```

### Erro de FK (Foreign Key)
```bash
# A migration já está correta, mas se necessário:
php artisan migrate:fresh
```

## 📝 Comandos Úteis

```bash
# Limpar todos os caches
php artisan optimize:clear

# Ver rotas
php artisan route:list

# Gerar nova migration
php artisan make:migration nome_da_migration

# Criar controller
php artisan make:controller NomeController

# Criar model
php artisan make:model Nome -m
```

## 🔐 Segurança

- ✅ Validação de dados em PT-BR
- ✅ Proteção CSRF em formulários
- ✅ Sanitização de inputs
- ✅ Senhas hasheadas (bcrypt)
- ✅ App passwords para email

## 📄 Documentação Adicional

- [ARQUITETURA_DADOS.md](./ARQUITETURA_DADOS.md) - Estrutura de dados
- [CONFIGURACAO_EMAIL.md](./CONFIGURACAO_EMAIL.md) - Setup de email

## 🤝 Contribuindo

1. Fork o projeto
2. Crie uma branch (`git checkout -b feature/NovaFeature`)
3. Commit suas mudanças (`git commit -m 'Add: Nova feature'`)
4. Push para a branch (`git push origin feature/NovaFeature`)
5. Abra um Pull Request

## 📜 Licença

Este projeto é licenciado sob a [MIT License](https://opensource.org/licenses/MIT).

## 👥 Autores

Desenvolvido com ❤️ para Bella Avventura

---

**Powered by Laravel 12** 🚀
