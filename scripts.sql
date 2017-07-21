ALTER TABLE `carrera`
MODIFY COLUMN `nombre`  varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `id`,
ADD COLUMN `siglas`  varchar(10) NULL AFTER `nombre`;

ALTER TABLE `opcion_titulacion` DROP FOREIGN KEY `FK_opcion_plan`;

ALTER TABLE `opcion_titulacion`
DROP COLUMN `id_plan`;

SET FOREIGN_KEY_CHECKS = 0;
ALTER TABLE `opcion_titulacion`
MODIFY COLUMN `id`  int(11) NOT NULL AUTO_INCREMENT FIRST ;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `opcion_plan` (
`id`  int NOT NULL AUTO_INCREMENT ,
`id_plan`  int NULL ,
`id_opcion`  int NULL ,
PRIMARY KEY (`id`),
CONSTRAINT `FK_plan_opcion` FOREIGN KEY (`id_plan`) REFERENCES `plan_estudios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT `FK_titulacion_opcion` FOREIGN KEY (`id_opcion`) REFERENCES `opcion_titulacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE);