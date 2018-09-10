<form role="form" method="post" enctype="multipart/form-data">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos personales</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nombre</label>
                  <input type="text" class="form-control" name="nuevoNombre" placeholder="Nombre" required="required">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Apellido Paterno</label>
                  <input type="text" class="form-control" name="aPaterno"  required="required" placeholder="Apellido Paterno">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Apellido Materno</label>
                  <input type="text" class="form-control" name="aMaterno" placeholder="Apellido Materno">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Departamento o Área</label>
                  <input type="text" class="form-control" name="area"  required="required" placeholder="">
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de usuario</h3>
            </div>
          <div class="box-body">
                  <div class="form-group">
                  <label for="user">Usuario</label>
                  </div>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control nombreUsuario" placeholder="Usuario" name="nuevoUsuario" required="required">
              </div>
              <br>
              <div class="form-group">
                  <label for="user">Contraseña</label>
                  </div>
                <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control pass1" required="required" name="nuevoPassword" placeholder="Contraseña" >
              </div>
              <div class="form-group gpass">
                  <label for="user">Re-Contraseña</label>

                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control pass2" required="required"  placeholder="Re-Contraseña">
               </div>
               <span class="help-block aviso" style="display: none;">Contraseñas no coinciden</span>
                 <label class="control-label aviso2" for="inputSuccess" style="display: none;"><i class="fa fa-check"></i> Contraseñas coinciden</label>
              </div>
              <br>
              <div class="form-group col-xs-5">
                  <label>Tipo de usuario</label>
                  <select class="form-control " name="tipoUsuario" required="required" >
                    <option value="">
                      selecione perfíl
                    </option>
                    <option value="admin">
                      Administrador
                    </option>
                    <option value="user">
                      Usuario
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="InputFile">Foto</label>
                  <input type="file" id="exampleInputFile" name="nuevaFoto">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Aceptar</button>
                <button type="reset" class="btn btn-danger pull-left">Cancelar</button>
              </div>

          </div>
          <!-- /.box -->

      </form>
       <?php
        $crearUsuario= new UsuariosController();
        $crearUsuario-> ctrCrearUsuario();
          ?>
