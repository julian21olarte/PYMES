<?php

  //incluir clase modelo para manejar consultas a la base de datos
  include ('../modelo/modelo.php');

  //instancia de la clase modelo
  $modelo = new modelo();


  //se llama al metodo conectar de la clase modelo para conectar a la base de datos.
  $modelo->conectar();
  



  

  //--------------obtiene el ultimo id para insertar el siguiente.
  $query = "select MAX(id_pedido) as max from pedido;";
  $vari = $modelo->consultar($query);
  $text='';
  $row = mysqli_fetch_array($vari);
  //-------------------------fin







//----------------inserta en las tablas pedido y pedido_producto
  $id = $row['max']+1;
  $id_cliente = 123456543;
  $id_producto = $_POST['id_producto'];
  $id_empleado = 0; //empleado insertado en la base de datos (nombre = internet, id=0)
  $tipo_pedido = 'Pedido realizado por internet.';

  $alt = '';

  $query = "INSERT INTO pedido VALUES($id, $id_cliente, $id_producto, $id_empleado, '$tipo_pedido');";
  $vari = $modelo->consultar($query); //inserta el pedido en la tabla pedido;

  $query = "INSERT INTO pedido_producto VALUES($id, $id_producto);";
  $alt.=$query.' --> ';
  $vari = $modelo->consultar($query); //inserta registro en la tabla pedido_producto con lso datos de la consulta anterior

  //-------------------------fin

  $modelo->desconectar();
  
