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


ALTER TABLE `egresados`
CHANGE COLUMN `n_control` `id`  varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL FIRST ;


/* 19/08/2017 */
ALTER TABLE `proyecto`
ADD COLUMN `estatus`  enum('Abierto','Cerrado') NULL DEFAULT 'Abierto' AFTER `fecha_notificacion`;

ALTER TABLE `docente`
ADD COLUMN `tipo`  enum('Docente','Presidente','Secretario','JefeCarrera') NULL DEFAULT 'Docente' AFTER `id_carrera`;

CREATE TABLE `notificacion` (
  `id`  int NOT NULL AUTO_INCREMENT ,
  `mensaje`  varchar(255) NULL ,
  `usuario`  varchar(255) NULL ,
  `leido`  varchar(255) NULL ,
  `fecha`  datetime NULL ,
  PRIMARY KEY (`id`)
);

ALTER TABLE `proyecto`
ADD COLUMN `id_secretarioacademia`  int NULL AFTER `id_presidenteacademia`,
ADD COLUMN `id_jefecarrera`  int NULL AFTER `id_secretarioacademia`;

ALTER TABLE `proyecto` ADD CONSTRAINT `FK_proyecto_secretarioacademia` FOREIGN KEY (`id_secretarioacademia`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `proyecto` ADD CONSTRAINT `FK_proyecto_jefecarrera` FOREIGN KEY (`id_jefecarrera`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/* 20/08/2017 */
ALTER TABLE `documento_alumno`
MODIFY COLUMN `estatus`  enum('Pendiente','Aprobado','Rechazado') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Pendiente' AFTER `id_tipo_documento`;

/* 21/08/2017 */
ALTER TABLE `egresados`
MODIFY COLUMN `numero_libro`  int(11) NULL DEFAULT NULL AFTER `id_plan`,
MODIFY COLUMN `numero_foja`  int(11) NULL DEFAULT NULL AFTER `numero_libro`,
MODIFY COLUMN `periodo_ingreso`  int(4) NULL DEFAULT NULL AFTER `numero_foja`,
MODIFY COLUMN `periodo_egreso`  int(4) NULL DEFAULT NULL AFTER `periodo_ingreso`,
ADD COLUMN `calle`  varchar(255) NULL AFTER `id_plan`,
ADD COLUMN `colonia`  varchar(255) NULL AFTER `calle`,
ADD COLUMN `cp`  varchar(255) NULL AFTER `colonia`,
ADD COLUMN `ciudad`  varchar(255) NULL AFTER `cp`,
ADD COLUMN `municipio`  varchar(255) NULL AFTER `ciudad`,
ADD COLUMN `estado`  varchar(255) NULL AFTER `municipio`,
ADD COLUMN `telefono`  varchar(10) NULL AFTER `estado`,
ADD COLUMN `correo`  varchar(100) NULL AFTER `telefono`,
ADD COLUMN `contrasena`  varchar(255) NULL AFTER `correo`;
ADD COLUMN `token`  varchar(255) NULL AFTER `id_proyecto`;
ADD COLUMN `estatus`  enum('Registro','Recuperacion','Activo','Titulado') NULL DEFAULT 'Registro' AFTER `token`;


ALTER TABLE `proyecto`
ADD UNIQUE INDEX `UN_proyecto_nombre` (`nombre`) ;

