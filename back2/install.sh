#!/bin/bash

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${GREEN}╔══════════════════════════════════════╗${NC}"
echo -e "${GREEN}║  Bella Avventura - Auto Installer  ║${NC}"
echo -e "${GREEN}╚══════════════════════════════════════╝${NC}"
echo ""

# Função de erro
error_exit() {
    echo -e "${YELLOW}❌ Erro: $1${NC}" 1>&2
    exit 1
}

# 1. Composer
echo -e "${GREEN}[1/7] Instalando dependências PHP...${NC}"
composer install --optimize-autoloader || error_exit "Falha no composer install"

# 2. NPM
echo -e "${GREEN}[2/7] Instalando dependências Node...${NC}"
npm install 2>/dev/null || echo "⚠️ NPM não instalado, pulando..."

# 3. .env
echo -e "${GREEN}[3/7] Configurando ambiente...${NC}"
[ ! -f .env ] && cp .env.example .env && php artisan key:generate --ansi

# 4. Verificar DB
echo -e "${GREEN}[4/7] Verificando conexão com banco...${NC}"
php artisan db:show 2>/dev/null || echo "⚠️ Configure o .env com dados do banco!"

# 5. Migrations
echo -e "${GREEN}[5/7] Migrations${NC}"
read -p "Executar migrations? (s/N): " -n 1 -r
echo
[[ $REPLY =~ ^[Ss]$ ]] && php artisan migrate --force

# 6. Seeds
echo -e "${GREEN}[6/7] Seeds${NC}"
read -p "Popular banco? (s/N): " -n 1 -r
echo
[[ $REPLY =~ ^[Ss]$ ]] && php artisan db:seed

# 7. Cache
echo -e "${GREEN}[7/7] Limpando cache...${NC}"
php artisan optimize:clear

echo ""
echo -e "${GREEN}✅ Instalação concluída!${NC}"
echo -e "${YELLOW}Para iniciar: php artisan serve${NC}"
echo ""

read -p "Iniciar servidor agora? (s/N): " -n 1 -r
echo
[[ $REPLY =~ ^[Ss]$ ]] && php artisan serve
