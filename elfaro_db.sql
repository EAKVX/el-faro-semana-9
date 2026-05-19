CREATE DATABASE IF NOT EXISTS `elfaro_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `elfaro_db`;
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2026 a las 18:08:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `elfaro_db`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `sp_insertar_articulo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_articulo` (IN `p_titulo` VARCHAR(255), IN `p_descripcion` TEXT, IN `p_seccion` ENUM('nacional','internacional','negocios','deportes','ciencia_tecnologia'), IN `p_fecha_publicacion` DATETIME, IN `p_enlace_origen` VARCHAR(255))   BEGIN
    INSERT INTO articulos (titulo, descripcion, seccion, fecha_publicacion, enlace_origen) 
    VALUES (p_titulo, p_descripcion, p_seccion, p_fecha_publicacion, p_enlace_origen);
END$$

DROP PROCEDURE IF EXISTS `sp_insertar_comentario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_comentario` (IN `p_articulo_id` INT, IN `p_usuario_id` INT, IN `p_comentario` TEXT)   BEGIN
    INSERT INTO comentarios (articulo_id, usuario_id, comentario) 
    VALUES (p_articulo_id, p_usuario_id, p_comentario);
END$$

DROP PROCEDURE IF EXISTS `sp_insertar_contacto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_contacto` (IN `p_nombre` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_mensaje` TEXT)   BEGIN
    INSERT INTO contactos (nombre, email, mensaje) VALUES (p_nombre, p_email, p_mensaje);
END$$

DROP PROCEDURE IF EXISTS `sp_insertar_usuario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_usuario` (IN `p_nombre` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(255), IN `p_rol` ENUM('admin','lector'))   BEGIN
    INSERT INTO usuarios (nombre, email, password, rol) 
    VALUES (p_nombre, p_email, p_password, p_rol);
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_articulos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_articulos` ()   BEGIN
    SELECT * FROM articulos ORDER BY fecha_Publicacion DESC;
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_articulos_por_seccion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_articulos_por_seccion` (IN `seccion` ENUM('inicio','deportes','negocios'))   BEGIN
	SELECT * FROM articulos WHERE seccion = seccion;
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_articulo_por_id`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_articulo_por_id` (IN `p_id` INT)   BEGIN
    SELECT * FROM articulos WHERE id = p_id;
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_comentarios_articulo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_comentarios_articulo` (IN `articulo_id` INT)   BEGIN
    SELECT c.*, u.nombre 
    FROM comentarios c 
    INNER JOIN usuarios u ON c.usuario_id = u.id 
    WHERE c.articulo_id = articulo_id 
    ORDER BY c.fecha DESC;
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_por_seccion_excluyendo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_por_seccion_excluyendo` (IN `p_seccion` VARCHAR(50), IN `p_ids_excluidos` VARCHAR(255))   BEGIN
    IF p_ids_excluidos IS NULL OR p_ids_excluidos = '' THEN
        SELECT * FROM articulos WHERE seccion = p_seccion ORDER BY fecha_publicacion DESC;
    ELSE
        -- FIND_IN_SET busca el ID dentro de una cadena separada por comas (ej: "1,2,3")
        SELECT * FROM articulos 
        WHERE seccion = p_seccion AND FIND_IN_SET(id, p_ids_excluidos) = 0 
        ORDER BY fecha_publicacion DESC;
    END IF;
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_recientes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_recientes` (IN `p_limite` INT)   BEGIN
    -- Preparamos la consulta dinámica para el LIMIT
    SET @s = CONCAT('SELECT * FROM articulos ORDER BY fecha_publicacion DESC LIMIT ', p_limite);
    PREPARE stmt FROM @s;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_usuarios`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_usuarios` ()   BEGIN
    SELECT id, nombre, email, fecha_registro, rol 
    FROM usuarios 
    ORDER BY fecha_registro DESC;
END$$

DROP PROCEDURE IF EXISTS `sp_obtener_usuario_por_email`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_usuario_por_email` (IN `p_email` VARCHAR(100))   BEGIN
    SELECT * FROM usuarios WHERE email = p_email;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

DROP TABLE IF EXISTS `articulos`;
CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_publicacion` datetime DEFAULT current_timestamp(),
  `seccion` enum('nacional','internacional','negocios','deportes','ciencia_tecnologia') NOT NULL,
  `enlace_origen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `titulo`, `descripcion`, `fecha_publicacion`, `seccion`, `enlace_origen`) VALUES
(5, 'Poduje desestima recomendación de Quiroz y firma continuidad de programa que Hacienda quería recortar Foto autor Samuel Fuentes', 'El ministro de Vivienda y Urbanismo, Iván Poduje, reafirmó su postura al firmar el programa de Pavimentos Participativos, desafiando las supuestas sugerencias de Jorge Quiroz de Hacienda de \"descontinuar\" este proyecto. Poduje, además, dejó en claro que su único jefe es el presidente José Antonio Kast.', '2026-04-30 20:51:54', '', 'https://www.biobiochile.cl'),
(6, 'Marco Rubio dice que espera \"hoy\" una respuesta de Irán para unas negociaciones \"serias\" de paz', 'El secretario de Estado estadounidense, Marco Rubio, espera una respuesta de Irán en el día sobre negociaciones de paz tras reunirse en Roma con la primera ministra italiana, Giorgia Meloni. Rubio dijo que aguardan una respuesta seria para iniciar negociaciones. Destacó que Irán no debe tener armas nucleares y sostuvo que Trump trabaja para evitarlo. Advirtió que sería problemático que Irán controle el estrecho de Ormuz.', '2026-05-08 16:49:56', '', 'https://www.biobiochile.cl'),
(7, 'Gasolina, petróleo y gas en las nubes: El IPC varió 1,3% en abril y los precios presionan el bolsillo', 'El Índice de Precios al Consumidor (IPC) en abril de 2026 aumentó un 1,3%, acumulando 2,7% en el año y 4,0% a doce meses, según el INE. Los precios de la gasolina, petróleo diésel y gas licuado subieron significativamente, con alzas de 25,3%, 45,7% y 5,8% respectivamente. En total, diez divisiones del IPC contribuyeron positivamente, con transporte liderando (8,0%) y vivienda (0,8%). Vestuario y calzado tuvieron la mayor baja (-1,8%).', '2026-05-08 16:50:50', '', 'https://www.biobiochile.cl'),
(8, 'La tormenta por la auditoría interna de Codelco eclipsa la histórica subida en el precio del cobre', 'El precio del cobre alcanza un nuevo récord histórico de US$6,39 la libra, pero una auditoría interna de Codelco revela inconsistencias que inflaron la producción en 20.000 toneladas para cumplir metas del 2025 y otorgar bonos. El biministro Daniel Mas y la Sonami reaccionan, este último minimizando el impacto. Codelco guarda silencio a la espera del informe final. Sindicatos aclaran que los trabajadores no se beneficiaron de los bonos.', '2026-05-13 23:26:36', 'negocios', 'https://www.biobiochile.cl'),
(9, 'Precios del petróleo caen ante expectativas que la cumbre entre Trump y Xi levante el bloqueo de Ormuz', 'Los precios del petróleo retrocedieron ante la visita de Donald Trump a China y la preocupación por la falta de petróleo por el conflicto en Oriente Medio. El petróleo Brent cayó un 1,99%, llegando a 105,63 dólares, mientras que el WTI perdió un 1,14%, alcanzando los 101,02 dólares. Trump busca presionar a China para que influya en Irán y permita reanudar las entregas de crudo al mundo.', '2026-05-14 03:10:03', 'negocios', 'https://www.biobiochile.cl'),
(10, 'Trump llega al Gran Palacio del Pueblo de Pekín y se reúne con Xi Jinping', 'El presidente de Estados Unidos (EEUU), Donald Trump, llegó este jueves al Gran Palacio del Pueblo de Pekín, donde sostendrá una reunión con su homólogo chino, Xi Jinping, en la jornada central de su visita de Estado a China. fue recibido con honores por Xi, tras lo cual ambos escucharon los himnos de sus países y pasaron revista a las tropas en la entrada del Palacio, situado en la plaza de Tiananmén.', '2026-05-14 04:48:13', 'internacional', 'https://www.biobiochile.cl'),
(11, 'Bachelet alerta del retroceso en derechos de las mujeres en \"países donde gobierna la ultraderecha\"', 'Michelle Bachelet alertó sobre el retroceso de los derechos de las mujeres impulsado por proyectos políticos autoritarios y de ultraderecha, que erosionan la igualdad y la democracia. En un encuentro de mujeres políticas de América Latina, advirtió sobre la desconexión entre instituciones y ciudadanos, facilitando el avance de la retórica populista. Bachelet denunció legislaciones regresivas y discursos de odio, relacionando la exclusión femenina con el debilitamiento democrático.', '2026-05-14 04:55:05', 'nacional', 'https://www.biobiochile.cl'),
(12, 'Mas dice que nuevos directores de Codelco tendrán \"mandato claro\" y que \"hay que recuperar el control\"', 'El biministro de Economía y Minería, Daniel Mas, reiteró la importancia de mejorar la seguridad y producción en Codelco, tras revelarse una auditoría interna que detectó la incorporación de 20 mil toneladas extra en la producción de la estatal en diciembre del 2025, inflando las metas anuales. Mas anunció la renovación de tres directores en la cuprífera y enfatizó en la necesidad de recuperar el control de la compañía. El informe preliminar señala que el gerente de Presupuesto y Control de Gestión autorizó esta inclusión sin las coordinaciones necesarias.', '2026-05-14 04:56:00', 'negocios', 'https://www.biobiochile.cl'),
(13, 'Reclamó contra árbitro en TV y se fue expulsado: Fernando Ortiz cerró caída de Colo Colo con berrinche', 'El entrenador de Colo Colo, Fernando Ortiz, fue expulsado tras la derrota 1-0 ante Coquimbo Unido en la Copa de la Liga, perdiendo el liderato del Grupo A y la oportunidad de ser semifinalista. Ortiz criticó la labor arbitral, tuvo un altercado con el árbitro Gastón Philippe y fue expulsado. No podrá dirigir el último partido contra Huachipato.', '2026-05-14 04:56:41', 'deportes', 'https://www.biobiochile.cl'),
(14, 'Investigadores aseguran que el cometa Halley fue mal nombrado y cuestionan hallazgo de Edmond Halley', 'Investigadores de la Universidad de Leiden aseguran que el cometa Halley fue mal nombrado, ya que su periodicidad no habría sido descubierta por el astrónomo Edmond Halley, sino por un monje del siglo XI.', '2026-05-14 04:57:37', 'ciencia_tecnologia', 'https://www.biobiochile.cl'),
(15, 'Estas son las iniciativas que quedaron fuera de reforma de Quiroz tras ser rechazadas incluso por RN', 'La maratónica sesión de la Comisión de Hacienda, que se prolongó hasta las 5 de la madrugada, tuvo consecuencias significativas para el proyecto de Reconstrucción Nacional liderado por el ministro Jorge Quiroz. Se rechazaron disposiciones polémicas relacionadas con propiedad intelectual, capacitación laboral y probidad, entre otros aspectos. Artículos sobre minería de datos, franquicia tributaria Sence y ley de propiedad intelectual fueron eliminados, mientras que otros fueron reformulados por el Ejecutivo. Debates sensibles incluyeron temas como inteligencia artificial y derechos de autor. Propuestas para modificar Sence, certificación laboral y contratación pública también fueron rechazadas.', '2026-05-14 21:28:26', 'nacional', 'https://www.biobiochile.cl'),
(16, 'Renuncia jefe de la Patrulla Fronteriza de EEUU tras denuncia de contratación de servicios sexuales', 'El jefe de la Patrulla Fronteriza de EE. UU., Michael Banks, renunció por acusaciones de contratar servicios de prostitución, según medios. Banks afirmó haber reforzado la seguridad fronteriza y decidió dejar el cargo tras 37 años para disfrutar en familia. The Washington Examiner reveló que durante una década pagó por servicios sexuales en viajes a Colombia y Tailandia. La CBP aún no se ha pronunciado al respecto.', '2026-05-14 21:29:04', 'internacional', 'https://www.biobiochile.cl'),
(17, 'Cuatro chilenos siguen en competencia: así se jugarán las semifinales de la Liga Profesional Argentina', 'En los cuartos de final del Torneo Apertura de la Liga Profesional de Argentina se definieron los semifinalistas: Belgrano, Argentinos Juniors, Rosario Central y River Plate. Destacan cuatro chilenos en competencia: Vicente Pizarro en Rosario Central, y Paulo Díaz, Brayan Cortés e Iván Morales en River Plate y Argentinos Juniors respectivamente. El enfrentamiento entre River Plate y Rosario Central, con un chileno por equipo, tendrá lugar el sábado.', '2026-05-14 21:29:51', 'deportes', 'https://www.biobiochile.cl'),
(18, 'Columnista español se rinde ante Alexis Sánchez: \"Siempre guarda algo bueno o muy bueno que ofrecer\"', 'Alexis Sánchez destacó en la victoria clave del Sevilla sobre el Villarreal al ingresar en el minuto 70 y liderar la acción que culminó en el gol decisivo para el triunfo 3-2. Su desempeño fue elogiado por exhibir ganas, fútbol y liderazgo, contribuyendo a la permanencia del equipo en LaLiga. El periodista Juan Antonio Solís resaltó la figura del chileno en el encuentro.', '2026-05-14 21:30:36', 'deportes', 'https://www.biobiochile.cl'),
(19, 'En Argentina acusan a \"agentes malintencionados de Chile\" de difundir rumores por brote de Hantavirus', 'Autoridades argentinas investigan origen de brote de Hantavirus en crucero MV Hondius, apuntando a agentes malintencionados de Chile por difundir rumores para dañar la imagen turística de Ushuaia. En medio de versiones sobre vertedero como foco, se descarta registro de contagios en la región y se sugiere origen en norte de la Patagonia. OMS confirma 11 casos a bordo, con tasa de letalidad del 27%, y asegura bajo riesgo global.', '2026-05-14 21:32:34', 'internacional', 'https://www.biobiochile.cl'),
(20, 'Quiroz evita explicar cómo se hará \"más con menos recursos\" en Salud y delega definición al Minsal', 'El ministro de Hacienda, Jorge Quiroz, generó controversia al defender el ajuste presupuestario en Salud argumentando que \"a veces uno con menos recursos hace más\". El Ministerio de Salud intentó calmar las críticas asegurando que el recorte corresponde al 2,5% del presupuesto y no afectará la atención de pacientes. Parlamentarios y el Colegio Médico expresaron preocupación por posibles impactos en la red pública de salud. Quiroz responsabilizó a la administración anterior y destacó la necesidad de mejorar la eficiencia hospitalaria, indicando que hay infraestructura subutilizada.', '2026-05-15 19:30:23', 'nacional', 'https://www.biobiochile.cl/noticias/nacional/chile/2026/05/15/quiroz-evita-explicar-como-se-hara-mas-con-menos-recursos-en-salud-y-delega-definicion-en-el-minsal.shtml');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `articulo_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `articulo_id`, `usuario_id`, `comentario`, `fecha`) VALUES
(1, 5, 6, 'Hola. Esta es una prueba del administrador', '2026-05-14 17:40:29'),
(2, 19, 0, 'Hola. Esta es una prueba de Leo', '2026-05-14 18:09:44'),
(3, 19, 0, 'Hola', '2026-05-14 18:17:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

DROP TABLE IF EXISTS `contactos`;
CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombre`, `email`, `mensaje`, `fecha_envio`) VALUES
(1, 'Alvaro', 'alvaro@correo.cl', 'Mensaje de prueba', '2026-05-01 21:00:42'),
(2, 'Alvaro', 'alvaro@correo.cl', 'Hola. Este es un mensaje de prueba.', '2026-05-08 12:16:46'),
(3, 'Leo', 'Leo@correo.cl', 'Hola. Este es un mensaje de prueba del usuario Leo', '2026-05-14 16:27:02'),
(4, '4556', 'fdsdf@correo.cl', 'safasfad', '2026-05-18 11:02:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `rol` enum('admin','lector') NOT NULL DEFAULT 'lector'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `fecha_registro`, `rol`) VALUES
(0, 'Leo', 'Leo@correo.cl', '$2y$10$AARoWyakSDUyRohnbHTai.fGxiSyWNkwqJBWIYREOfY/JxIPUFMua', '2026-05-14 16:26:13', 'lector'),
(1, 'Juan Pérez', 'juan@elfarochile.cl', '$2y$10$eEPa/4M.1f0.Jv/I3J5r/e70TqP6O0n.G0.zK.QO/x5O/n.N8.X/O', '2026-04-30 13:29:10', 'lector'),
(2, 'María López', 'maria@elfarochile.cl', '$2y$10$eEPa/4M.1f0.Jv/I3J5r/e70TqP6O0n.G0.zK.QO/x5O/n.N8.X/O', '2026-04-30 13:29:10', 'lector'),
(3, 'Alvaro', 'alvaro@correo.cl', '$2y$10$chuzmGUtmKvb9rGkFGrfUulXgkv1oT8ZLFQ6sdrROaWzsFqELqEZO', '2026-04-30 15:42:22', 'lector'),
(4, 'Alberto Rodriguez Ocaranza', 'Alberto@correo.cl', '$2y$10$kHJ5mYF7i/EdYbdz4ahBL.t0qqU//xkEaxvfaenlfaWPYXMd9vHEu', '2026-05-06 16:40:55', 'lector'),
(5, 'Gustavo', 'gustavo@correo.cl', '$2y$10$a6vSikLLrKfcTjJtefsDUOktM09kPF5uIwSIJnfbiU4ougbGbVeS2', '2026-05-08 12:16:16', 'lector'),
(6, 'Administrador', 'admin', '$2y$10$wKxM3E.E.zC8N3/xG.e/4uK2u7Bw9bO0i7/yXG9jH7s/3qT7f.W.G', '2026-05-13 22:31:50', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_id` (`articulo_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
