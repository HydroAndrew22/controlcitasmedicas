-- CREACION DE LA BASE DE DATOS
CREATE DATABASE bdclinica;

-- ELIMINAR LAS TABLAS SI EXISTEN
DROP TABLE IF EXISTS tab_usuarios;
DROP TABLE IF EXISTS tab_especialidades;
DROP TABLE IF EXISTS tab_empleados;
DROP TABLE IF EXISTS tab_tipo_cita;
DROP TABLE IF EXISTS tab_agendar_cita;

-- CREACION DE LAS TABLAS
CREATE TABLE tab_usuarios (
    id int NOT NULL AUTO_INCREMENT,  -- Pendi
    id_usuario VARCHAR(50) NOT NULL, 
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    direccion VARCHAR(50) NOT NULL,
    departamento VARCHAR(50) NOT NULL,
    ciudad VARCHAR(50) NOT NULL,
    fecha_retiro DATETIME NULL,
    esactivo BOOLEAN DEFAULT true NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP,  
    PRIMARY KEY (id_usuario)
) ;

CREATE TABLE tab_especialidades (
    id_especialidad int NOT NULL AUTO_INCREMENT, 
    tipo VARCHAR(50) NOT NULL,
    esactivo BOOLEAN DEFAULT true NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP,  
    PRIMARY KEY (id_especialidad)
) ;


CREATE TABLE tab_empleados (
    id_profesional int NOT NULL AUTO_INCREMENT, 
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    id_especialidad int NOT NULL,
    sede VARCHAR(50) NOT NULL,
    esactivo BOOLEAN DEFAULT true NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP,  
    FOREIGN KEY (id_especialidad) REFERENCES tab_especialidades(id_especialidad),
    PRIMARY KEY (id_profesional)
) ;


CREATE TABLE tab_tipo_cita (
    id_tipo_cita int NOT NULL AUTO_INCREMENT, 
    tipo VARCHAR(50) NOT NULL,
    esactivo BOOLEAN DEFAULT true NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP,  
    PRIMARY KEY (id_tipo_cita)
) ;


CREATE TABLE tab_agendar_cita (
    id_ac int NOT NULL AUTO_INCREMENT, 
    id_usuario bigint NOT NULL,
    id_tipo_cita int NOT NULL,
    id_profesional int NOT NULL,
    fecha_cita DATETIME NOT NULL,
    esactivo BOOLEAN DEFAULT true NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP,  
    FOREIGN KEY (id_usuario) REFERENCES tab_usuarios(id_usuario),
    FOREIGN KEY (id_tipo_cita) REFERENCES tab_tipo_cita(id_tipo_cita),
    FOREIGN KEY (id_profesional) REFERENCES tab_empleados(id_profesional),
    PRIMARY KEY (id_ac)
) ;







