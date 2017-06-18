
<?php
  //obtengo el archivo html y lo muestro en pantalla
  $plantilla = file_get_contents(__DIR__."/vista/index.html");
  echo $plantilla;