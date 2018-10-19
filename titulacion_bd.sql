/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 100125
Source Host           : localhost:3306
Source Database       : titulacion

Target Server Type    : MYSQL
Target Server Version : 100125
File Encoding         : 65001

Date: 2018-10-18 21:39:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for carrera
-- ----------------------------
DROP TABLE IF EXISTS `carrera`;
CREATE TABLE `carrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `siglas` varchar(10) DEFAULT NULL,
  `modalidad` enum('Escolarizado','Semiescolarizado') DEFAULT 'Escolarizado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of carrera
-- ----------------------------
INSERT INTO `carrera` VALUES ('1', 'Ingeniería Industrial', 'IIND', 'Escolarizado');
INSERT INTO `carrera` VALUES ('2', 'Ingeniería Electromecánica', 'IEME', 'Escolarizado');
INSERT INTO `carrera` VALUES ('3', 'Licenciatura en Informática', 'LINF', 'Escolarizado');
INSERT INTO `carrera` VALUES ('4', 'Ingeniería en Sistemas Computacionales', 'ISI', 'Escolarizado');
INSERT INTO `carrera` VALUES ('5', 'Licenciatura en Administración', 'LADM', 'Escolarizado');
INSERT INTO `carrera` VALUES ('6', 'Ingeniería Ambiental', 'IAMB', 'Escolarizado');
INSERT INTO `carrera` VALUES ('7', 'Ingeniería en Gestión Empresarial', 'IGEM', 'Escolarizado');
INSERT INTO `carrera` VALUES ('8', 'Ingeniería en Sistemas Computacionales', 'ISIC-SEMI', 'Semiescolarizado');
INSERT INTO `carrera` VALUES ('9', 'Licenciatura en Administración', 'LADM-SEMI', 'Semiescolarizado');
INSERT INTO `carrera` VALUES ('10', 'Ingeniería Informática', 'IINF', 'Escolarizado');
INSERT INTO `carrera` VALUES ('11', 'Ingeniería Mecatrónica', 'IMCT', 'Escolarizado');

-- ----------------------------
-- Table structure for configuracion
-- ----------------------------
DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) DEFAULT NULL,
  `configuracion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of configuracion
-- ----------------------------

-- ----------------------------
-- Table structure for division
-- ----------------------------
DROP TABLE IF EXISTS `division`;
CREATE TABLE `division` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of division
-- ----------------------------
INSERT INTO `division` VALUES ('1', 'Sistemas');
INSERT INTO `division` VALUES ('2', 'Ciencias básicas');
INSERT INTO `division` VALUES ('3', 'Ambiental');
INSERT INTO `division` VALUES ('4', 'Industrial');
INSERT INTO `division` VALUES ('5', 'administración');
INSERT INTO `division` VALUES ('6', 'Informática');
INSERT INTO `division` VALUES ('7', 'Administración');

-- ----------------------------
-- Table structure for docente
-- ----------------------------
DROP TABLE IF EXISTS `docente`;
CREATE TABLE `docente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  `apellido_paterno` varchar(30) DEFAULT NULL,
  `apellido_materno` varchar(30) DEFAULT NULL,
  `sexo` enum('H','M') DEFAULT 'H',
  `cedula_profesional` varchar(20) DEFAULT NULL,
  `estatus` enum('Si','No') DEFAULT NULL,
  `id_division` int(11) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `tipo` enum('Docente','Presidente','Secretario','JefeCarrera') DEFAULT 'Docente',
  PRIMARY KEY (`id`),
  KEY `FK_docente_division` (`id_division`),
  KEY `FK_docente_carrera` (`id_carrera`),
  CONSTRAINT `FK_docente_carrera` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_docente_division` FOREIGN KEY (`id_division`) REFERENCES `division` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of docente
-- ----------------------------
INSERT INTO `docente` VALUES ('1', 'Edér', 'Morga', 'Camacho', 'H', '12345678', 'Si', '1', '6', 'Docente');
INSERT INTO `docente` VALUES ('2', 'Emmanuel', 'Chigo', 'Malaga', 'H', '0987654', 'No', '2', '4', 'JefeCarrera');
INSERT INTO `docente` VALUES ('3', 'Sarahí', 'Cobá', 'Acua', 'M', '12345678', 'No', '2', '4', 'Secretario');
INSERT INTO `docente` VALUES ('4', 'Fulanito', 'Perengano', 'Cebollano', 'H', '12345678', 'Si', '3', '4', 'Presidente');

-- ----------------------------
-- Table structure for documento_alumno
-- ----------------------------
DROP TABLE IF EXISTS `documento_alumno`;
CREATE TABLE `documento_alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_control` varchar(8) DEFAULT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `estatus` enum('Pendiente','Aprobado','Rechazado') DEFAULT 'Pendiente',
  PRIMARY KEY (`id`),
  KEY `FK_documento_egresado` (`n_control`),
  KEY `FK_documento_tipo` (`id_tipo_documento`),
  CONSTRAINT `FK_documento_egresado` FOREIGN KEY (`n_control`) REFERENCES `egresados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_documento_tipo` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of documento_alumno
-- ----------------------------
INSERT INTO `documento_alumno` VALUES ('4', '211U1234', 'f77fd53d83448743bde4da46dbc9eee1.pdf', '2', 'Aprobado');
INSERT INTO `documento_alumno` VALUES ('5', '211U1234', 'ac0acbf5e0c26e706113c4e84a40f4d4.pdf', '3', 'Aprobado');
INSERT INTO `documento_alumno` VALUES ('6', '211U1234', '8a95e101c878f2d6350e1d4571ffc3d0.pdf', '4', 'Rechazado');
INSERT INTO `documento_alumno` VALUES ('20', '121U0123', '9a22492f99fcd68b076b0678b71fadff.pdf', '3', 'Aprobado');
INSERT INTO `documento_alumno` VALUES ('21', '121U0123', '5af4015bc067c69bf56ec73000b5d2fb.pdf', '1', 'Aprobado');
INSERT INTO `documento_alumno` VALUES ('22', '121U0123', 'f0d2afb53fe2f2cd072d513f7835f6af.pdf', '2', 'Aprobado');
INSERT INTO `documento_alumno` VALUES ('24', '151U0254', '969b57e9ca345c6abcc8eda28e61af07.pdf', '2', 'Aprobado');
INSERT INTO `documento_alumno` VALUES ('25', '121U0229', 'aa17a360c9422e746855600f22902b68.pdf', '1', 'Aprobado');
INSERT INTO `documento_alumno` VALUES ('26', '121U0229', 'b1498c904339ec911d3e287ef96849a2.pdf', '2', 'Aprobado');
INSERT INTO `documento_alumno` VALUES ('27', '121U0229', '2ad3c4be603258710037c8edfeff213a.pdf', '3', 'Aprobado');
INSERT INTO `documento_alumno` VALUES ('28', '121U0230', '0f95b2f121f2e9aba35d755dfac9d2f4.pdf', '1', 'Aprobado');
INSERT INTO `documento_alumno` VALUES ('29', '121U0230', '8aa07cd4b6a81edf176bc2f0a7cbe5d0.pdf', '2', 'Aprobado');

-- ----------------------------
-- Table structure for egresados
-- ----------------------------
DROP TABLE IF EXISTS `egresados`;
CREATE TABLE `egresados` (
  `id` varchar(8) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `apellido_paterno` varchar(30) DEFAULT NULL,
  `apellido_materno` varchar(30) DEFAULT NULL,
  `sexo` enum('H','M') DEFAULT 'H',
  `id_plan` int(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `colonia` varchar(255) DEFAULT NULL,
  `cp` varchar(6) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `municipio` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `numero_libro` int(11) DEFAULT NULL,
  `numero_foja` int(11) DEFAULT NULL,
  `periodo_ingreso` int(4) DEFAULT NULL,
  `periodo_egreso` int(4) DEFAULT NULL,
  `id_proyecto` int(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `estatus` enum('Registro','Recuperacion','Activo','Titulado') DEFAULT 'Registro',
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_egresados_plan` (`id_plan`),
  KEY `FK_egresados_proyecto` (`id_proyecto`),
  CONSTRAINT `FK_egresados_plan` FOREIGN KEY (`id_plan`) REFERENCES `plan_estudios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_egresados_proyecto` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of egresados
-- ----------------------------
INSERT INTO `egresados` VALUES ('121U0123', 'Jose', 'Perez', 'Pérez', 'H', '17', 'José María Mata #117', 'Chichipilco', '95746', 'San Andrés Tuxtla', 'San Andrés Tuxtla', 'Veracruz', '2941001234', null, '', null, null, '987', '6543', '1', null, 'Registro', null);
INSERT INTO `egresados` VALUES ('121U0229', 'Eder', 'Morga', 'Camacho', 'H', '11', 'José María Mata #117', 'Chichipilco', '95746', 'San Andrés Tuxtla', 'San Andrés Tuxtla', 'Veracruz', '2941373534', 'edeermc@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', null, null, '1234', '5678', '1', '', 'Activo', '2018-09-01 15:01:14');
INSERT INTO `egresados` VALUES ('121U0230', 'Eder', 'Morga', 'Camacho', 'H', '11', 'José María Mata #117', 'Chichipilc', '95746', 'San Andres', 'San Andres', 'Veracruz', '1234567890', 'edeermc@gmail.com', '331382460d902d1341dc73db8b990f97', null, null, '2346', '2120', '11', '', 'Activo', '2018-09-01 15:05:19');
INSERT INTO `egresados` VALUES ('151U0254', 'Juan de Jesús', 'Isidoro', 'Cobix', 'H', '11', 'Catemburgo', 'Catemaquense', '01234', 'Catemaco', 'Catemaco', 'Veracruz', '1234567890', 'juan@gmail.com', '331382460d902d1341dc73db8b990f97', null, null, '1112', '1116', '5', '', 'Activo', '2018-08-26 18:47:31');
INSERT INTO `egresados` VALUES ('211U1234', 'David', 'Domínguez', 'Chigo', 'M', '20', 'xxxxxxx', 'xxxxx', '12345', 'xxxxxx', 'xxxx', 'xxxxx', '1234567890', null, null, null, null, '2346', '8931', '7', '', 'Registro', null);

-- ----------------------------
-- Table structure for notificacion
-- ----------------------------
DROP TABLE IF EXISTS `notificacion`;
CREATE TABLE `notificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `leido` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notificacion
-- ----------------------------

-- ----------------------------
-- Table structure for opcion_documento
-- ----------------------------
DROP TABLE IF EXISTS `opcion_documento`;
CREATE TABLE `opcion_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_opcion` int(11) DEFAULT NULL,
  `id_documento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_documento_opcion` (`id_documento`),
  KEY `FK_opcion_documento` (`id_opcion`),
  CONSTRAINT `FK_documento_opcion` FOREIGN KEY (`id_documento`) REFERENCES `tipo_documento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_opcion_documento` FOREIGN KEY (`id_opcion`) REFERENCES `opcion_titulacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of opcion_documento
-- ----------------------------
INSERT INTO `opcion_documento` VALUES ('3', '3', '1');
INSERT INTO `opcion_documento` VALUES ('6', '7', '4');
INSERT INTO `opcion_documento` VALUES ('7', '9', '3');
INSERT INTO `opcion_documento` VALUES ('19', '1', '2');
INSERT INTO `opcion_documento` VALUES ('20', '1', '3');
INSERT INTO `opcion_documento` VALUES ('21', '1', '4');
INSERT INTO `opcion_documento` VALUES ('22', '1', '7');
INSERT INTO `opcion_documento` VALUES ('23', '2', '1');
INSERT INTO `opcion_documento` VALUES ('24', '2', '2');
INSERT INTO `opcion_documento` VALUES ('25', '2', '3');
INSERT INTO `opcion_documento` VALUES ('26', '2', '4');

-- ----------------------------
-- Table structure for opcion_plan
-- ----------------------------
DROP TABLE IF EXISTS `opcion_plan`;
CREATE TABLE `opcion_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_plan` int(11) DEFAULT NULL,
  `id_opcion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_plan_opcion` (`id_plan`),
  KEY `FK_titulacion_opcion` (`id_opcion`),
  CONSTRAINT `FK_plan_opcion` FOREIGN KEY (`id_plan`) REFERENCES `plan_estudios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_titulacion_opcion` FOREIGN KEY (`id_opcion`) REFERENCES `opcion_titulacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of opcion_plan
-- ----------------------------
INSERT INTO `opcion_plan` VALUES ('20', '1', '3');
INSERT INTO `opcion_plan` VALUES ('21', '11', '3');
INSERT INTO `opcion_plan` VALUES ('22', '7', '3');
INSERT INTO `opcion_plan` VALUES ('23', '8', '3');
INSERT INTO `opcion_plan` VALUES ('24', '9', '3');
INSERT INTO `opcion_plan` VALUES ('25', '12', '3');
INSERT INTO `opcion_plan` VALUES ('29', '11', '4');
INSERT INTO `opcion_plan` VALUES ('30', '11', '2');
INSERT INTO `opcion_plan` VALUES ('31', '1', '7');
INSERT INTO `opcion_plan` VALUES ('32', '4', '7');
INSERT INTO `opcion_plan` VALUES ('33', '12', '7');
INSERT INTO `opcion_plan` VALUES ('34', '6', '9');
INSERT INTO `opcion_plan` VALUES ('35', '8', '9');
INSERT INTO `opcion_plan` VALUES ('88', '1', '1');
INSERT INTO `opcion_plan` VALUES ('89', '3', '1');
INSERT INTO `opcion_plan` VALUES ('90', '5', '1');
INSERT INTO `opcion_plan` VALUES ('91', '6', '1');
INSERT INTO `opcion_plan` VALUES ('92', '8', '1');
INSERT INTO `opcion_plan` VALUES ('93', '9', '1');
INSERT INTO `opcion_plan` VALUES ('94', '10', '1');
INSERT INTO `opcion_plan` VALUES ('95', '14', '1');
INSERT INTO `opcion_plan` VALUES ('96', '16', '1');
INSERT INTO `opcion_plan` VALUES ('97', '17', '1');
INSERT INTO `opcion_plan` VALUES ('98', '18', '1');
INSERT INTO `opcion_plan` VALUES ('99', '19', '1');
INSERT INTO `opcion_plan` VALUES ('100', '20', '1');
INSERT INTO `opcion_plan` VALUES ('101', '21', '1');

-- ----------------------------
-- Table structure for opcion_titulacion
-- ----------------------------
DROP TABLE IF EXISTS `opcion_titulacion`;
CREATE TABLE `opcion_titulacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of opcion_titulacion
-- ----------------------------
INSERT INTO `opcion_titulacion` VALUES ('1', 'Tesis');
INSERT INTO `opcion_titulacion` VALUES ('2', 'Memoria de residencias');
INSERT INTO `opcion_titulacion` VALUES ('3', 'Por promedio');
INSERT INTO `opcion_titulacion` VALUES ('4', 'Examen CENEVAL');
INSERT INTO `opcion_titulacion` VALUES ('6', 'Por donación');
INSERT INTO `opcion_titulacion` VALUES ('7', 'Gratis');
INSERT INTO `opcion_titulacion` VALUES ('8', 'Extracurricular');
INSERT INTO `opcion_titulacion` VALUES ('9', 'sdfadfd');

-- ----------------------------
-- Table structure for perfil
-- ----------------------------
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) DEFAULT NULL,
  `modulo` text,
  `permiso` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of perfil
-- ----------------------------
INSERT INTO `perfil` VALUES ('1', 'Administrador', '1|1|1|1|1|1|1|1|1|1|1|1', '3|3|3|3|3|3|3|3|3|3|3|3');

-- ----------------------------
-- Table structure for plan_estudios
-- ----------------------------
DROP TABLE IF EXISTS `plan_estudios`;
CREATE TABLE `plan_estudios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_plan_carrera` (`id_carrera`),
  CONSTRAINT `FK_plan_carrera` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of plan_estudios
-- ----------------------------
INSERT INTO `plan_estudios` VALUES ('1', 'IIND-1993-297', '1');
INSERT INTO `plan_estudios` VALUES ('2', 'IIND-2004-297', '1');
INSERT INTO `plan_estudios` VALUES ('3', 'IIND-2010-227', '1');
INSERT INTO `plan_estudios` VALUES ('4', 'IEME-1993-291', '2');
INSERT INTO `plan_estudios` VALUES ('5', 'IEME-2005-291', '2');
INSERT INTO `plan_estudios` VALUES ('6', 'IEME-2010-210', '2');
INSERT INTO `plan_estudios` VALUES ('7', 'LINF-1993-303', '3');
INSERT INTO `plan_estudios` VALUES ('8', 'LINF-2004-303', '3');
INSERT INTO `plan_estudios` VALUES ('9', 'ISIC-1993-296', '4');
INSERT INTO `plan_estudios` VALUES ('10', 'ISIC-2004-296', '4');
INSERT INTO `plan_estudios` VALUES ('11', 'ISIC-2010-224', '4');
INSERT INTO `plan_estudios` VALUES ('12', 'LADM-1993-300', '5');
INSERT INTO `plan_estudios` VALUES ('13', 'LADM-2004-300', '5');
INSERT INTO `plan_estudios` VALUES ('14', 'LADM-2010-234', '5');
INSERT INTO `plan_estudios` VALUES ('15', 'IAMB-2004-286', '6');
INSERT INTO `plan_estudios` VALUES ('16', 'IAMB-2010-206', '6');
INSERT INTO `plan_estudios` VALUES ('17', 'IGEM-2009-201', '7');
INSERT INTO `plan_estudios` VALUES ('18', 'ISIC-2010-224', '8');
INSERT INTO `plan_estudios` VALUES ('19', 'LADM-2010-234', '9');
INSERT INTO `plan_estudios` VALUES ('20', 'IINF-2010-220', '10');
INSERT INTO `plan_estudios` VALUES ('21', 'IMCT-2010-229', '11');

-- ----------------------------
-- Table structure for proyecto
-- ----------------------------
DROP TABLE IF EXISTS `proyecto`;
CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `id_opcion` int(11) DEFAULT NULL,
  `id_presidente` int(11) DEFAULT NULL,
  `id_secretario` int(11) DEFAULT NULL,
  `id_vocal` int(11) DEFAULT NULL,
  `id_vocal_suplente` int(11) DEFAULT NULL,
  `id_asesor` int(11) DEFAULT NULL,
  `id_asesor2` int(11) DEFAULT NULL,
  `observaciones` text,
  `id_presidenteacademia` int(11) DEFAULT NULL,
  `id_secretarioacademia` int(11) DEFAULT NULL,
  `id_jefecarrera` int(11) DEFAULT NULL,
  `fecha_liberacion` date DEFAULT NULL,
  `fecha_notificacion` date DEFAULT NULL,
  `estatus` enum('Revision','Abierto','Cerrado') DEFAULT 'Abierto',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UN_proyecto_nombre` (`nombre`),
  KEY `FK_proyecto_presidente` (`id_presidente`),
  KEY `FK_proyecto_secretario` (`id_secretario`),
  KEY `FK_proyecto_vocal` (`id_vocal`),
  KEY `FK_proyecto_vocal2` (`id_vocal_suplente`),
  KEY `FK_proyecto_asesor` (`id_asesor`),
  KEY `FK_proyecto_asesor2` (`id_asesor2`),
  KEY `FK_proyecto_presidenteacademia` (`id_presidenteacademia`),
  KEY `FK_proyecto_opcion` (`id_opcion`),
  KEY `FK_proyecto_secretarioacademia` (`id_secretarioacademia`),
  KEY `FK_proyecto_jefecarrera` (`id_jefecarrera`),
  CONSTRAINT `FK_proyecto_asesor` FOREIGN KEY (`id_asesor`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_proyecto_asesor2` FOREIGN KEY (`id_asesor2`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_proyecto_jefecarrera` FOREIGN KEY (`id_jefecarrera`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_proyecto_opcion` FOREIGN KEY (`id_opcion`) REFERENCES `opcion_titulacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_proyecto_presidente` FOREIGN KEY (`id_presidente`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_proyecto_presidenteacademia` FOREIGN KEY (`id_presidenteacademia`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_proyecto_secretario` FOREIGN KEY (`id_secretario`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_proyecto_secretarioacademia` FOREIGN KEY (`id_secretarioacademia`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_proyecto_vocal` FOREIGN KEY (`id_vocal`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_proyecto_vocal2` FOREIGN KEY (`id_vocal_suplente`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of proyecto
-- ----------------------------
INSERT INTO `proyecto` VALUES ('1', 'Sistema web para academia de inglés', '2', '1', '2', '4', '3', '1', '2', 'muy bonito\r\n------\r\nASAP', '3', '1', '2', '0000-00-00', '0000-00-00', 'Abierto');
INSERT INTO `proyecto` VALUES ('2', 'Inventarios', null, null, null, null, null, null, null, null, null, null, null, null, null, 'Abierto');
INSERT INTO `proyecto` VALUES ('3', 'Nominas', null, null, null, null, null, null, null, 'sdffjkhfkñlgfdfsdfhgjghkjghjj\r\n', null, null, null, '0000-00-00', '0000-00-00', 'Abierto');
INSERT INTO `proyecto` VALUES ('5', 'Tesis del sentido de la vida', '2', null, null, null, null, null, null, 'XXXXXXXXXXXXXXXXXXXXXXXX', '4', '3', '2', '0000-00-00', '0000-00-00', 'Abierto');
INSERT INTO `proyecto` VALUES ('6', 'Tesis de cantidad de truza', '1', null, null, null, null, null, null, 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX\r\nXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', null, null, null, '0000-00-00', '0000-00-00', 'Abierto');
INSERT INTO `proyecto` VALUES ('7', 'Proyecto x', '1', null, null, null, null, null, null, '', '3', '4', '1', null, null, 'Abierto');
INSERT INTO `proyecto` VALUES ('10', 'Medicion de la truza', null, null, null, null, null, null, null, 'xxx\r\nxx\r\nx', null, null, null, null, null, 'Abierto');
INSERT INTO `proyecto` VALUES ('11', 'Proyecto prueba ', '2', null, null, null, null, null, null, null, '4', '3', '2', null, null, 'Abierto');

-- ----------------------------
-- Table structure for tipo_documento
-- ----------------------------
DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tipo_documento
-- ----------------------------
INSERT INTO `tipo_documento` VALUES ('1', 'Boleta');
INSERT INTO `tipo_documento` VALUES ('2', 'Certificado de inglés');
INSERT INTO `tipo_documento` VALUES ('3', 'Liberación de servicio');
INSERT INTO `tipo_documento` VALUES ('4', 'Fotos');
INSERT INTO `tipo_documento` VALUES ('5', 'Extraescolares');
INSERT INTO `tipo_documento` VALUES ('6', 'Certificado médico');
INSERT INTO `tipo_documento` VALUES ('7', 'Paracetamol');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) DEFAULT NULL,
  `contrasena` varchar(50) DEFAULT NULL,
  `nombre` varchar(70) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usuario_perfil` (`id_perfil`),
  KEY `FK_usuario_docente` (`id_docente`),
  CONSTRAINT `FK_usuario_docente` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_usuario_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'edeermc', 'e10adc3949ba59abbe56e057f20f883e', 'Eder Morga', 'edeermc@gmail.com', '1', null, '2018-09-05 16:04:14');
INSERT INTO `usuario` VALUES ('2', 'e_docente', 'e10adc3949ba59abbe56e057f20f883e', 'Eder Morga Camacho', 'emc@sicemex.com', '1', '1', null);
INSERT INTO `usuario` VALUES ('3', 'echigo', 'e10adc3949ba59abbe56e057f20f883e', 'Emmanuel Chigo', 'echigo@gmail.com', '1', '2', null);
