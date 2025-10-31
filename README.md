# 🌍 Bella Avventura - Plataforma de Turismo

<div align="center">
  <img src="https://i.ibb.co/Vp07k1Gf/image.png" alt="Bella Avventura" width="800" style="max-width: 100%; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
</div>

<div align="center">

[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat-square&logo=mysql)](https://www.mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

</div>

> **Plataforma completa de turismo** para buscar destinos, reservar hotéis e descobrir experiências incríveis de viagem! 🏨✈️

---

## 📖 Índice

- [Sobre o Projeto](#-sobre-o-projeto)
- [Funcionalidades](#-funcionalidades)
- [Pré-requisitos](#-pré-requisitos)
- [Instalação Rápida](#-instalação-rápida)
- [Instalação Detalhada](#-instalação-detalhada)
- [Comandos Úteis](#-comandos-úteis)
- [Problemas Comuns](#-problemas-comuns)
- [Tecnologias](#-tecnologias)
- [Licença](#-licença)

---

## 🎯 Sobre o Projeto

**Bella Avventura** é uma plataforma web moderna que permite:

- 🏨 **Buscar e reservar hotéis** com filtros avançados
- 🗺️ **Explorar destinos turísticos** pelo Brasil
- 🍽️ **Descobrir restaurantes** locais e suas especialidades
- ⭐ **Avaliar experiências** de outros viajantes
- 📅 **Gerenciar reservas** de forma simples

---

## ✨ Funcionalidades

### Para Usuários
- ✅ Cadastro e login seguro
- ✅ Busca de hotéis por cidade, preço e avaliação
- ✅ Sistema de reservas online
- ✅ Perfil personalizável
- ✅ Histórico de viagens

### Para Hotéis
- ✅ Catálogo com mais de 21 hotéis cadastrados
- ✅ Galeria de fotos
- ✅ Informações detalhadas (comodidades, preços, localização)
- ✅ Sistema de avaliações e comentários
- ✅ Mapa interativo com localização

---

## 🔧 Pré-requisitos

Antes de começar, você precisa ter instalado:

### Obrigatório
- ✅ **PHP 8.2 ou superior** ([Download](https://www.php.net/downloads))
- ✅ **Composer** ([Download](https://getcomposer.org/download/))
- ✅ **MySQL 8.0 ou superior** ([Download](https://dev.mysql.com/downloads/mysql/))

### Opcional
- ⚡ **XAMPP** (inclui PHP + MySQL) ([Download](https://www.apachefriends.org/))
- 🎨 **Node.js** (para compilar assets CSS/JS) ([Download](https://nodejs.org/))
- 📝 **VS Code** (editor recomendado) ([Download](https://code.visualstudio.com/))

---

## 🚀 Instalação Rápida

> **Para quem já tem PHP, Composer e MySQL instalados**

### Opção 1: Instalação Automática ⚡

```bash
# 1. Clone o projeto
git clone https://github.com/seu-usuario/bella_back_novo.git
cd bella_back_novo/back2

# 2. Execute o instalador automático
composer setup-full

# 3. Inicie o servidor
composer serve
```

Pronto! Acesse: **http://localhost:8000** 🎉

---

### Opção 2: Instalação Manual Simplificada

```bash
# 1. Clone o repositório
git clone https://github.com/seu-usuario/bella_back_novo.git
cd bella_back_novo/back2

# 2. Instale as dependências
composer install

# 3. Configure o ambiente
cp .env.example .env
php artisan key:generate

# 4. Configure o banco de dados no arquivo .env
# Abra o arquivo .env e edite:
DB_DATABASE=bella_avventura
DB_USERNAME=root
DB_PASSWORD=sua_senha

# 5. Crie as tabelas do banco
php artisan migrate

# 6. Inicie o servidor
php artisan serve
```

Acesse: **http://localhost:8000** ✅

---

## 📚 Instalação Detalhada (Passo a Passo)

### 1️⃣ Instalar XAMPP (se não tiver PHP/MySQL)

1. Baixe o XAMPP: https://www.apachefriends.org/
2. Instale e inicie **Apache** e **MySQL** pelo painel de controle
3. Verifique se está funcionando acessando: http://localhost/phpmyadmin

---

### 2️⃣ Instalar Composer

1. Baixe: https://getcomposer.org/download/
2. Execute o instalador
3. Teste no terminal:
```bash
composer --version
```

---

### 3️⃣ Baixar o Projeto

**Opção A: Usando Git**
```bash
git clone https://github.com/seu-usuario/bella_back_novo.git
cd bella_back_novo/back2
```

**Opção B: Download manual**
1. Baixe o ZIP do GitHub
2. Extraia para `C:\xampp\htdocs\bella_back_novo`
3. Abra o terminal na pasta `back2`

---

### 4️⃣ Instalar Dependências

```bash
composer install
```

Se aparecer erro, tente:
```bash
composer install --ignore-platform-reqs
```

---

### 5️⃣ Configurar o Ambiente

```bash
# Copiar arquivo de configuração
cp .env.example .env

# Gerar chave de segurança
php artisan key:generate
```

---

### 6️⃣ Configurar Banco de Dados

1. **Criar o banco de dados:**
   - Acesse: http://localhost/phpmyadmin
   - Clique em "Novo"
   - Digite: `bella_avventura`
   - Clique em "Criar"

2. **Configurar o arquivo `.env`:**

Abra o arquivo `.env` e edite estas linhas:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bella_avventura
DB_USERNAME=root
DB_PASSWORD=           # Deixe vazio se não tiver senha
```

---

### 7️⃣ Criar as Tabelas

```bash
php artisan migrate
```

**Quer popular com dados de exemplo?**
```bash
php artisan db:seed
```

---

### 8️⃣ Iniciar o Servidor

```bash
php artisan serve
```

Você verá algo como:
```
Server running on [http://127.0.0.1:8000]
```

**Acesse no navegador:** http://localhost:8000 🎉

---

## 🛠️ Comandos Úteis

### Instalação e Setup
```bash
# Setup básico (sem banco)
composer setup

# Setup completo (com banco + dados)
composer setup-full

# Limpar cache
composer clean
```

### Servidor
```bash
# Iniciar servidor
composer serve
# ou
php artisan serve

# Servidor com porta customizada
php artisan serve --port=8080
```

### Banco de Dados
```bash
# Criar tabelas
php artisan migrate

# Resetar banco (APAGA TUDO!)
composer fresh
# ou
php artisan migrate:fresh --seed

# Popular com dados de teste
php artisan db:seed
```

### Desenvolvimento
```bash
# Limpar cache
php artisan optimize:clear

# Ver rotas disponíveis
php artisan route:list

# Criar um controller
php artisan make:controller NomeController

# Criar um model com migration
php artisan make:model NomeModel -m
```

---

## ❓ Problemas Comuns

### ❌ "composer: command not found"
**Solução:** Composer não está instalado ou não está no PATH.
- Windows: Reinstale o Composer e marque "Add to PATH"
- Linux/Mac: `sudo apt install composer` ou `brew install composer`

---

### ❌ "Class 'PDO' not found"
**Solução:** Extensão PHP não ativada.

Edite o arquivo `php.ini` e remova o `;` destas linhas:
```ini
extension=pdo_mysql
extension=mysqli
```

Reinicie o Apache/XAMPP.

---

### ❌ "Access denied for user 'root'@'localhost'"
**Solução:** Senha do MySQL incorreta.

No arquivo `.env`, ajuste:
```env
DB_USERNAME=root
DB_PASSWORD=      # Deixe vazio ou coloque a senha correta
```

---

### ❌ "SQLSTATE[HY000] [2002] Connection refused"
**Solução:** MySQL não está rodando.

- **XAMPP:** Inicie o MySQL pelo painel de controle
- **Linux:** `sudo service mysql start`
- **Mac:** `brew services start mysql`

---

### ❌ Porta 8000 já está em uso
**Solução:** Use outra porta:
```bash
php artisan serve --port=8080
```

---

### ❌ "The stream or file could not be opened"
**Solução:** Permissões de pasta.

**Windows:**
```bash
icacls storage /grant Users:F /T
icacls bootstrap/cache /grant Users:F /T
```

**Linux/Mac:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R $USER:www-data storage bootstrap/cache
```

---

## 🧰 Tecnologias

### Backend
- **Laravel 12.x** - Framework PHP moderno
- **PHP 8.2+** - Linguagem de programação
- **MySQL 8.0+** - Banco de dados relacional

### Frontend
- **Blade Templates** - Engine de templates do Laravel
- **Bootstrap 5** - Framework CSS responsivo
- **Font Awesome 6** - Biblioteca de ícones
- **Leaflet.js** - Mapas interativos
- **JavaScript** - Interatividade

### Ferramentas
- **Composer** - Gerenciador de dependências PHP
- **Git** - Controle de versão
- **XAMPP** - Ambiente de desenvolvimento local

---

## 📄 Licença

Este projeto está sob a licença **MIT**. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

## 📞 Contato

- 📧 **Email:** spectraldevteam@gmail.com
- 🌐 **Website:** [Ainda em Desenvolvimento](https://agnaldoscaion.netlify.app)
- 🐙 **GitHub:** [Seu GitHub](https://github.com/AgnaldoScaion)

---

## 📸 Screenshots

### Página Inicial (Sem Cadastro)
<div align="center">
  <img src="https://i.ibb.co/V0CbCVdZ/image.png" alt="Página Inicial" width="900" style="max-width: 100%; border-radius: 8px; margin: 20px 0; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
</div>

### Seleção de Destinos
<div align="center">
  <img src="https://i.ibb.co/Myh6cbYj/image.png" alt="Seleção de Destinos" width="900" style="max-width: 100%; border-radius: 8px; margin: 20px 0; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
</div>

---

<p align="center">
  Desenvolvido com ❤️ pela equipe <strong>Bella Avventura</strong>
</p>

<p align="center">
  <a href="#-bella-avventura---plataforma-de-turismo">⬆ Voltar ao topo</a>
</p>