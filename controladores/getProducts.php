<?php

  //incluir clase modelo para manejar consultas a la base de datos
  include ('../modelo/modelo.php');

  //instancia de la clase modelo
  $modelo = new modelo();


  //se llama al metodo conectar de la clase modelo para conectar a la base de datos.
  $modelo->conectar();
  
  $query = "SELECT * FROM producto;";
  $vari = $modelo->consultar($query);
  $text='';
  while ($row = mysqli_fetch_array($vari)) {
    $id = $row['id_producto'];
    $nombre = $row['nombre'];
    $descripcion = $row['descripcion'];
    $precio = $row['precio_unitario'];
    $stock = $row['cant_stock'];

    $text .=	'<div class="col-xs-12 col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 id="nombre" >'.$nombre.'</h4>
        </div>
        <div class="panel-body">
          <p id="id" hidden>id: <b>'.$id.'</b></p>
          <p id="descripcion" >Descripcion: <b>'.$descripcion.'</b></p>
          <p id="precio" >Precio: $<b>'.$precio.'</b></p>
          <p id="stock" >Stock: <b>'.$stock.'</b></p>
        </div>
        <div class="panel-footer clearfix">
          <button class="btn btn-sm btn-success pull-right addShoppingCart"><span class="glyphicon glyphicon-shopping-cart"></span>Agregar al carrito</button>
        </div>
      </div>
    </div>';
  }
  echo $text;
  $modelo->desconectar();
  