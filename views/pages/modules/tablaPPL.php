
<table id="example2" class="table table-striped table-bordered tablas">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>

                  <th>Sexo</th>
                  <th>Fecha Nacimiento</th>
                  <th>Edad</th>
                  <th>Fecha Ingreso</th>
                  <th>Status</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $i=0;
                  foreach ($ppls as $key => $value) {
                    print'<tr>
                  <td>'.($i+1).'</td>

                <td> '.$value['aPaterno_ppl'].' '.$value['aMaterno_ppl'].' '.$value['nombre_ppl'].' </td>
                  <td>'.$value['sexo_ppl'].'</td>';
                  print '<td>'.$value['fNacimiento_ppl'].'</td>
                  <td>'.$value['edad_ppl'].'</td>';
              /*    if($value["foto_ppl"] != ""){

                    echo '<td><img src="'.$value["foto_ppl"].'" class="img-thumbnail" width="40px"></td>';

                  }else{

                    echo '<td><img src="views/images/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                  }*/
                  print '<td>'.$value['fIngreso_ppl'].'</td>';
                  if($value["status_ppl"] != '0'){
                    print '<td><button class="btn btn-success btn-xs btnActivar" title="Cambiar estado" idPPL="'.$value["rowid_ppl"].'" estadoUsuario="0">Activado</button></td>';
                  }else{
                    print '<td><button class="btn btn-danger btn-xs btnActivar" title="Cambiar estado" idPPL="'.$value["rowid_ppl"].'" estadoUsuario="1">Desactivado</button></td>';
                  }
                  print'<td>
                    <div class="btn-group">
                      <button class="btn btn-danger btnEditarPPL" idPPL="'.$value["rowid_ppl"].'" data-toggle="modal" data-target="#modalEditarPPL" title="Editar PPL"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-info btnEditarProceso" idPPLp="'.$value["rowid_ppl"].'" data-toggle="modal" data-target="#modalEditarProceso  "  title="Editar Proceso"><i class="fa fa-legal"></i></button>
                    </div>
                  </td>';
                print'</tr>';
               $i++;    } ?>
             </table>
