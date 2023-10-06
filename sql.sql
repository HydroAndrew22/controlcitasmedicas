-- CREACION DE LA BASE DE DATOS
CREATE DATABASE bdclinica;

-- ELIMINAR LAS TABLAS SI EXISTEN
DROP TABLE IF EXISTS tab_agendar_cita, tab_empleados, tab_especialidades, tab_tipo_cita, tab_usuarios;


-- CREACION DE LAS TABLAS
CREATE TABLE tab_usuarios (
    -- id int NOT NULL AUTO_INCREMENT,  -- Pendi
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
    id_usuario VARCHAR(50) NOT NULL,
    id_tipo_cita int NOT NULL,
    id_profesional int NOT NULL,
    fecha_cita DATETIME NOT NULL,
    estado_cita ENUM('PENDIENTE', 'REALIZADA', 'CANCELADA','CONFIRMADA') DEFAULT 'PENDIENTE',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES tab_usuarios(id_usuario),
    FOREIGN KEY (id_tipo_cita) REFERENCES tab_tipo_cita(id_tipo_cita),
    FOREIGN KEY (id_profesional) REFERENCES tab_empleados(id_profesional),
    PRIMARY KEY (id_ac)
) ;

    

-- INSERT
INSERT INTO tab_especialidades (tipo) VALUES ("Cardiólogo"), ("Dermatólogo"), ("Ginecobstetra"), ("Ginecólogo"), ("Internista"), ("Médico General"), ("Nutricionista"), ("Oftalmólogo"), ("Ortopedista"), ("Otorrinolaringólogo"), ("Pediatra"), ("Urólogo");

INSERT INTO tab_tipo_cita (tipo) VALUES  ("Cardiología"), ("Dermatología"), ("Ginecobstetricia"), ("Ginecología"), ("Internista"), ("Medicina General"), ("Nutricionista"), ("Oftalmología"), ("Ortopédia"), ("Otorrinolaringología"), ("Pediatría"), ("Urología");

INSERT INTO tab_empleados (nombre, apellido, email, id_especialidad, sede) VALUES  ("Juan Camilo","Reyes","quam.curabitur@aol.net", 1,"Centro"),  ("Carlos","Santodomingo","non.justo.proin@hotmail.org", 2,"Manila"),  ("erick","Leon","auctor.vitae@aol.edu",10,"Argentina"),  ("Oscar","Betancourt","risus@hotmail.ca",5,"Poblado"),  ("Franco","Escamilla","dictum.cursus@icloud.couk",3,"Rio");



-- VISTAS

create view vw_agendar_cita as SELECT ac.id_ac, ac.id_usuario, ac.id_tipo_cita, ac.fecha_cita, ac. estado_cita, em.id_profesional, 
CONCAT(em.nombre,' ', em.apellido) as nombre_profesional, em.id_especialidad, em.sede
FROM tab_agendar_cita ac 
LEFT join tab_empleados em 
ON ac.estado_cita='PENDIENTE' and ac.id_profesional = em.id_profesional;










-- borrar


CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_cita DATETIME NOT NULL,
    motivo VARCHAR(255),
    estado ENUM('PENDIENTE', 'REALIZADA', 'CANCELADA', 'CONFIRMADA') DEFAULT 'PENDIENTE'
);



