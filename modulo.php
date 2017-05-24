<?php 
include_once ("class/lib.php");

$comp = new lib();
?>

<!doctype html>
<html>
<head>

    <meta charset="utf-8">

    <title>Modulo</title>
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
                            Modulo
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-xs-6">
                        <form id="forma" name="<?php echo $comp->encriptar("modulo") ?>">
                          	<?php $comp->textField("Código", "Código", "COD_MODULO", true)?>
                            <?php $comp->comboBox("Grupo","SELECT COD_GRUPO, DESCRIPCION FROM grupo ORDER BY ORDEN","COD_GRUPO");?>
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

</html>
