-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 13, 2021 at 02:33 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pfc`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ciudad`
--

CREATE TABLE `Ciudad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_provincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Ciudad`
--

INSERT INTO `Ciudad` (`id`, `nombre`, `id_provincia`) VALUES
(1, 'Paraná', 1),
(2, 'Santa Fé', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Dato`
--

CREATE TABLE `Dato` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(255) DEFAULT NULL,
  `respuesta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Dato`
--

INSERT INTO `Dato` (`id`, `pregunta`, `respuesta`) VALUES
(1, 'Pregunta 1', 'Respuesta 1'),
(2, 'Pregunta 2', 'Respuesta 2'),
(3, 'Pregunta 3', 'Respuesta 3'),
(4, 'Pregunta 4', 'Respuesta 4'),
(5, 'Pregunta Extra P1', 'Respuesta Extra P1'),
(6, 'Pregunta P1 Entrevista', 'Respuesta P1 Entrevista');

-- --------------------------------------------------------

--
-- Table structure for table `Herramienta`
--

CREATE TABLE `Herramienta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_creador` int(11) NOT NULL,
  `cantidad_datos` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Herramienta`
--

INSERT INTO `Herramienta` (`id`, `nombre`, `id_creador`, `cantidad_datos`) VALUES
(1, 'Encuesta', 1, 0),
(2, 'Consulta', 1, 0),
(3, 'Entrevista', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Herramientas_Datos`
--

CREATE TABLE `Herramientas_Datos` (
  `id` int(11) NOT NULL,
  `id_herramienta` int(11) NOT NULL,
  `id_dato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Herramientas_Datos`
--

INSERT INTO `Herramientas_Datos` (`id`, `id_herramienta`, `id_dato`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 1, 5),
(6, 3, 5),
(7, 3, 5),
(8, 3, 6),
(9, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Pais`
--

CREATE TABLE `Pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Pais`
--

INSERT INTO `Pais` (`id`, `nombre`) VALUES
(1, 'Argentina');

-- --------------------------------------------------------

--
-- Table structure for table `Permiso`
--

CREATE TABLE `Permiso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Provincia`
--

CREATE TABLE `Provincia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Provincia`
--

INSERT INTO `Provincia` (`id`, `nombre`, `id_pais`) VALUES
(1, 'Entre Rios', 1),
(2, 'Santa Fe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Proyecto`
--

CREATE TABLE `Proyecto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `id_creador` int(11) NOT NULL,
  `latitud` varchar(255) DEFAULT NULL,
  `longitud` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Proyecto`
--

INSERT INTO `Proyecto` (`id`, `nombre`, `id_ciudad`, `id_creador`, `latitud`, `longitud`, `fecha`) VALUES
(1, 'Primer Proyecto', 1, 1, '30.101010', '-60.101010', '2021-08-05'),
(2, 'Segundo Proyecto', 2, 1, NULL, NULL, '2021-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `Proyectos_Relevamientos`
--

CREATE TABLE `Proyectos_Relevamientos` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `id_relevamiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Proyectos_Relevamientos`
--

INSERT INTO `Proyectos_Relevamientos` (`id`, `id_proyecto`, `id_relevamiento`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Relevamiento`
--

CREATE TABLE `Relevamiento` (
  `id` int(11) NOT NULL,
  `id_responsable` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_herramienta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Relevamiento`
--

INSERT INTO `Relevamiento` (`id`, `id_responsable`, `fecha`, `id_herramienta`) VALUES
(1, 2, '2021-08-31', 1),
(2, 2, '2021-08-31', 1),
(3, 2, '2021-08-31', 1),
(4, 1, '2021-08-30', 2),
(5, 1, '2021-08-31', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Rol`
--

CREATE TABLE `Rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Rol`
--

INSERT INTO `Rol` (`id`, `nombre`) VALUES
(1, 'Docente'),
(2, 'Alumno');

-- --------------------------------------------------------

--
-- Table structure for table `Roles_Permisos`
--

CREATE TABLE `Roles_Permisos` (
  `id` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE `Usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `legajo` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`id`, `nombre`, `legajo`, `username`, `password`, `id_rol`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'Admin', 1),
(2, 'User1', 'User1', 'User1', 'User1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ciudad`
--
ALTER TABLE `Ciudad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ciudad_provincia` (`id_provincia`);

--
-- Indexes for table `Dato`
--
ALTER TABLE `Dato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Herramienta`
--
ALTER TABLE `Herramienta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_herramienta_creador` (`id_creador`);

--
-- Indexes for table `Herramientas_Datos`
--
ALTER TABLE `Herramientas_Datos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_herramienta` (`id_herramienta`),
  ADD KEY `fk_dato` (`id_dato`);

--
-- Indexes for table `Pais`
--
ALTER TABLE `Pais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Permiso`
--
ALTER TABLE `Permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Provincia`
--
ALTER TABLE `Provincia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_provincia_pais` (`id_pais`);

--
-- Indexes for table `Proyecto`
--
ALTER TABLE `Proyecto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_proyecto_ciudad` (`id_ciudad`),
  ADD KEY `fk_proyecto_usuario` (`id_creador`);

--
-- Indexes for table `Proyectos_Relevamientos`
--
ALTER TABLE `Proyectos_Relevamientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_proyecto` (`id_proyecto`),
  ADD KEY `fk_relevamiento` (`id_relevamiento`);

--
-- Indexes for table `Relevamiento`
--
ALTER TABLE `Relevamiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_relevamiento_herramienta` (`id_herramienta`),
  ADD KEY `fk_herramienta_usuario` (`id_responsable`);

--
-- Indexes for table `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Roles_Permisos`
--
ALTER TABLE `Roles_Permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rol` (`id_rol`),
  ADD KEY `fk_permiso` (`id_permiso`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_rol` (`id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ciudad`
--
ALTER TABLE `Ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Dato`
--
ALTER TABLE `Dato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Herramienta`
--
ALTER TABLE `Herramienta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Herramientas_Datos`
--
ALTER TABLE `Herramientas_Datos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Pais`
--
ALTER TABLE `Pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Permiso`
--
ALTER TABLE `Permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Provincia`
--
ALTER TABLE `Provincia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Proyecto`
--
ALTER TABLE `Proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Proyectos_Relevamientos`
--
ALTER TABLE `Proyectos_Relevamientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Relevamiento`
--
ALTER TABLE `Relevamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Rol`
--
ALTER TABLE `Rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Roles_Permisos`
--
ALTER TABLE `Roles_Permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Ciudad`
--
ALTER TABLE `Ciudad`
  ADD CONSTRAINT `fk_ciudad_provincia` FOREIGN KEY (`id_provincia`) REFERENCES `Provincia` (`id`);

--
-- Constraints for table `Herramienta`
--
ALTER TABLE `Herramienta`
  ADD CONSTRAINT `fk_herramienta_creador` FOREIGN KEY (`id_creador`) REFERENCES `Usuario` (`id`);

--
-- Constraints for table `Herramientas_Datos`
--
ALTER TABLE `Herramientas_Datos`
  ADD CONSTRAINT `fk_dato` FOREIGN KEY (`id_dato`) REFERENCES `Dato` (`id`),
  ADD CONSTRAINT `fk_herramienta` FOREIGN KEY (`id_herramienta`) REFERENCES `Herramienta` (`id`);

--
-- Constraints for table `Provincia`
--
ALTER TABLE `Provincia`
  ADD CONSTRAINT `fk_provincia_pais` FOREIGN KEY (`id_pais`) REFERENCES `Pais` (`id`);

--
-- Constraints for table `Proyecto`
--
ALTER TABLE `Proyecto`
  ADD CONSTRAINT `fk_proyecto_ciudad` FOREIGN KEY (`id_ciudad`) REFERENCES `Ciudad` (`id`),
  ADD CONSTRAINT `fk_proyecto_usuario` FOREIGN KEY (`id_creador`) REFERENCES `Usuario` (`id`);

--
-- Constraints for table `Proyectos_Relevamientos`
--
ALTER TABLE `Proyectos_Relevamientos`
  ADD CONSTRAINT `fk_proyecto` FOREIGN KEY (`id_proyecto`) REFERENCES `Proyecto` (`id`),
  ADD CONSTRAINT `fk_relevamiento` FOREIGN KEY (`id_relevamiento`) REFERENCES `Relevamiento` (`id`);

--
-- Constraints for table `Relevamiento`
--
ALTER TABLE `Relevamiento`
  ADD CONSTRAINT `fk_herramienta_usuario` FOREIGN KEY (`id_responsable`) REFERENCES `Usuario` (`id`),
  ADD CONSTRAINT `fk_relevamiento_herramienta` FOREIGN KEY (`id_herramienta`) REFERENCES `Herramienta` (`id`);

--
-- Constraints for table `Roles_Permisos`
--
ALTER TABLE `Roles_Permisos`
  ADD CONSTRAINT `fk_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `Permiso` (`id`),
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `Rol` (`id`);

--
-- Constraints for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `Rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
