<?php

  //incluir clase modelo para manejar consultas a la base de datos
  include ('../modelo/modelo.php');

  //instancia de la clase modelo
  $modelo = new modelo();


  //se llama al metodo conectar de la clase modelo para conectar a la base de datos.
  $modelo->conectar();
  



  

  //--------------obtiene el ultimo id para insertar el siguiente.
  $id_cliente = 123456543;


  $query = "SELECT p.id_producto as id, p.nombre as nombre_producto, count(p.id_producto) as cantidad_producto, p.precio_unitario*count(p.id_producto) as total FROM pedido pd INNER JOIN producto p on pd.id_producto=p.id_producto WHERE pd.id_cliente=$id_cliente group by nombre_producto;";
  
  $vari = $modelo->consultar($query);
  $text='';
   while ($row = mysqli_fetch_array($vari)) {

      $id=$row['id'];
      $nombre = $row['nombre_producto'];
      $cantidad = $row['cantidad_producto'];
      $total = $row['total'];

      $text .= 
      '<tr>
        <td id="id" hidden>'.$id.'</td>
        <td id="nombre">'.$nombre.'</td>
        <td id="cant">'.$cantidad.'</td>
        <td id="total">$ '.$total.'</td>
        <td><button class="btn-danger btn-circle"><span class="glyphicon glyphicon-minus"></span></button></td>
      </tr>';
   }
   echo $text;
  $modelo->desconectar();