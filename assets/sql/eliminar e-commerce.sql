-- Eliminar todas las tablas en el orden correcto para evitar problemas de dependencia
DROP TABLE IF EXISTS mensajes_por_producto;
DROP TABLE IF EXISTS Compras;
DROP TABLE IF EXISTS CarritoCompra;
DROP TABLE IF EXISTS ProductoCategoria;
DROP TABLE IF EXISTS Categorias;
DROP TABLE IF EXISTS Productos;
DROP TABLE IF EXISTS DatosBancarios;
DROP TABLE IF EXISTS ClienteNoRegistrado;
DROP TABLE IF EXISTS EncargadoInventarios;
DROP TABLE IF EXISTS DatosEmpresa;
DROP TABLE IF EXISTS ClienteRegistrado;
DROP TABLE IF EXISTS Rol;

-- Eliminar la base de datos ecommerce
DROP DATABASE IF EXISTS ecommerce;
