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
                  <input type="text" class="form-control" name="nuevoNombrePersona" placeholder="Nombre" required="required">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Apellido Paterno</label>
                  <input type="text" class="form-control" name="aPaterno"  required="required" placeholder="Apellido Paterno">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Apellido Materno</label>
                  <input type="text" class="form-control" name="aMaterno" placeholder="Apellido Materno">
                </div>
                <div class="form-group col-md-6">
                 <label>Fecha Nacimieto:</label>

                 <div class="input-group date">
                   <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                   </div>
                   <input type="text" class="form-control pull-right fNacimiento"  name="fNacimiento"  required id="datepickerNacimiento">
                 </div>
                 <!-- /.input group -->
               </div>
                 <div class="form-group col-md-4">
                   <label for="exampleInputEmail1">Edad</label>
                   <input type="text" class="form-control" name="edad" id="edad" required="required" placeholder="">
                 </div>
                 <div class="form-group col-xs-6">
                   <label>Género</label>

                     <select class="form-control" name="sexo" required="required" >
                       <option value="">
                         Selecione Género
                       </option>
                       <option value="M">
                         MASCULINO
                       </option>
                       <option value="F">
                         FEMEMINO
                       </option>
                     </select>

               </div>
                 <div class="form-group col-md-6">
                   <label for="">Lugar de Nacimiento</label>
                   <input type="text" class="form-control" name="lNacimiento" placeholder="Lugar de Nacimiento">
                 </div>
              </div>
            </div>
        </div>
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Detalle Persona</h3>
            </div>
          <div class="box-body">
            <div class="form-group col-xs-6">
              <label>Estado Civil</label>

                <select class="form-control " name="edoCivil" required="required" >
                  <option value="">
                    Selecione
                  </option>
                  <option value="1">
                    SOLTERO
                  </option>
                  <option value="2">
                    CASADO
                  </option>
                  <option value="3">
                    UNION LIBRE
                  </option>
                  <option value="4">
                    DIVORCIADO(A)
                  </option>
                  <option value="5">
                    VIUDO(A)
                  </option>
                  <option value="6">
                    OTRO
                  </option>
                </select>

          </div>
          <div class="form-group col-md-6">
            <label for="">Máximo Grado de Estudios</label>
            <input type="text" class="form-control" name="escolaridad" placeholder="Lugar de Nacimiento">
          </div>
          <div class="form-group col-md-6">
            <label for="">Ocupación</label>
            <input type="text" class="form-control" name="ocupacion" placeholder="Ocupacion">
          </div>
          <div class="form-group col-md-6">
            <label for="">Numero de hijos</label>
            <input type="text" class="form-control" name="nHijos" placeholder="Numero de hijos">
          </div>


                <div class="form-group col-md-12">
                  <label for="InputFile">Foto</label>
                  <input type="file" id="exampleInputFile" class="nuevaFoto" name="nuevaFoto" >
                  <p class="help-block">Peso máximo de la foto 2MB</p>
             <img src="views/images/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
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
      $crearPersona= new PersonasController();
      $crearPersona-> ctrCrearPersona();
