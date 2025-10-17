-- Remover constraints de chave estrangeira da tabela reservas
ALTER TABLE `reservas` DROP FOREIGN KEY `reservas_hotel_id_foreign`;

-- Opcional: também remover a constraint do user_id se causar problemas
-- ALTER TABLE `reservas` DROP FOREIGN KEY `reservas_user_id_foreign`;
