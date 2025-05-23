CREATE DATABASE IF NOT EXISTS viñanueva;
USE viñanueva;
DROP TABLE IF EXISTS CarritoCompras;
DROP TABLE IF EXISTS DetallesOrdenes;
DROP TABLE IF EXISTS imagenes_productos;
DROP TABLE IF EXISTS Ordenes;
DROP TABLE IF EXISTS Productos;
DROP TABLE IF EXISTS Categorias;
DROP TABLE IF EXISTS Usuarios;

START TRANSACTION;

CREATE TABLE Usuarios(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    telefono VARCHAR(9),
    correo VARCHAR(100) UNIQUE,
    psw VARCHAR(255),
    administrador TINYINT(1),
    confirmacion TINYINT(1),
    token VARCHAR(15)
);
INSERT INTO Usuarios VALUES (NULL,"Fabricio","Sanchez","997448151","Fabricio@correo.com","$2y$10$/tiv5KqauCugan9msNgz4utjOV1od4JQT3yga1Tv8rUlzGiSpjqRi",1,NULL,NULL);
CREATE TABLE Categorias(
    idCat INT(11) PRIMARY KEY AUTO_INCREMENT,
    NomCat VARCHAR(50)
);

CREATE TABLE Productos(
    idProduct INT(11) PRIMARY KEY AUTO_INCREMENT,
    NombreProduct VARCHAR(100),
    IdCategoria INT(11),
    unidades INT(5),
    descripcion VARCHAR(255),
    imagen VARCHAR(255),
    precio DECIMAL(6,2),
    CONSTRAINT FK_Categoria FOREIGN KEY(IdCategoria) REFERENCES Categorias(idCat) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE Ordenes(
    idOrder INT(11) PRIMARY KEY AUTO_INCREMENT,
    idUsuario INT(11),
    Fecha DATE,
    CONSTRAINT FK_Usuario FOREIGN KEY(idUsuario) REFERENCES Usuarios(id) ON DELETE SET NULL ON UPDATE SET NULL
);
CREATE TABLE imagenes_productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    ruta_imagen VARCHAR(255),
    CONSTRAINT Fk_ProductoKey FOREIGN KEY (producto_id) REFERENCES Productos(idProduct) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE DetallesOrdenes(
    IdDetalle INT(11) PRIMARY KEY AUTO_INCREMENT,
    OrdenId INT(11),
    ProductId INT(11),
    cantidad INT(11),
    CONSTRAINT FK_Orden FOREIGN KEY(OrdenId) REFERENCES Ordenes(idOrder) ON DELETE SET NULL ON UPDATE SET NULL,
    CONSTRAINT FK_Producto FOREIGN KEY(ProductId) REFERENCES Productos(idProduct) ON DELETE SET NULL ON UPDATE SET NULL
);
CREATE TABLE CarritoCompras (
    idCarrito INT(11) PRIMARY KEY AUTO_INCREMENT,
    idUsuario INT(11),
    idProducto INT(11),
    cantidad INT(11),
    fechaAgregado DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_Carrito_Usuario FOREIGN KEY (idUsuario) REFERENCES Usuarios(id) ON DELETE SET NULL ON UPDATE SET NULL,
    CONSTRAINT FK_Carrito_Producto FOREIGN KEY (idProducto) REFERENCES Productos(idProduct) ON DELETE SET NULL ON UPDATE SET NULL
);
-- SELECT c.NomCat FROM Productos p INNER JOIN Categorias c ON p.IdCategoria = c.idCat;
-- SELECT * FROM Productos p INNER JOIN imagenes_productos imp ON p.idProduct = imp.producto_id WHERE p.idProduct = 1;
-- SELECT * FROM categorias c INNER JOIN Productos p ON c.idCat = p.IdCategoria  GROUP BY c.NomCat;

-- REPLACE INTO usuarios (id, nombre, email)
-- VALUES (1, 'Juan Pérez', 'juan@example.com');
SELECT p.NombreProduct,u.nombre,o.Fecha,o.Total   FROM detallesordenes do INNER JOIN ordenes o ON do.OrdenId = o.idOrder INNER JOIN productos p ON p.idProduct = do.ProductId INNER JOIN usuarios u ON o.idUsuario = u.id;
