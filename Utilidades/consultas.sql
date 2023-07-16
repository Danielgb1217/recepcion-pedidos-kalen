INSERT INTO productos (nombre, tipo, color, talla, cantidad, costo_unidad, descripcion, imagen) 
VALUES  ('Pantalon', 'Hombre', 'Gris', 'chica', '15',37.600, 'Pantalon en aluminio', pantalon.jpg); 


tabla de pedidos
INSERT INTO pedidos (idcliente, idproducto, cantidad, fecha_pedido) 
VALUES  (9, 10, 12, '2022-10-10'); 

SELECT id FROM productos WHERE nombre = ' Polo para hombre Slim manga corta' 
AND color = 'Rosado' AND talla = 'Mediana';

INSERT INTO clientes (nombre, apellido, email, password, telefono, confirmado, token) 
VALUES  ('alde', 'Gutierrez', 'alde@mail.com', '1234', '3124536780','0', '0'); 



////JOIN
SELECT usuarios.id, usuarios.nombre,usuarios.apellido, usuarios.cedula, 
usuarios.telefono,usuarios.email, productos.nombre, productos.costo_unidad, 
pedidos.cantidad, pedidos.fecha_pedido FROM usuarios
JOIN pedidos ON usuarios.id = pedidos.idcliente
JOIN productos ON pedidos.idproducto = productos.id
WHERE usuarios.cedula =34657890808 ;