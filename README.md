# 🏗️ **Bella Back Novo** - Enterprise Laravel Application

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=flat-square&logo=php)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/badge/Build-Passing-brightgreen?style=flat-square)](https://github.com/AgnaldoScaion/bella_back_novo)

> **Arquitetura moderna em Laravel com foco em performance, escalabilidade e manutenibilidade.**

---

## 🔧 **Stack Tecnológica**

```yaml
Backend:
  Framework: Laravel 10.x
  Language: PHP 8.0+
  Architecture: MVC + Repository Pattern
  
Database:
  Primary: MySQL 8.0+
  Migrations: Laravel Eloquent ORM
  
DevOps:
  Dependency Manager: Composer
  Task Runner: Artisan CLI
  Environment: Docker Ready
```

---

## 📋 **Requisitos do Sistema**

### **Ambiente de Desenvolvimento**
| Tecnologia | Versão Mínima | Recomendada |
|------------|---------------|-------------|
| PHP | 8.0.x | 8.2.x |
| Composer | 2.0+ | 2.6+ |
| MySQL | 8.0+ | 8.0+ |
| Node.js | 16.x+ | 18.x+ |
| NPM | 8.x+ | 9.x+ |

### **Extensões PHP Obrigatórias**
```bash
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
```

---

## ⚡ **Instalação & Configuração**

### **1. Clonagem do Repositório**
```bash
git clone https://github.com/AgnaldoScaion/bella_back_novo.git
cd bella_back_novo
```

### **2. Instalação de Dependências**
```bash
# Produção otimizada
composer install --optimize-autoloader --no-dev --prefer-dist

# Desenvolvimento
composer install
```

### **3. Configuração de Ambiente**
```bash
# Copia template de configuração
cp .env.example .env

# Gera chave de criptografia da aplicação
php artisan key:generate --ansi
```

### **4. Configuração do Banco de Dados**
```bash
# Arquivo .env - Configurações críticas
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bella_avventura
DB_USERNAME=your_username
DB_PASSWORD=your_secure_password
```

### **5. Execução de Migrações**
```bash
# Estrutura do banco
php artisan migrate --force

# Com dados de exemplo (desenvolvimento)
php artisan migrate:fresh --seed
```

---

## 🚀 **Scripts de Automação**

### **Limpeza Completa do Cache**
```bash
#!/bin/bash
# Script: clear-cache.sh

php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan queue:clear
composer dump-autoload -o
echo "✅ Cache limpo e aplicação otimizada!"
```

### **Build de Produção**
```bash
#!/bin/bash
# Script: production-build.sh

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
composer install --optimize-autoloader --no-dev
echo "🚀 Build de produção concluído!"
```

---

## 📊 **Arquitetura & Padrões**

### **Estrutura de Diretórios**
```
app/
├── Http/Controllers/     # Controllers da API
├── Models/              # Modelos Eloquent
├── Repositories/        # Repository Pattern
├── Services/           # Lógica de negócio
├── Exceptions/         # Exception handlers
└── Providers/          # Service Providers

database/
├── migrations/         # Schema do banco
├── seeders/           # Dados iniciais
└── factories/         # Model factories

tests/
├── Feature/           # Testes de integração
└── Unit/             # Testes unitários
```

### **Convenções de Código**
- **PSR-12** - Padrão de codificação PHP
- **SOLID Principles** - Princípios de design
- **Repository Pattern** - Abstração de dados
- **Service Layer** - Separação de responsabilidades

---

## 🔒 **Segurança & Performance**

### **Configurações de Segurança**
```bash
# Headers de segurança
SECURE_HEADERS=true
HTTPS_ONLY=true
CSRF_PROTECTION=enabled

# Rate Limiting
API_RATE_LIMIT=60/min
AUTH_RATE_LIMIT=5/min
```

### **Otimizações de Performance**
```bash
# Cache de configuração
php artisan config:cache

# Cache de rotas
php artisan route:cache

# Cache de views Blade
php artisan view:cache

# Otimização do autoloader
composer dump-autoload --optimize --classmap-authoritative
```

---

## 🧪 **Testes & Qualidade**

### **Execução de Testes**
```bash
# Suite completa
php artisan test

# Testes com cobertura
php artisan test --coverage

# Testes específicos
php artisan test --filter UserTest
```

### **Análise de Código**
```bash
# PHPStan - Análise estática
./vendor/bin/phpstan analyse

# PHP CS Fixer - Formatação
./vendor/bin/php-cs-fixer fix
```

---

## 🐳 **Docker & Containerização**

### **Docker Compose (Desenvolvimento)**
```yaml
version: '3.8'
services:
  app:
    build: .
    ports:
      - "8000:8000"
    environment:
      - APP_ENV=local
  
  mysql:
    image: mysql:8.0
    environment:
      - MYSQL_DATABASE=bella_avventura
    ports:
      - "3306:3306"
```

```bash
# Inicialização com Docker
docker-compose up -d

# Comandos Laravel no container
docker-compose exec app php artisan migrate
```

---

## 📈 **Monitoramento & Logs**

### **Configuração de Logs**
```bash
# Canais de log disponíveis
LOG_CHANNEL=stack
LOG_STACK=single,daily,slack

# Nível de log em produção
LOG_LEVEL=error
```

### **Health Check Endpoint**
```php
// Route: /health
{
    "status": "ok",
    "timestamp": "2024-01-15T10:30:00Z",
    "version": "1.0.0",
    "database": "connected",
    "cache": "active"
}
```

---

## 🚦 **Pipeline CI/CD**

### **GitHub Actions**
```yaml
name: Laravel CI/CD
on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
      - name: Run Tests
        run: php artisan test
```

---

## 🔗 **Recursos & Documentação**

### **Links Essenciais**
- 📚 [Laravel Documentation](https://laravel.com/docs)
- 🏗️ [Architecture Guide](https://laravel.com/docs/structure)
- 🚀 [Deployment Guide](https://laravel.com/docs/deployment)
- 🔒 [Security Best Practices](https://laravel.com/docs/security)

### **Ferramentas Recomendadas**
- **IDE**: PhpStorm, VS Code
- **Debug**: Laravel Debugbar, Telescope
- **API**: Postman, Insomnia
- **DB**: TablePlus, phpMyAdmin

---

## 🤝 **Contribuição & Desenvolvimento**

### **Fluxo de Trabalho**
1. **Fork** o repositório
2. Crie uma **branch** para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. **Commit** suas mudanças (`git commit -m 'feat: adiciona nova funcionalidade'`)
4. **Push** para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um **Pull Request**

### **Convenções de Commit**
```bash
feat: nova funcionalidade
fix: correção de bug
docs: atualização de documentação
style: formatação de código
refactor: refatoração
test: adição de testes
chore: tarefas de manutenção
```

---

## 📞 **Suporte & Comunidade**

### **Canais de Comunicação**
- 🐛 **Issues**: [GitHub Issues](https://github.com/AgnaldoScaion/bella_back_novo/issues)
- 💬 **Discussões**: [GitHub Discussions](https://github.com/AgnaldoScaion/bella_back_novo/discussions)
- 📧 **Email**: spectraldevteam@gmail.com

### **Status do Projeto**
![GitHub last commit](https://img.shields.io/github/last-commit/AgnaldoScaion/bella_back_novo?style=flat-square)
![GitHub issues](https://img.shields.io/github/issues/AgnaldoScaion/bella_back_novo?style=flat-square)
![GitHub pull requests](https://img.shields.io/github/issues-pr/AgnaldoScaion/bella_back_novo?style=flat-square)

---

<div align="center">

**Desenvolvido com 💜 pela equipe Spectral**

⭐ **Star este repositório se ele foi útil para você!**

[![GitHub stars](https://img.shields.io/github/stars/AgnaldoScaion/bella_back_novo?style=social)](https://github.com/AgnaldoScaion/bella_back_novo)
[![GitHub forks](https://img.shields.io/github/forks/AgnaldoScaion/bella_back_novo?style=social)](https://github.com/AgnaldoScaion/bella_back_novo)

</div>
