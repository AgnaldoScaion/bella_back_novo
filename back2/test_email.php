<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

echo "🔍 Testando configurações de email...\n\n";

// Verificar configurações
echo "MAIL_MAILER: " . config('mail.default') . "\n";
echo "MAIL_HOST: " . config('mail.mailers.smtp.host') . "\n";
echo "MAIL_PORT: " . config('mail.mailers.smtp.port') . "\n";
echo "MAIL_USERNAME: " . config('mail.mailers.smtp.username') . "\n";
echo "MAIL_ENCRYPTION: " . config('mail.mailers.smtp.encryption') . "\n";
echo "MAIL_FROM: " . config('mail.from.address') . "\n\n";

echo "📧 Tentando enviar email de teste...\n";

try {
    Mail::raw('Este é um email de teste do Bella Avventura.', function ($message) {
        $message->to(config('mail.mailers.smtp.username'))
                ->subject('🧪 Teste de Email - Bella Avventura');
    });

    echo "✅ Email enviado com sucesso!\n";
    echo "📬 Verifique a caixa de entrada de: " . config('mail.mailers.smtp.username') . "\n";

} catch (\Exception $e) {
    echo "❌ ERRO ao enviar email:\n";
    echo "Tipo: " . get_class($e) . "\n";
    echo "Mensagem: " . $e->getMessage() . "\n\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
