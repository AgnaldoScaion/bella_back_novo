# ╔══════════════════════════════════════╗
# ║  Bella Avventura - Auto Installer  ║
# ║         Windows PowerShell         ║
# ╚══════════════════════════════════════╝

Write-Host "╔══════════════════════════════════════╗" -ForegroundColor Green
Write-Host "║  Bella Avventura - Auto Installer  ║" -ForegroundColor Green
Write-Host "╚══════════════════════════════════════╝" -ForegroundColor Green
Write-Host ""

# 1. Composer
Write-Host "[1/7] Instalando dependências PHP..." -ForegroundColor Green
try {
    composer install --optimize-autoloader
    if ($LASTEXITCODE -ne 0) { throw "Composer install falhou" }
} catch {
    Write-Host "❌ Erro: $_" -ForegroundColor Red
    exit 1
}

# 2. NPM
Write-Host "[2/7] Instalando dependências Node..." -ForegroundColor Green
try {
    npm install 2>$null
} catch {
    Write-Host "⚠️ NPM não instalado, pulando..." -ForegroundColor Yellow
}

# 3. .env
Write-Host "[3/7] Configurando ambiente..." -ForegroundColor Green
if (-not (Test-Path .env)) {
    Copy-Item .env.example .env
    php artisan key:generate --ansi
}

# 4. Verificar DB
Write-Host "[4/7] Verificando conexão com banco..." -ForegroundColor Green
try {
    php artisan db:show 2>$null
} catch {
    Write-Host "⚠️ Configure o .env com dados do banco!" -ForegroundColor Yellow
}

# 5. Migrations
Write-Host "[5/7] Migrations" -ForegroundColor Green
$runMigrations = Read-Host "Executar migrations? (s/N)"
if ($runMigrations -eq 's' -or $runMigrations -eq 'S') {
    php artisan migrate --force
}

# 6. Seeds
Write-Host "[6/7] Seeds" -ForegroundColor Green
$runSeeds = Read-Host "Popular banco? (s/N)"
if ($runSeeds -eq 's' -or $runSeeds -eq 'S') {
    php artisan db:seed
}

# 7. Cache
Write-Host "[7/7] Limpando cache..." -ForegroundColor Green
php artisan optimize:clear

Write-Host ""
Write-Host "✅ Instalação concluída!" -ForegroundColor Green
Write-Host "Para iniciar: php artisan serve" -ForegroundColor Yellow
Write-Host ""

$startServer = Read-Host "Iniciar servidor agora? (s/N)"
if ($startServer -eq 's' -or $startServer -eq 'S') {
    php artisan serve
}
