<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios

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
               print'Usuarios registrados en el sistema';
               break;
               case 'new':
               print'Registrar Nuevo Usuario en el sistema';
               break;

             default:
               // code...
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
<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" action="users/list" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <input type="hidden" name="userId" id="userId" value="">
            <input type="hidden" name="nuevoUsuario" id="nuevoUsuario" value="" readonly >
            <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Nombre</label>
              <div class="input-group">
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" placeholder="Nombre" required>
              </div>
            </div>

            <div class="form-group col-xs-6">
              <label for="exampleInputEmail1">Apellido Paterno</label>
              <div class="input-group">
                <input type="text" class="form-control input-lg" name="editarApaterno" id="editarApaterno" value="" placeholder="Apellido Paterno" required>
              </div>
            </div>

            <div class="form-group col-xs-12">
               <label for="exampleInputEmail1">Apellido Materno</label>
              <div class="input-group">
                <input type="text" class="form-control input-lg" id="editarAmaterno" name="editarAmaterno" value="" placeholder="Apellido Materno" required>
              </div>
            </div>
            <hr>

            <div class="form-group  col-xs-6">
            <label for="exampleInputEmail1">Area</label>
              <div class="input-group">
                <input type="text" class="form-control input-lg" id="editarArea" name="editarArea" value="" placeholder="Area" required>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Tipo de usuario</label>
              <div class="input-group col-xs-6">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarPerfil">
                  <option value="" id="editarPerfil"></option>
                  <option value="admin">Administrador</option>
                  <option value="user">Usuario</option>
                </select>
              </div>
            </div>
             <div class="form-group col-xs-6">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg  pass1" name="editarPassword" placeholder="Escriba contraseña">

              </div>

            </div>
             <div class="form-group col-xs-6 gpass">
              <div class="input-group">
              <input type="password" class="form-control input-lg pass2"  placeholder="Rescriba la contraseña">
              </div>
              <span class="help-block aviso" style="display: none;">Contraseñas no coinciden</span>
              <label class="control-label aviso2" for="inputSuccess" style="display: none;"><i class="fa fa-check"></i> Contraseñas coinciden</label>
              </div>

            <div class="form-group ">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="views/images/default/anonymous.png" id="fotoActual" class="img-thumbnail previsualizar" width="100px">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

        </div>
      </form>
    </div>
  </div>
</div>
<script src="views/js/usuarios.js"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if($_POST['userId']!=""){
    $editar= new UsuariosController();
    $editar->ctrEditarUsuario();
  }
} ?>
