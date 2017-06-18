<?php

  //incluir clase modelo para manejar consultas a la base de datos
  include ('../modelo/modelo.php');

  //instancia de la clase modelo
  $modelo = new modelo();


  //se llama al metodo conectar de la clase modelo para conectar a la base de datos.
  $modelo->conectar();
  



  

  //--------------obtiene el ultimo id para insertar el siguiente.
  $id_cliente = 123456543;

  $id_producto = $_POST['id_producto'];

  $query = "SELECT MAX(p.id_pedido) as max FROM pedido p WHERE p.id_producto = $id_producto LIMIT 1;";
  $vari = $modelo->consultar($query);
  while($row = mysqli_fetch_array($vari)) {
    $id_pedido = $row['max'];
  }

  $query = "DELETE pdp FROM pedido_producto pdp WHERE pdp.id_producto = $id_producto and pdp.id_pedido =$id_pedido;";
  $vari = $modelo->consultar($query);


  $query = "DELETE FROM pedido WHERE id_producto = $id_producto and id_cliente = $id_cliente and id_pedido = $id_pedido;";
  $vari = $modelo->consultar($query);

  echo $query;


