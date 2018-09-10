<?php $estados=catalogoController::ctrMostrarEstados(); ?>
<form role="form" id="formEditar" method="post" enctype="multipart/form-data">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Expediente de Persona</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

              <div class="box-body">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-square previsualizar" src="views/images/default/anonymous.png" alt="User profile picture">

                  <h3 class="profile-username text-center"></h3>

                  <p class="text-muted text-center profile-lastname"></p>
                  <div class="form-group col-md-12">
                    <label for="InputFile">Foto</label>
                    <input type="file" id="exampleInputFile" class="nuevaFoto" name="nuevaFoto" >
                    <p class="help-block">Peso máximo de la foto 2MB</p>

                  </div>

                </div>
                <input type="hidden" name="idPersona" id="idPersona" value="">
                <input type="hidden" name="imgPersona" id="imgPersona" value="">
                  <div class="form-group">
                  <label for="">Nombre</label>
                  <input type="text" class="form-control" name="nuevoNombrePersona" id="Nombre"placeholder="Nombre" required="required">
                </div>
                <div class="form-group">
                  <label for="">Apellido Paterno</label>
                  <input type="text" class="form-control" name="aPaterno" id="Apaterno" required="required" placeholder="Apellido Paterno">
                </div>
                <div class="form-group">
                  <label for="">Apellido Materno</label>
                  <input type="text" class="form-control" name="aMaterno"id="Amaterno" placeholder="Apellido Materno">
                </div>
                <div class="form-group col-md-6">
                 <label>Fecha Nacimieto:</label>

                 <div class="input-group date">
                   <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                   </div>
                   <input type="text" class="form-control pull-right fNacimiento"  name=" fNacimiento"  required id="datepickerNacimiento">
                 </div>
                 <!-- /.input group -->
               </div>
                 <div class="form-group col-md-4">
                   <label for="">Edad</label>
                   <input type="text" class="form-control" name="edad" id="edad" required="required" placeholder="">
                 </div>
                 <div class="form-group col-xs-6">
                   <label>Género</label>

                     <select class="form-control" name="sexo" id="sexo"required="required" >
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
                   <input type="text" class="form-control" name="lNacimiento" id="lNacimiento"placeholder="Lugar de Nacimiento">
                 </div>
              </div>
            </div>
        </div>
        <!-- detalle persona -->
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Detalle Persona</h3>
            </div>
          <div class="box-body">
            <div class="form-group col-xs-6">
              <label>Estado Civil</label>

                <select class="form-control " name="edoCivil"id="edoCivil" required="required" >
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
            <input type="text" class="form-control" name="escolaridad"id="escolaridad" placeholder="Lugar de Nacimiento">
          </div>
          <div class="form-group col-md-6">
            <label for="">Ocupación</label>
            <input type="text" class="form-control" name="ocupacion"id="ocupacion" placeholder="Ocupacion">
          </div>
          <div class="form-group col-md-6">
            <label for="">Numero de hijos</label>
            <input type="text" class="form-control" name="nHijos"id="nHijos" placeholder="Numero de hijos">
          </div>



              </div>
          </div>
        </div>
        <!-- Ubicacion Persona -->
        <div class="col-md-6">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Contacto Persona</h3>
            </div>
          <div class="box-body">
            <div class="form-group col-xs-6">
              <label>Entidad Federativa</label>

                <select class="form-control " name="estado"id="estado" required="required" >
                  <option value="">Selecione Estado</option>
                  <?php foreach ($estados as $key => $value) {
                    print'<option value="'.$value['clave'].'">'.$value['nombre'].'</option>';
                  } ?>

                </select>

          </div>
          <div class="form-group col-md-6">
            <label for="">Ciudad</label>
            <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad">
          </div>
          <div class="form-group col-md-6">
            <label for="">Calle</label>
            <input type="text" class="form-control" name="calle"id="calle" placeholder="Calle">
          </div>
          <div class="form-group col-md-4">
            <label for="">Numero</label>
            <input type="text" class="form-control" name="numero"id="numero" placeholder="Numero">
          </div>
          <div class="form-group col-md-6">
            <label for="">Colonia</label>
            <input type="text" class="form-control" name="colonia" id="colonia"placeholder="Colonia">
          </div>
          <div class="form-group col-md-4">
            <label for="">Codigo Postal</label>
            <input type="text" class="form-control" name="codigoPostal"id="codigoPostal" maxlength="5" placeholder="Codigo Postal">
          </div>
          <div class="form-group col-md-4">
            <label for="">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono"maxlength="12" placeholder="Teléfono">
          </div>
          <div class="form-group col-md-4">
            <label for="">Celular</label>
            <input type="text" class="form-control" name="celular" id="celular"maxlength="12" placeholder="Celular">
          </div>

              </div>
            </div>
        </div>
        <!-- Medico Persona -->
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Perfil Médico Persona</h3>
            </div>
          <div class="box-body">

          <div class="form-group col-md-4">
            <label for="">Número Social</label>
            <input type="text" class="form-control" name="numeroSocial"id="numeroSocial" placeholder="Número Social">
          </div>
          <!-- radio -->
          <div class="form-group col-md-6">
            <label>Enfermedades  </label>
            <label for="">SI</label>
              <input type="radio" name="enfermedades" value="1" id="e-radio" class="minimal" >
              <label for="">NO</label>
              <input type="radio" name="enfermedades" value="0" id="ex-radio" class="minimal">
            <br><br>
              <div id="e-text" style="display:none;">
                <label for="">Especifique Enfermedad</label>
                <input type="text" class="form-control" name="espEnfermedad"id="espEnfermedad"  placeholder="Enfermedad" >
              </div>
            </div>

          <div class="form-group col-md-6">
            <label>Discapacidad  </label>
              <label for="">SI</label>
              <input type="radio" name="discapacidad" value="1" id="d-radio" class="minimal">
              <label for="">NO</label>
              <input type="radio" name="discapacidad" value="0" id="dx-radio" class="minimal">
            <br><br>
            <div id="d-text" style="display:none;">
              <label for="">Especifique Discapacidad</label>
              <input type="text" class="form-control" name="espDiscapacidad"id="espDiscapacidad" placeholder="Discapacidad">
            </div>
              </div>


              </div>
            </div>
        </div>
        <!-- Medico Persona -->
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Obseraciones Persona</h3>
            </div>
          <div class="box-body">
            <div class="form-group">
              <label>Observaciones</label>
              <textarea class="form-control" rows="3" name="observaciones"id="observaciones" placeholder="Introduzca observación alguna ..."></textarea>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Aceptar</button>
<button type="reset" class="btn btn-danger pull-left btnCancelar">Cancelar</button>
            </div>


          </div>
              <!-- /.box-body -->



          </div>
        </div>

      </form>

      <script>
          $(document).ready(function () {

          loadDataPersona();

        })</script>
      <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $crearPersona= new PersonasController();
      $crearPersona-> ctrEditarPersona();
    }
