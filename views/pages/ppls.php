<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i>  PERSONAS PRIVADAS DE SU LIBERTAD
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active"><?php
          switch ($arg) {
             case 'list':
             if ($page=='ppls') {
               print'Lista de PPLs';
             }elseif ($page=='users') {
            print'Lista de Usuarios';
          }else{
            print'Lista de Personas';
          }
               break;
               case 'new':
               print'Agregar Nueva Persona';
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
               print'PPLS registrados en el sistema';
               break;
               case 'new':
               print'Registrar nuevo PPL en el sistema';
               break;

             default:
               // code...
               break;
           } ?></h3>

             </div>


            <!-- /.box-header -->
            <div class="box-body">

            <?php if ($arg=='list') {

            require 'modules/tablaPPL.php';


            }elseif ($arg=='new') {
              require 'modules/nuevoPPL.php';
            }  ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
<!-- Modal Editar PPL -->
<div id="modalEditarPPL" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" action="ppls/list" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <i class="fa fa-users"></i>  <h4 class="modal-title">Editar PPL</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <input type="hidden" name="idPPL" id="idPPL" value="">

             <div class="form-group col-xs-6">
              <label>Nombre</label>
              <div class="input-group">
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" placeholder="Nombre" required>
              </div>
            </div>

            <div class="form-group col-xs-6">
              <label>Apellido Paterno</label>
              <div class="input-group">
                <input type="text" class="form-control input-lg" name="editarApaterno" id="editarApaterno" value="" placeholder="Apellido Paterno" required>
              </div>
            </div>

            <div class="form-group col-xs-6">
               <label>Apellido Materno</label>
               <div class="input-group">
                <input type="text" class="form-control input-lg" id="editarAmaterno" name="editarAmaterno" value="" placeholder="Apellido Materno" required>
              </div>
            </div>
            <div class="form-group col-xs-6">
              <label>Fecha Nacimieto:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control  input-lg fNacimiento"  name="editarfNacimiento" id="datepickerNacimiento">
                </div>
            </div>
             <div class="form-group col-xs-6">
               <label>Género</label>
               <div class="input-group">
               <select class="form-control input-lg" id="sexo" name="editarSexo" required="required" >
                  <option value="" id="editarSexo"></option>
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
            </div>
             <div class="form-group col-xs-6">
           <div class="form-group">
             <label>Edad</label>
               <div class="input-group">
                 <input type="text" class="form-control input-lg" name="editarEdad" id="edad" required="required" placeholder="">
               </div>
            </div>
          </div>
          <div class="form-group col-xs-6">
            <label>Fecha de Ingreso:</label>
              <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control  input-lg fIngreso"  name="editarfIngreso" id="datepicker">
              </div>
          </div>


        <div class="form-group col-xs-12 ">
          <label>SUBIR FOTO</label>
          <input type="file" class="nuevaFoto" name="nuevaFoto">
          <p class="help-block">Peso máximo de la foto 2MB</p>
          <img src="views/images/default/anonymous.png" id="fotoActual" class="img-thumbnail previsualizar" width="100px">
        </div>


          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
    </div>
</div>
<!-- Modal Proceso -->
<div id="modalEditarProceso" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" action="ppls/list" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <i class="fa fa-legal"></i>  <h4 class="modal-title">Editar Proceso   PPL</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <input type="hidden" name="idPPLp" id="idPPLp" value="">

             <div class="form-group col-xs-6">
              <label>Numero de Proceso</label>
              <div class="input-group">
                <input type="text" class="form-control input-lg" id="editarProceso" name="editarProceso" value="" placeholder="No Proceso" required>
              </div>
            </div>
            <div class="form-group col-xs-6">
              <label>Fuero</label>
              <div class="input-group">
              <select class="form-control input-lg" id="fuero" name="editarFuero" required="required" >
                 <option value="" id="editarFuero"></option>

                 <option value="C">
                  COMUN
                 </option>
                 <option value="F">
                  FEDERAL
                 </option>
              </select>
            </div>
           </div>
           <div class="form-group col-xs-6">
             <label>Situación</label>
             <div class="input-group">
             <select class="form-control input-lg" id="situacion" name="editarSituacion" required="required" >
                <option value="" id="editarSituacion"></option>
                <option value="">
                 Selecione Género
                </option>
                <option value="P">
                 PROCESADO
                </option>
                <option value="S">
                 SENTENCIADO
                </option>
             </select>
           </div>
          </div>


            <div class="form-group col-xs-6">
               <label>Delito</label>
               <div class="input-group">
                <input type="text" class="form-control input-lg" id="editarDelito" name="editarDelito" value="" placeholder="Delito" required>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<script src="views/js/ppls.js"></script>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['idPPL'])&&$_POST['idPPL']!=""){
    $editar= new PPLController();
    $editar->ctrEditarPPL();
  }
  if(isset($_POST['idPPLp'])&&$_POST['idPPLp']!=""){
  
    $editar= new PPLController();
    $editar->ctrEditarProceso();
  }
} ?>
