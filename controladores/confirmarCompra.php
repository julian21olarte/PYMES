<?php

  //incluir clase modelo para manejar consultas a la base de datos
  include ('../modelo/modelo.php');

  //instancia de la clase modelo
  $modelo = new modelo();


  //se llama al metodo conectar de la clase modelo para conectar a la base de datos.
  $modelo->conectar();
  


  $id_cliente = 123456543;

  $query = "select MAX(id_factura) as max from factura;";
  $vari = $modelo->consultar($query);
  $text='';
  $row = mysqli_fetch_array($vari);
  //-------------------------fin
//----------------
  $id_factura = $row['max']++;
  $id_empleado = 0;

  //--------------obtengo los datos de los pedidos del cliente de la tabla pedido.
  $query = "SELECT * FROM pedido WHERE id_cliente = $id_cliente;";
  $vari = $modelo->consultar($query);
  $text='';

  //convierte en array el resultado de la consulta
  while ($row = mysqli_fetch_array($vari)) {
    $row_a[] = $row;
  }

  //recorre el array de registros y agrega una factura por cada pedido
  foreach( $row_a as $row_aux) {
    $id_factura++;
    $id_pedido = $row_aux['id_pedido'];
    $id_producto = $row_aux['id_producto'];
    $tipo_empleado = 1;
    $query2 = "INSERT INTO factura VALUES($id_factura, $id_cliente, $id_producto, $id_empleado, $tipo_empleado);";
    $vari2 = $modelo->consultar($query2);
  }


//elimina los pedidos de la tabla pedido_producto
  $query = "DELETE pdp FROM pedido_producto pdp inner join pedido p on pdp.id_pedido=p.id_pedido WHERE id_cliente = $id_cliente;";
   $vari = $modelo->consultar($query);
 
  //---------------elimino los pedidos de la tabla pedido.
   $query = "DELETE FROM pedido WHERE id_cliente = $id_cliente;";
   $vari = $modelo->consultar($query);
 //------------inserto los datos de los pedidos en la tabla factura
  
  $text='';
  echo $text;

  //-------------------------fin







//----------------inserta en las tablas pedido y pedido_producto
  //-------------------------fin

  $modelo->desconectar();