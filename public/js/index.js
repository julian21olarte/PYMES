$(document).ready(function() {

  

// peticion POST para mostrar los productos en la pagina
  $.post("controladores/getProducts.php", { action: 'getProducts' },function(data) {
    $('.container section .row.products-container').append(data);
  });




//funcion con peticion POST para agregar producto al carrito del usuario.
//se esta suponiendo un usuario al momento de insertar en la BD en el archivo addCarrito.php....
//reemplazar datos de cliente y usuario.
  $('.row.products-container').on('click','.addShoppingCart', function(e){
    let id = $(this).parent().parent().find('#id b').text();
    alert('agregar producto = '+id);
    
    $.post("controladores/addCarrito.php", {id_producto: id}, function(data) {
      //$('.modal-carrito .modal-body .table tbody').append(data);
     alert(data);
    });
  });




  $('#modal-carrito').on('show.bs.modal', function(e) {
    
    $.post('controladores/getPedidos.php', function(data) {
      $('#modal-carrito .modal-dialog .modal-body .table tbody').html(data);
    });
  });


  $('#modal-carrito .btn.btn-success').on('click', function(e) {
    
    $.post('controladores/confirmarCompra.php', function(data) {
      alert(data);
      $('#modal-carrito .modal-dialog .modal-body .table tbody').html(data);
    });
  });



  $('#modal-carrito .modal-body .table tbody').on('click','.btn-danger.btn-circle', function(e) {
    
    let id = $(this).parent().siblings('#id').text();
    let cant = $(this).parent().siblings('#cant').text();
    
    if(--cant) {
      $(this).parent().siblings('#cant').text(cant);
    }
    else{
      $(this).parent().parent().remove();
    }

    $.post('controladores/removeCarrito.php',{id_producto:id}, function(data) {
      alert(data);
    });
  });

});