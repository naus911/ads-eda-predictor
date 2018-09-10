<?php $parentesco=catalogoController::ctrMostrarParentesco(); ?>
<form role="form" method="post" enctype="multipart/form-data">
        <!-- left column -->
        <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle previsualizar" src="views/images/default/anonymous.png" alt="User profile picture">
            <h3 class="profile-username text-center"></h3>

            <p class="text-muted text-center profile-lastname"></p>


          </div>
          <!-- /.box-body -->
        </div>
      </div>
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Seleccione PPL</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->

              <div class="box-body">

                <div class="form-group col xs-6">
                  <label>Seleccione PPL</label>
                  <input type="hidden" name="idPersona" id="idPersona" value="">
                  <select class="form-control select2 ppl" name="idPPL" style="width: 100%;">
                    <option>Buscar PPL</option>
                  <?php foreach ($ppls as $key => $value) {
                  print'<option value="'.$value['rowid_ppl'].'" ruta="'.$value['foto_ppl'].'">'.$value['aPaterno_ppl'].' '.$value['aMaterno_ppl'].' '.$value['nombre_ppl'].'</option>';
                  } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
            <!-- Medico Persona -->
            <div class="col-md-12">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Perfil de Visita</h3>
                </div>
              <div class="box-body">
                <div class="form-group col-xs-6">
                  <label>Parentesco</label>

                    <select class="form-control " name="parentesco" id="edoCivil" required="required" >
                      <?php foreach ($parentesco as $key => $value) {
                      print'<option value="'.$value['clave_parentesco'].'">'.$value['descripcion_parentesco'].'</option>';
                      } ?>
                    </select>

              </div>


              <!-- radio -->
              <div class="form-group col-md-6">
                <label>Tipo de Visita </label><br>
                <ul>
							<li>
								<input type="radio" id="familiar-option" value="FAM" name="tVisita"/>
								<label for="familiar-option">Familiar</label>
								<div class="check"></div>
							</li>
							<li>
								<input type="radio" id="intima-option" name="tVisita" value="CON" />
								<label for="intima-option">Conyugal</label>
								<div class="check"></div>
							</li>
							<li>
								<input type="radio" id="temp-option" name="tVisita" value="TEM" />
								<label for="temp-option">Temporal (Única Ocasión)</label>
								<div class="check"></div>
							</li>
						</ul>
                </div>

                </div>
                </div>
            </div>
            <div class="col-md-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Requisitos de Visita</h3>
                </div>
              <div class="box-body">
                  <div class="form-group col-md-6">
                    <ul>
							<li>
								<input type="checkbox" id="k-option" name="cParentesco" value="1"/>
								<label for="k-option">Comprobante parentesco</label>
								<div class="check"><div class="inside"></div></div>
							</li>

							<li>
								<input type="checkbox" id="l-option" name="cElector" value="1">
								<label for="l-option">Identifiación</label>
								<div class="check"><div class="inside"></div></div>
							</li>
							<li>
								<input type="checkbox" id="m-option" name="curp" value="1">
								<label for="m-option">CURP</label>
								<div class="check"><div class="inside"></div></div>

							</li>
							<li>
								<input type="checkbox" id="n-option" name="fotos" value="1">
								<label for="n-option">Fotografias</label>
								<div class="check"><div class="inside"></div></div>

							</li>

							<li>
								<input type="checkbox" id="o-option" name="acta" value="1">
								<label for="o-option">Acta de Nacimiento</label>
								<div class="check"><div class="inside"></div></div>
							</li>
							<li>
								<input type="checkbox" id="p-option" name="cDom" value="1">
								<label for="p-option">Comprobante Domicilio</label>
								<div class="check"><div class="inside"></div></div>
							</li>

						</ul>
          </div>
          <div class="form-group col-md-6 diasConyugal" style="display:none;">
            <label class="rating">Dias de Visita <span>:</span></label>
        <ul>
        <li>
            <input type="radio" id="g-option" name="dia" value="MA" />
            <label for="h-option">Martes</label>
            <div class="check"><div class="inside"></div></div>
          </li>
          <li>
            <input type="radio" id="h-option" name="dia" value="MI" />
            <label for="h-option">Miercoles</label>
            <div class="check"><div class="inside"></div></div>
          </li>

          <li>
            <input type="radio" id="i-option" name="dia" value="VI">
            <label for="i-option">Viernes</label>
            <div class="check"><div class="inside"></div></div>
          </li>
          <li>
            <input type="radio" id="j-option" name="dia" value="DO" >
            <label for="j-option">Domingo</label>
            <div class="check"><div class="inside"></div></div>
          </li>
        </ul>
              </div>
          <div class="col-md-6  rMedicos" style="display:none;">
                  <label class="rating">Requisitos Medicos <span>:</span></label>
      					    	<br>
      						 	<div class="form-control">
      								<label for="q-option">
                        <input type="checkbox" id="eMedicocheck" name="eMedico" value="1"  > E.Medico</label>
      								<div id="emedico"class="pull-right"><lable>Fecha de Estudio</label>
      								<input type="text" class="input-medium  datepicker" id="datepicker" name="fMedico" >
      							</div>
                  </div><br>
								<div class="form-control">

								<label for="q-option">
                  <input type="checkbox" id="ePapacheck" name="ePapa" value="1"  >E. Pananicolaou</label>
								<div id="epapa" class="pull-right">Fecha de Estudio
								<input type="text" class="input-medium  datepicker" id="datepicker" name="fPapa" >
									</div>
									</div>
                  <br>
								<div class="form-control">
								<label for="r-option"><input type="checkbox" id="eVihcheck" name="eVih" value="1"  >E. VIH</label>
								<div id="evih" class="pull-right">Fecha de Estudio
                  <input type="text" class="input-medium datepicker" id="datepicker" name="fVih"   ></div>
                </div>
            </div>
            <div class="col-md-6 temporal" style="display:none;">
              <div class="form-control">
              <label>Permiso Temporal </label>
              <div   class="pull-right">
                <input type="text" class="input-medium" name="temporal"  placeholder="Especifique el permiso" ></div>
              </div>
            </div>
        </div>
    </div>
</div>


              <!-- /.box-body -->


              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Aceptar</button>
                <button type="reset" class="btn btn-danger pull-left">Cancelar</button>
              </div>



          <!-- /.box -->

      </form>
