CREATE DATABASE biblioteca;
USE biblioteca;

CREATE TABLE libros(
	id 			INT AUTO_INCREMENT PRIMARY KEY,
	nombre 		VARCHAR(200) 	NOT NULL,
	imagen		VARCHAR(200)	NOT NULL
) ENGINE = INNODB;

INSERT INTO libros (nombre, imagen) VALUES
	('Conociendo el Perú', 'libro1.jpg'),
	('Matemáticas avanzadas', 'libro2.jpg');

SELECT * FROM libros; -- Ctrl + F9


CREATE TABLE personas
(
	idpersona		INT AUTO_INCREMENT PRIMARY KEY,
	dni 			CHAR (8) NOT NULL,
	apellidos		VARCHAR (40) NOT NULL,
	nombres			VARCHAR (40) NOT NULL,
	telefono		CHAR (9) NULL,
	distrito 		VARCHAR (60) NULL,
	direccion 		VARCHAR (100) NULL,
	CONSTRAINT uk_dni UNIQUE (dni)
) ENGINE = INNODB; 

INSERT INTO personas (dni, apellidos, nombres, telefono, distrito) VALUES 
	('75694349', 'Carrion Leandro', 'Eduardo','987654321', 'Lima'),
	('41414141', 'Tasayco Rojas', 'Fulanito','123456789', 'Miraflores');
	
SELECT * FROM personas;

CREATE TABLE categorias (
	idcategoria INT AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(100) NOT NULL
) ENGINE = INNODB;

INSERT INTO categorias (nombre) VALUES
	('Matemáticas'),
	('Comunicación'),
	('Computación');

CREATE TABLE subcategorias (
	idsubcategoria INT AUTO_INCREMENT PRIMARY KEY,
	idcategoria INT NOT NULL,
	nombre VARCHAR(100) NOT NULL,
	CONSTRAINT fk_categoria FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria)
) ENGINE = INNODB;

-- Subcategorías de Matemáticas
INSERT INTO subcategorias (idcategoria, nombre) VALUES
	(1, 'Razonamiento Lógico Matemático'),
	(1, 'Álgebra'),
	(1, 'Trigonometría');

-- Subcategorías de Comunicación
INSERT INTO subcategorias (idcategoria, nombre) VALUES
	(2, 'Razonamiento Verbal'),
	(2, 'Composición'),
	(2, 'Redacción');

-- Subcategorías de Computación
INSERT INTO subcategorias (idcategoria, nombre) VALUES
	(3, 'Base de datos'),
	(3, 'Sistemas operativos'),
	(3, 'Lenguajes de programación');


CREATE TABLE editoriales (
	ideditorial INT AUTO_INCREMENT PRIMARY KEY,
	empresa VARCHAR(100) NOT NULL,
	nacionalidad VARCHAR(50) NOT NULL
) ENGINE = INNODB;

INSERT INTO editoriales (empresa, nacionalidad) VALUES
	('Santillana', 'España'),
	('Pearson', 'EEUU'),
	('Norma', 'Colombia');

CREATE TABLE recursos (
	idrecurso INT AUTO_INCREMENT PRIMARY KEY,
	idsubcategoria INT NOT NULL,
	ideditorial INT NOT NULL,
	tipo ENUM('FÍSICO','DIGITAL') NOT NULL,
	titulo VARCHAR(200) NOT NULL,
	apublicacion YEAR NOT NULL,
	isbn VARCHAR(20) UNIQUE,
	numpaginas INT,
	rutaportada VARCHAR(200),
	rutarecurso VARCHAR(200),
	estado ENUM('BUENO','REGULAR','MALO') NOT NULL,
	creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	modificado TIMESTAMP NULL,
	CONSTRAINT fk_subcategoria FOREIGN KEY (idsubcategoria) REFERENCES subcategorias(idsubcategoria),
	CONSTRAINT fk_editorial FOREIGN KEY (ideditorial) REFERENCES editoriales(ideditorial)
) ENGINE = INNODB;

-- Insertar recursos de prueba
INSERT INTO recursos (idsubcategoria, ideditorial, tipo, titulo, apublicacion, isbn, numpaginas, rutaportada, rutarecurso, estado) VALUES
	(2, 1, 'FÍSICO', 'Álgebra Elemental', 2007, '978-84-678-1234', 350, 'algebra.jpg', NULL, 'BUENO'),
	(7, 2, 'DIGITAL', 'Introducción a Bases de Datos', 2015, '978-0-13-397077-7', 500, 'basedatos.jpg', 'basedatos.pdf', 'REGULAR');


CREATE VIEW vw_listar_recursos AS
SELECT 
	r.idrecurso,
	r.titulo,
	r.tipo,
	r.apublicacion,
	r.isbn,
	r.numpaginas,
	r.estado,
	e.empresa AS editorial,
	e.nacionalidad,
	c.nombre AS categoria,
	s.nombre AS subcategoria,
	r.rutaportada,
	r.rutarecurso,
	r.creado,
	r.modificado
FROM recursos r
INNER JOIN editoriales e ON r.ideditorial = e.ideditorial
INNER JOIN subcategorias s ON r.idsubcategoria = s.idsubcategoria
INNER JOIN categorias c ON s.idcategoria = c.idcategoria;

-- Consultar vista
SELECT * FROM vw_listar_recursos;