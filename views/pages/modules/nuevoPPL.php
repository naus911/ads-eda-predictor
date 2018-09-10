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
                  <input type="text" class="form-control nuevoPPL" name="nuevoNombrePPL" placeholder="Nombre" required="required">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Apellido Paterno</label>
                  <input type="text" class="form-control" name="aPaternoPPL"  required="required" placeholder="Apellido Paterno">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Apellido Materno</label>
                  <input type="text" class="form-control" name="aMaternoPPL" placeholder="Apellido Materno">
                </div>
               <div class="form-group col-md-6">
                <label>Fecha Nacimieto:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right fNacimiento"  name="fNacimientoPPL"  required id="datepickerNacimiento">
                </div>
                <!-- /.input group -->
              </div>
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">Edad</label>
                  <input type="text" class="form-control" name="edadPPL" id="edad" required="required" placeholder="">
                </div>
                <div class="form-group col-xs-6">
                  <label>Género</label>

                    <select class="form-control " name="sexoPPL" required="required" >
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
                  <label>Fecha de Ingreso:</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="fIngresoPPL" id="datepicker" required>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de Proceso</h3>
            </div>
          <div class="box-body">

                <div class="form-group col-md-6">
                <label for="user">Numero de proceso</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-legal"></i></span>
                <input type="text" class="form-control" placeholder="Numero de Proceso" name="proceso" required="required">
                </div>
              </div>

              <div class="form-group col-xs-6">
                  <label>Fuero</label>

                    <select class="form-control " name="fuero" required="required" >
                      <option value="">
                        Selecione fuero
                      </option>
                      <option value="C">
                        COMÚN
                      </option>
                      <option value="F">
                        FEDERAL
                      </option>
                    </select>

              </div>
                <div class="form-group col-xs-6">
                  <label>Situación</label>
                  <select class="form-control " name="situacion" required="required" >
                    <option value="">
                      Selecione Situación
                    </option>
                    <option value="P">
                      PROCESADO
                    </option>
                    <option value="S">
                      SENTECIADO
                    </option>
                  </select>
                </div>
                <div class="form-group col-xs-6">
                <label for="user">Delito</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-cab"></i></span>
                <input type="text" class="form-control" name="delito" placeholder="Delito" required="required">
                </div>
                 </div>
                <div class="form-group col-md-8">
                  <label for="InputFile">Foto</label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-camera"></i></span>
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
      <script type="text/javascript">

      </script>

       <?php
       $crearPPL= new PPLController();
       $crearPPL-> ctrCrearPPL();
