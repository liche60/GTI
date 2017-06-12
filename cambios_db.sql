CREATE TABLE `new_lider_contratos` (
  `codigo` varchar(45) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `id_lider` varchar(45) NOT NULL,
  PRIMARY KEY (`codigo`,`id_lider`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `new_personas` (
  `cedula` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `proyecto` varchar(100) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `jefe` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `correo_personal` varchar(100) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `new_personas` 
CHARACTER SET = utf8 , COLLATE = utf8_spanish_ci ;
ALTER TABLE `new_personas` 
CHANGE COLUMN `nombre` `nombre` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `proyecto` `proyecto` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `cargo` `cargo` VARCHAR(45) NULL DEFAULT NULL ,
CHANGE COLUMN `jefe` `jefe` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `correo` `correo` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `correo_personal` `correo_personal` VARCHAR(100) NULL DEFAULT NULL ,
CHANGE COLUMN `celular` `celular` VARCHAR(45) NULL DEFAULT NULL ;


CREATE TABLE `new_proyectos` (
  `codigo` varchar(45) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `registro_actividad` 
DROP FOREIGN KEY `contratoFK`;

ALTER TABLE `registro_actividad` 
CHANGE COLUMN `id_contrato` `id_contrato` VARCHAR(45) NOT NULL ,
DROP INDEX `id_contrato` ;

ALTER TABLE `registro_actividad` CHANGE COLUMN `id_contrato` `id_contrato` VARCHAR(45) NOT NULL ;

ALTER TABLE `usuario` ADD COLUMN `fecha_control` DATE NULL AFTER `habilidades`;

-- update usuario set fecha_control = "<fecha de control>"; aplicar como fecha de control


-- Carlos lopez 06/03/2017 - aplicado arus
-- Carlos lopez 06/03/2017 - aplicado casa


ALTER SCHEMA `<db>`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_spanish_ci ;

ALTER TABLE `registro_actividad` 
CHARACTER SET = utf8 , COLLATE = utf8_unicode_ci ;

ALTER TABLE `new_proyectos` 
CHARACTER SET = utf8 , COLLATE = utf8_unicode_ci ;

ALTER TABLE `usuario` 
COLLATE = utf8_unicode_ci ;

-- proceso de creaci�n de usuarios

-- 1. renombrar table usuario a usuario_tmp
ALTER TABLE `usuario` RENAME TO  `usuario_tmp` ;
-- 2. se crea tabla new_usuario con los campos de usuario
create table new_usuario as SELECT u.id,p.cedula,p.correo,u.cargo_id as rol,u.password,u.estado,u.fecha_control,u.area FROM new_personas p ,usuario_tmp u where u.correo = p.correo;
-- 3. se altera la tabla de registro_actividad incluyendo la cedula del usuario
ALTER TABLE `registro_actividad` ADD COLUMN `cedula` VARCHAR(45) NULL AFTER `tiempo_calculado`;
-- 4. actualizar cedulas en registro_actividad
update registro_actividad p set cedula = (select u.cedula from new_usuario u where u.id = p.user_id )

ALTER TABLE `gti`.`registro_actividad` 
CHANGE COLUMN `id_contrato` `id_contrato` VARCHAR(45) NOT NULL ;


-- Carlos lopez 07/03/2017 - aplicado arus


-- ==================================================



ALTER TABLE `gti`.`proyecto` 
CHARACTER SET = utf8 , COLLATE = utf8_spanish_ci ;

ALTER TABLE `gti`.`proyecto` 
CHANGE COLUMN `proyecto` `proyecto` VARCHAR(80) NOT NULL ,
CHANGE COLUMN `estado` `estado` VARCHAR(5) NOT NULL ;

ALTER TABLE `gti`.`proyecto` 
ADD COLUMN `codigo` VARCHAR(45) NULL AFTER `grupo`;


UPDATE `gti`.`proyecto` SET `codigo`='C-G013-02' WHERE `id`='1';
UPDATE `gti`.`proyecto` SET `codigo`='C-G016-03' WHERE `id`='2';
UPDATE `gti`.`proyecto` SET `codigo`='C-S342-01' WHERE `id`='3';
UPDATE `gti`.`proyecto` SET `codigo`='C-G021-01' WHERE `id`='5';
UPDATE `gti`.`proyecto` SET `codigo`='C-G010-01' WHERE `id`='10';
UPDATE `gti`.`proyecto` SET `codigo`='C-0170-01' WHERE `id`='12';
UPDATE `gti`.`proyecto` SET `codigo`='C-0164-01' WHERE `id`='13';
UPDATE `gti`.`proyecto` SET `codigo`='O-0001-22' WHERE `id`='16';
UPDATE `gti`.`proyecto` SET `codigo`='C-G017-01' WHERE `id`='19';
UPDATE `gti`.`proyecto` SET `codigo`='C-0052-01' WHERE `id`='20';
UPDATE `gti`.`proyecto` SET `codigo`='C-G020-01' WHERE `id`='22';
UPDATE `gti`.`proyecto` SET `codigo`='C-G024-01' WHERE `id`='23';
UPDATE `gti`.`proyecto` SET `codigo`='C-G029-01' WHERE `id`='25';
UPDATE `gti`.`proyecto` SET `codigo`='C-G018-01' WHERE `id`='29';
UPDATE `gti`.`proyecto` SET `codigo`='C-G057-01' WHERE `id`='30';
UPDATE `gti`.`proyecto` SET `codigo`='C-G074-01' WHERE `id`='31';
UPDATE `gti`.`proyecto` SET `codigo`='C-0083-02' WHERE `id`='32';
UPDATE `gti`.`proyecto` SET `codigo`='C-G037-01' WHERE `id`='33';
UPDATE `gti`.`proyecto` SET `codigo`='C-0071-03' WHERE `id`='34';
UPDATE `gti`.`proyecto` SET `codigo`='C-G052-04' WHERE `id`='37';
UPDATE `gti`.`proyecto` SET `codigo`='C-G010-01' WHERE `id`='39';
UPDATE `gti`.`proyecto` SET `codigo`='C-G044-01' WHERE `id`='40';
UPDATE `gti`.`proyecto` SET `codigo`='C-0102-01' WHERE `id`='50';
UPDATE `gti`.`proyecto` SET `codigo`='C-G001-05' WHERE `id`='4';
UPDATE `gti`.`proyecto` SET `codigo`='C-G043-02' WHERE `id`='7';
UPDATE `gti`.`proyecto` SET `codigo`='C-G046-02' WHERE `id`='14';
UPDATE `gti`.`proyecto` SET `codigo`='C-G056-01' WHERE `id`='17';
UPDATE `gti`.`proyecto` SET `codigo`='C-G008-01' WHERE `id`='35';
UPDATE `gti`.`proyecto` SET `codigo`='C-G040-03' WHERE `id`='36';
UPDATE `gti`.`proyecto` SET `codigo`='C-G031-01' WHERE `id`='47';
UPDATE `gti`.`proyecto` SET `codigo`='C-G023-01' WHERE `id`='11';
UPDATE `gti`.`proyecto` SET `codigo`='C-G012-05' WHERE `id`='21';
UPDATE `gti`.`proyecto` SET `codigo`='C-U017-01' WHERE `id`='27';
UPDATE `gti`.`proyecto` SET `codigo`='C-U013-02' WHERE `id`='48';
UPDATE `gti`.`proyecto` SET `codigo`='C-P002-01' WHERE `id`='52';
UPDATE `gti`.`proyecto` SET `codigo`='C-0108-01' WHERE `id`='53';
UPDATE `gti`.`proyecto` SET `codigo`='C-0107-03' WHERE `id`='54';
UPDATE `gti`.`proyecto` SET `codigo`='C-I001-SG' WHERE `id`='55';
UPDATE `gti`.`proyecto` SET `codigo`='C-S055-03' WHERE `id`='56';
UPDATE `gti`.`proyecto` SET `codigo`='C-0092-02' WHERE `id`='57';
UPDATE `gti`.`proyecto` SET `codigo`='C-G047-02' WHERE `id`='58';
UPDATE `gti`.`proyecto` SET `codigo`='C-G009-01' WHERE `id`='59';
UPDATE `gti`.`proyecto` SET `codigo`='C-0167-01' WHERE `id`='60';
UPDATE `gti`.`proyecto` SET `codigo`='C-P002-01' WHERE `id`='62';
UPDATE `gti`.`proyecto` SET `codigo`='C-0108-01' WHERE `id`='63';
UPDATE `gti`.`proyecto` SET `codigo`='C-G015-01' WHERE `id`='64';
UPDATE `gti`.`proyecto` SET `codigo`='C-0213-04' WHERE `id`='65';
UPDATE `gti`.`proyecto` SET `codigo`='C-G041-01' WHERE `id`='66';
UPDATE `gti`.`proyecto` SET `codigo`='C-G045-01' WHERE `id`='67';
UPDATE `gti`.`proyecto` SET `codigo`='C-G062-01' WHERE `id`='68';
UPDATE `gti`.`proyecto` SET `codigo`='C-S005-01' WHERE `id`='69';
UPDATE `gti`.`proyecto` SET `codigo`='C-G025-01' WHERE `id`='70';
UPDATE `gti`.`proyecto` SET `codigo`='C-S290-01' WHERE `id`='71';
UPDATE `gti`.`proyecto` SET `codigo`='C-G011-01' WHERE `id`='73';
UPDATE `gti`.`proyecto` SET `codigo`='C-S133-01' WHERE `id`='77';
UPDATE `gti`.`proyecto` SET `codigo`='C-S033-03' WHERE `id`='78';
UPDATE `gti`.`proyecto` SET `codigo`='C-G053-01' WHERE `id`='79';
UPDATE `gti`.`proyecto` SET `codigo`='C-S275-03' WHERE `id`='82';
UPDATE `gti`.`proyecto` SET `codigo`='C-S262-01' WHERE `id`='84';
UPDATE `gti`.`proyecto` SET `codigo`='C-G007-01' WHERE `id`='86';
UPDATE `gti`.`proyecto` SET `codigo`='C-R017-01' WHERE `id`='87';
UPDATE `gti`.`proyecto` SET `codigo`='C-S073-05' WHERE `id`='90';
UPDATE `gti`.`proyecto` SET `codigo`='C-G023-04' WHERE `id`='91';
UPDATE `gti`.`proyecto` SET `codigo`='C-G071-01' WHERE `id`='92';
UPDATE `gti`.`proyecto` SET `codigo`='C-G075-01' WHERE `id`='95';
UPDATE `gti`.`proyecto` SET `codigo`='C-G029-01' WHERE `id`='105';
UPDATE `gti`.`proyecto` SET `codigo`='C-G020-01' WHERE `id`='106';
UPDATE `gti`.`proyecto` SET `codigo`='C-G013-01' WHERE `id`='113';


update gti.registro_actividad r
set id_contrato = (select codigo from proyecto p where p.id = r.id_contrato)
where r.id >= 58158


 update gti.registro_actividad r
 set id_contrato = (select proyecto from new_personas p where p.cedula = r.cedula)
where id_contrato = '' and r.id >= 58158
;


update registro_actividad p set cedula = (select u.cedula from new_usuario u where u.id = p.user_id )




-- se insertan los contratos trabajados por los analistas en la relacion lider_contratos
insert into new_lider_contratos (codigo,alias,id_lider)
select
codigo,nombre as alias,jefe as id_lider
from
(select 
 id_contrato,jefe, count(id_contrato) cantidad
from
(select 
r.*,
(select p.jefe from new_personas p where p.cedula = r.cedula) jefe
from registro_actividad r WHERE fecha_inicio between '2017-01-01' and '2017-03-01') r
where cast(jefe as int) = '<lider>' group by id_contrato) c, new_proyectos p
where c.id_contrato = p.codigo
order by cantidad



CREATE VIEW `productividad_historica` AS 
select `r`.`fecha_inicio` AS `fecha_inicio`,`r`.`tiempoReal` AS `tiempoReal`,`a`.`categoria` AS `categoria`,
`d`.`correo` AS `correo`,
(select `ar`.`area` from `areas` `ar`
 where (`d`.`area` = `ar`.`id`)) AS `area` 
 from ((`registro_actividad` `r` left join `actividad` `a` 
	on((`a`.`id` = `r`.`id_actividad`))) left join `new_usuario` `d` 
    on((`d`.`cedula` = `r`.`cedula`))) where (`r`.`estado` = 'F') 
order by `r`.`estado` desc;



--Se crea nueva columna en la tabla registro actividad,es para el registro de horas extras 2017/03/29
ALTER TABLE `registro_actividad` ADD `horaExtra` VARCHAR(5) NOT NULL AFTER `cedula`;

--Se crea Tabla para guardar las fechas de fiesta desde junio hasta diciembre 2017 2017/06/12
CREATE TABLE `festivo` (
  `id_festivo` int(10) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `festivo` (`id_festivo`, `fecha`) VALUES
(1, '2017-01-09'),
(2, '2017-03-20'),
(3, '2017-04-13'),
(4, '2017-04-14'),
(5, '2017-05-01'),
(6, '2017-05-29'),
(7, '2017-06-19'),
(8, '2017-06-26'),
(9, '2017-07-03'),
(10, '2017-07-20'),
(11, '2017-08-07'),
(12, '2017-08-21'),
(13, '2017-10-16'),
(14, '2017-11-06'),
(15, '2017-11-13'),
(16, '2017-12-08'),
(17, '2017-12-25');

ALTER TABLE `festivo`
ADD PRIMARY KEY (`id_festivo`);





