
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        VISITAS
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active"><?php
          switch ($arg) {
             case 'list':
               print'Lista de Personas';
               break;
               case 'new':
               print'Nueva Persona';
               break;

             default:
               // code...
               break;
           } ?></li>
      </ol>
    </section>

    <!-- Main content -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php
          switch ($arg) {
             case 'list':
               print'Personas registrados en el sistema';
               break;
               case 'new':
               print'Registrar nueva persona en el sistema';
               break;

             default:
               // code...
               break;
           } ?></h3>
             </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php if ($arg=='list') {
            require 'modules/tablaVisitas.php';
          }elseif ($arg=='asignar') {
              require 'modules/asignarPPL.php';
            }elseif ($arg=='edit') {
              require 'modules/#';
            }  ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      <script src="views/js/visitas.js" charset="utf-8"></script>
