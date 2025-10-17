# Sistema de Reservas - Bella Avventura

## 📧 Configuração de E-mail

Para que o sistema de confirmação de reservas por e-mail funcione corretamente, você precisa configurar as variáveis de ambiente no arquivo `.env`.

### Passo 1: Abrir o arquivo `.env`

Localize o arquivo `.env` na raiz do projeto `back2/`.

### Passo 2: Configurar as variáveis de e-mail

Adicione ou modifique as seguintes linhas:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu_email@gmail.com
MAIL_PASSWORD=sua_senha_de_aplicativo
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=bella.avventura@gmail.com
MAIL_FROM_NAME="Bella Avventura"
```

### Passo 3: Criar senha de aplicativo no Gmail

Se você estiver usando Gmail:

1. Acesse: https://myaccount.google.com/security
2. Ative a "Verificação em duas etapas"
3. Vá em "Senhas de app"
4. Selecione "E-mail" e "Outro (nome personalizado)"
5. Digite "Bella Avventura" e clique em "Gerar"
6. Copie a senha gerada (16 caracteres sem espaços)
7. Cole em `MAIL_PASSWORD` no arquivo `.env`

### Alternativas ao Gmail

#### Mailtrap (para testes)
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu_username_mailtrap
MAIL_PASSWORD=sua_senha_mailtrap
MAIL_ENCRYPTION=tls
```

#### Outlook/Hotmail
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.office365.com
MAIL_PORT=587
MAIL_USERNAME=seu_email@outlook.com
MAIL_PASSWORD=sua_senha
MAIL_ENCRYPTION=tls
```

### Passo 4: Limpar cache de configuração

Após modificar o `.env`, execute no terminal:

```powershell
php artisan config:clear
php artisan cache:clear
```

---

## 🗄️ Executar Migração do Banco de Dados

Para criar a tabela `reservas` no banco de dados:

```powershell
php artisan migrate
```

Se houver erro, você pode executar:

```powershell
php artisan migrate:fresh
```

⚠️ **ATENÇÃO:** `migrate:fresh` apaga todos os dados existentes!

---

## 🚀 Testando o Sistema de Reservas

1. **Acesse a página de hotéis:** http://localhost/bella_back_novo/back2/public/hoteis
2. **Clique em "Reservar" em algum hotel**
3. **Preencha o formulário de reserva:**
   - Selecione datas de check-in e check-out
   - Escolha o tipo de quarto
   - Informe o número de hóspedes
   - Adicione observações (opcional)
4. **Clique em "Confirmar Reserva"**
5. **Verifique seu e-mail** para o link de confirmação
6. **Clique no botão "Confirmar Reserva"** no e-mail

---

## 📋 Funcionalidades Implementadas

### Backend
✅ Migração da tabela `reservas`
✅ Model `Reserva` com relationships
✅ Controller `ReservaController` com CRUD completo
✅ Sistema de envio de e-mails com `ReservaConfirmacao` Mailable
✅ Geração automática de código de confirmação
✅ Cálculo automático de preços (base + tipo de quarto)
✅ Política de cancelamento (48h antes do check-in)

### Frontend
✅ Página de criação de reserva (`reservas/create.blade.php`)
✅ Página de sucesso após reserva (`reservas/sucesso.blade.php`)
✅ Página "Minhas Reservas" com filtros (`reservas/minhas.blade.php`)
✅ Página de confirmação da reserva (`reservas/confirmada.blade.php`)
✅ Template de e-mail HTML responsivo (`emails/reserva-confirmacao.blade.php`)

### Rotas
✅ `GET /reservas/create/{hotel}` - Formulário de reserva
✅ `POST /reservas` - Criar nova reserva
✅ `GET /reservas/sucesso/{id}` - Página de sucesso
✅ `GET /reservas/confirmar/{codigo}` - Confirmar por código
✅ `GET /minhas-reservas` - Listar reservas do usuário
✅ `POST /reservas/{id}/cancelar` - Cancelar reserva

---

## 🔧 Solução de Problemas

### E-mails não estão sendo enviados

1. Verifique se configurou corretamente o `.env`
2. Execute: `php artisan config:clear`
3. Teste com Mailtrap antes de usar e-mail real
4. Verifique os logs em `storage/logs/laravel.log`

### Erro de tabela não encontrada

```powershell
php artisan migrate
```

### Erro de foreign key

Certifique-se que as tabelas `usuario` e `hotel` existem antes de executar a migration de `reservas`.

---

## 📞 Suporte

Para dúvidas ou problemas, consulte a documentação do Laravel:
- https://laravel.com/docs/mail
- https://laravel.com/docs/migrations
- https://laravel.com/docs/eloquent-relationships
