$(document).ready(function(){
    //Actualizar items del carrito
    $(".btn-update-item").on('click',function(e){
        e.preventDefault();

        var id = $(this).data('id');
        var href = $(this).data('href');
        var cantidad = $("#producto_" + id).val();

        window.location.href = href + "/" + cantidad;
    })
    
})