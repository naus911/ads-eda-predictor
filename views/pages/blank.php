<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        blank
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active"><?php 
          switch ($arg) {
             case 'list':
               print'Lista de Usuarios';
               break;
               case 'new':
               print'Nuevo Usuario';
               break;
             
             default:
                print'blank';
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
               print'Usuarios registrados en el sistema';
               break;
               case 'new':
               print'Registrar Nuevo Usuario en el sistema';
               break;
             
             default:
               print'blank';
               break;
           } ?></h3>
               
             </div>


            <!-- /.box-header -->
            <div class="box-body">
            
            <?php if ($arg=='list') {
              
            require 'modules/tablaUsuarios.php';
              

            }elseif ($arg=='new') {
              require 'modules/nuevoUsuario.php';
            }  ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->