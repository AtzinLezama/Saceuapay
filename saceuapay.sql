-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2022 a las 12:00:02
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `saceuapay`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_abono`
--

CREATE TABLE `tbl_abono` (
  `id_abono` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descuento` varchar(3) NOT NULL,
  `id_empleado` bigint(20) NOT NULL,
  `folio` varchar(10) NOT NULL,
  `metodo_pago` int(11) NOT NULL,
  `id_cargo` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_alumno`
--

CREATE TABLE `tbl_alumno` (
  `id_alumno` bigint(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `numero_control` int(11) NOT NULL,
  `id_carrera` bigint(20) NOT NULL,
  `cuatrimestre` int(11) NOT NULL,
  `id_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_alumno`
--

INSERT INTO `tbl_alumno` (`id_alumno`, `nombre`, `numero_control`, `id_carrera`, `cuatrimestre`, `id_usuario`) VALUES
(13, 'alumno', 123, 0, 1, 90),
(14, 'alumno2', 1234, 0, 1, 91),
(16, 'fabian garcia', 12345, 1, 7, 96),
(17, 'fgc2', 123, 4, 1, 97),
(18, 'jose', 0, 2, 2, 98);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cargo`
--

CREATE TABLE `tbl_cargo` (
  `id_cargo` bigint(20) NOT NULL,
  `numero_control` int(100) NOT NULL,
  `id_alumno` bigint(20) NOT NULL,
  `cuatrimestre` int(11) NOT NULL,
  `carrera` text NOT NULL,
  `id_conceptos` bigint(20) NOT NULL,
  `status` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descuento` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tipo_pago` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_cargo`
--

INSERT INTO `tbl_cargo` (`id_cargo`, `numero_control`, `id_alumno`, `cuatrimestre`, `carrera`, `id_conceptos`, `status`, `cantidad`, `descuento`, `total`, `tipo_pago`, `fecha`, `observaciones`) VALUES
(92, 123, 13, 1, 'Derecho', 21, 'Pendiente', 100, 70, 30, 'Efectivo', '2022-11-10', 'aaaaaaaaaaaa'),
(93, 1234, 14, 2, 'Derecho', 22, 'Pagado', 12, 0, 12, 'Transferencia', '2022-11-10', 'asa'),
(94, 123, 13, 4, 'Mercadotecnia', 24, 'Pendiente', 34, 0, 34, 'Tarjeta', '2022-11-28', 'ADWD'),
(96, 123, 13, 2, 'Contaduria', 22, 'Pendiente', 100, 0, 100, 'Tarjeta', '2022-12-08', 'a'),
(98, 12345, 16, 12, 'Ciencias de la cominicacion', 40, 'Pagado', 10000, 0, 10000, 'Efectivo', '2022-12-09', ''),
(99, 123, 13, 1, '4', 40, 'Pagado', 20000, 100, 0, '4', '2022-12-09', ''),
(103, 0, 18, 7, '1', 16, 'Pendiente', 122, 0, 122, 'Transferencia', '2022-12-14', ''),
(104, 0, 18, 2, '2', 22, 'Pendiente', 1001, 0, 1001, 'Efectivo', '2022-12-14', '1'),
(105, 0, 18, 7, '1', 16, 'Pagado', 12, 0, 12, 'Tarjeta', '2022-12-15', ''),
(107, 12345, 16, 7, '1', 40, 'Pagado', 12, 0, 12, 'Tarjeta', '2022-12-15', '12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carrera`
--

CREATE TABLE `tbl_carrera` (
  `id_carrera` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_carrera`
--

INSERT INTO `tbl_carrera` (`id_carrera`, `nombre`) VALUES
(0, 'Mercadotecnia'),
(1, 'Contaduria'),
(2, 'Derecho'),
(3, 'Ciencias de la comunicación'),
(4, 'Administración de empresas turísticas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_concepto`
--

CREATE TABLE `tbl_concepto` (
  `id_concepto` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `costo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_concepto`
--

INSERT INTO `tbl_concepto` (`id_concepto`, `nombre`, `costo`) VALUES
(16, 'talleres', 123),
(21, 'inscripcion', 0),
(22, 'impuestos', 0),
(24, 'constancia', 233),
(25, 'mensualidad', 1069),
(40, 'EXAMEN TITULACION', 20000),
(41, 'agua de sabor', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empleado`
--

CREATE TABLE `tbl_empleado` (
  `id_empleado` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_usuario` bigint(20) NOT NULL,
  `puesto` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `telefono` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_empleado`
--

INSERT INTO `tbl_empleado` (`id_empleado`, `nombre`, `id_usuario`, `puesto`, `email`, `contraseña`, `telefono`) VALUES
(20, 'caja', 92, 'caja', 'caja@caja', '123', 123),
(21, 'cobranza', 93, 'cobranza', 'cobranza@cobranza', '123', 123),
(22, 'fgc', 95, 'fgc', 'fgc@fgc', '123', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ingreso`
--

CREATE TABLE `tbl_ingreso` (
  `id_ingrso` int(11) NOT NULL,
  `num_control` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descuento` int(11) NOT NULL,
  `adeudo` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `mes1` int(11) NOT NULL,
  `mes2` int(11) NOT NULL,
  `mes3` int(11) NOT NULL,
  `mes4` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `comentarios` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_ingreso`
--

INSERT INTO `tbl_ingreso` (`id_ingrso`, `num_control`, `nombre`, `descuento`, `adeudo`, `periodo`, `mes1`, `mes2`, `mes3`, `mes4`, `saldo`, `comentarios`) VALUES
(1, '', 'alumno5', 20, 1, 1, 2640, 2640, 2640, 2640, 500, 'seeee'),
(2, '12345', 'alumno5', 20, 1, 1, 2640, 2640, 2640, 2640, 520, 'seeeee'),
(3, '123456789', 'alumno5', 20, 1, 1, 2640, 2640, 2640, 2640, 500, 'ass'),
(4, '1234567', 'alumno5', 20, 2, 3, 2640, 2640, 2640, 2640, 500, 'seeee'),
(5, '123459', 'luffy', 20, 1, 1, 2640, 2640, 2640, 2640, 12, '12'),
(6, '1234598', 'may', 20, 1, 2, 2640, 2640, 2640, 2640, 12, 'ass'),
(7, '32423423', 'fabian', 20, 2, 1, 2640, 2640, 2640, 2640, 10000, 'ninguno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_periodo`
--

CREATE TABLE `tbl_periodo` (
  `id_periodo` bigint(20) NOT NULL,
  `año` int(100) NOT NULL,
  `periodo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_periodo`
--

INSERT INTO `tbl_periodo` (`id_periodo`, `año`, `periodo`) VALUES
(1, 1999, 'Septiembre - Diciembre'),
(2, 2596, 'Enero - Abril'),
(8, 2022, 'Enero - Abril'),
(9, 2022, 'Enero - Abril'),
(10, 2022, 'Mayo - Agosto'),
(11, 2022, 'Septiembre - Diciembre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` bigint(20) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `login`, `password`, `tipo_usuario`) VALUES
(1, 'admin', '123', 2),
(90, 'alumno', '123', 1),
(91, 'alumno2', '123', 1),
(92, 'caja', '123', 3),
(93, 'cobranza', '123', 4),
(94, '', '', 0),
(95, 'fgc', '123', 2),
(96, 'fabian', '123', 1),
(97, 'fgc2', '123', 1),
(98, 'jose', 'jose123', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_abono`
--
ALTER TABLE `tbl_abono`
  ADD PRIMARY KEY (`id_abono`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indices de la tabla `tbl_alumno`
--
ALTER TABLE `tbl_alumno`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_carrera` (`id_carrera`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tbl_cargo`
--
ALTER TABLE `tbl_cargo`
  ADD PRIMARY KEY (`id_cargo`),
  ADD KEY `id_conceptos` (`id_conceptos`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `tbl_carrera`
--
ALTER TABLE `tbl_carrera`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `tbl_concepto`
--
ALTER TABLE `tbl_concepto`
  ADD PRIMARY KEY (`id_concepto`),
  ADD KEY `costo` (`costo`);

--
-- Indices de la tabla `tbl_empleado`
--
ALTER TABLE `tbl_empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tbl_ingreso`
--
ALTER TABLE `tbl_ingreso`
  ADD PRIMARY KEY (`id_ingrso`);

--
-- Indices de la tabla `tbl_periodo`
--
ALTER TABLE `tbl_periodo`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `tipo_usuario` (`tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_abono`
--
ALTER TABLE `tbl_abono`
  MODIFY `id_abono` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_alumno`
--
ALTER TABLE `tbl_alumno`
  MODIFY `id_alumno` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tbl_cargo`
--
ALTER TABLE `tbl_cargo`
  MODIFY `id_cargo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT de la tabla `tbl_concepto`
--
ALTER TABLE `tbl_concepto`
  MODIFY `id_concepto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `tbl_empleado`
--
ALTER TABLE `tbl_empleado`
  MODIFY `id_empleado` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `tbl_ingreso`
--
ALTER TABLE `tbl_ingreso`
  MODIFY `id_ingrso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_periodo`
--
ALTER TABLE `tbl_periodo`
  MODIFY `id_periodo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_abono`
--
ALTER TABLE `tbl_abono`
  ADD CONSTRAINT `tbl_abono_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `tbl_empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_abono_ibfk_2` FOREIGN KEY (`id_cargo`) REFERENCES `tbl_cargo` (`id_cargo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_alumno`
--
ALTER TABLE `tbl_alumno`
  ADD CONSTRAINT `tbl_alumno_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_alumno_ibfk_2` FOREIGN KEY (`id_carrera`) REFERENCES `tbl_carrera` (`id_carrera`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_cargo`
--
ALTER TABLE `tbl_cargo`
  ADD CONSTRAINT `tbl_cargo_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `tbl_alumno` (`id_alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cargo_ibfk_2` FOREIGN KEY (`id_conceptos`) REFERENCES `tbl_concepto` (`id_concepto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_empleado`
--
ALTER TABLE `tbl_empleado`
  ADD CONSTRAINT `tbl_empleado_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
