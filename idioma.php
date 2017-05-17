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
                        <form id="forma" name="<?php echo $comp->encriptar("IDIOMA") ?>">
                          	<?php $comp->textField("Código", "Código", "COD_IDIOMA", true)?>
							<?php $comp->textField("Descripción", "Descripción", "DESCRIPCION", true)?>
                          <button type="button" id="guardar" class="btn btn-default">Guardar</button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->    

</body>

<script>
$(document).ready(function(){
	var array = {tabla : $("#forma").attr("name")};
	
	$("#guardar").click(function(){
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
			 alert(data.query);
		 })
		 .fail(function( jqXHR, textStatus, errorThrown ) {
			 if ( console && console.log ) {
				 console.log( "La solicitud a fallado: " +  textStatus);
			 }
		});
	});
});
</script>

</html>
