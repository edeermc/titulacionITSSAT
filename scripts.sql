ALTER TABLE `carrera`
MODIFY COLUMN `nombre`  varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `id`,
ADD COLUMN `siglas`  varchar(6) NULL AFTER `nombre`;

