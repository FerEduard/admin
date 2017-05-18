<?php 
include_once ("class/lib.php");

$comp = new lib();
?>

<!doctype html>
<html>
<head>

    <meta charset="utf-8">

    <title>Idioma</title>
    <?php include ("inc/libs.php");?>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include ("inc/menu.php");?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Idioma
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-xs-6">
                        <form id="forma" name="<?php echo $comp->encriptar("idioma") ?>">
                          	<?php $comp->textField("Código", "Código", "COD_IDIOMA", true)?>
							<?php $comp->textField("Descripción", "Descripción", "DESCRIPCION")?>
                          <button type="button" id="guardar" class="btn btn-default">Guardar</button>
                          <button type="button" id="limpiar" class="btn btn-default">Limpiar</button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper --> 
    
<div class="modal fade" id="mensaje" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Mensaje</h4>
      </div>
      <div class="modal-body">
        <p id="cuerpo-mensaje">One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->   

</body>

<script>
$(document).ready(function(){
	$("#limpiar").click(function(){ $("#forma")[0].reset(); });
	
	$("#guardar").click(function(){	
		var array = {tabla : $("#forma").attr("name")};
		//En caso de actualizar
		if(!isEmpty()){
			array["UP"] = "S";
			$(".df").each(function(key, value) {
				array["(id)"+ $(this).attr("id")] = $(this).val();
			});
		}
		
		$(".frm").each(function() {
			array[$(this).attr("name")] = $(this).val();
        });
			
		$.ajax({
			data: array,
			type: "POST",
			dataType: "json",
			url: "class/op.php",
		})
		 .done(function( data, textStatus, jqXHR ) {
			if (typeof data.mensaje !== 'undefined') {
				$("#cuerpo-mensaje").html(data.mensaje);
				$('#mensaje').modal('show');
				
				if (typeof data.ok == 'undefined') {
					$("#forma")[0].reset();
					return;
				}
			}
			 
			 $.each(data, function(key, value){
				 $(".df").each(function() {
					 if($(this).attr("id") == key){
					 	$(this).val(value);
					 }
				});
			 });
		 })
		 .fail(function( jqXHR, textStatus, errorThrown ) {
			 if ( console && console.log ) {
				 console.log( "La solicitud a fallado: " +  textStatus);
			 }
		});
	});
	
	$(".df").focusout(function(){
		var array = {tabla : $("#forma").attr("name")};
		var vacios = false;
		
		$(".df").each(function() {
			array[$(this).attr("name")] = $(this).val();
			if($(this).val() == ''){
				vacios = true;
			}
        });
		
		
		if(vacios){
			return;
		}
		
		$.ajax({
			data: array,
			type: "POST",
			dataType: "json",
			url: "class/find.php",
		})
		 .done(function( data, textStatus, jqXHR ) {
			if (typeof data.mensaje !== 'undefined') {
				$("#forma")[0].reset();
				$("#cuerpo-mensaje").html(data.mensaje);
				$('#mensaje').modal('show');
				return;
			}
			
			 $.each(data, function(key, value){
				 $(".frm").each(function() {
					 if($(this).attr("id") == key){
					 	$(this).val(value);
					 }
				});
			 });
		 })
		 .fail(function( jqXHR, textStatus, errorThrown ) {
			 $("#forma")[0].reset();
		});
	});
	
	function isEmpty(){
		var vacios = false;
		$(".df").each(function() {
			if($(this).val() == ''){
				vacios = true;
			}
        });	
		return vacios;
	}
});
</script>

</html>
