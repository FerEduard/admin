<?php 
include_once ("class/lib.php");

$comp = new lib();
?>

<!doctype html>
<html>
<head>

    <meta charset="utf-8">

    <title>Sección</title>
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
                            Sección
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-xs-6">
                        <form id="forma" name="<?php echo $comp->encriptar("seccion") ?>">
                          	<?php $comp->textField("Código", "Código", "COD_SECCION", true)?>
                            <?php $comp->comboBox("Idioma","SELECT COD_IDIOMA, DESCRIPCION FROM idioma","COD_IDIOMA");?>
                            <?php $comp->comboBox("Lección","SELECT l.COD_LECCION, CONCAT( m.DESCRIPCION, CONCAT(' - ',l.TITULO)) TITULO FROM leccion l INNER JOIN modulo m on m.COD_MODULO = l.COD_MODULO ORDER BY COD_LECCION, ORDEN","COD_LECCION");?>
							<?php $comp->textField("Expresión", "Expresión", "EXPRESION")?>
                            <?php $comp->textField("Traducción", "Traducción", "TRADUCCION")?>
                            <?php $comp->textField("Imagen", "Path imagen", "IMG1")?>
                            <?php $comp->textField("Imagen", "Path imagen", "IMG2")?>
                            <?php $comp->textField("Audio", "Path audio", "AUDIO")?>
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
