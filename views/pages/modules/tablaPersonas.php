
<table id="example2" class="table table-bordered table-hover tablas">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Edad</th>
                  <th>Sexo</th>
                  <th>Fecha Nacimiento</th>
                  <th>Foto</th>
                  <th>Status</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $i=0;
                  foreach ($personas as $key => $value) {
                    print'<tr>
                  <td>'.($i+1).'</td>
                  <td>'.$value['nombre_persona'].' '.$value['aPaterno_persona'].' '.$value['aMaterno_persona'].' </td>

                  <td>'.$value['edad_persona'].'</td>
                    <td>'.$value['sexo_persona'].'</td>
                    <td>'.$value['fNacimiento_persona'].'</td>';
                  if($value["foto_persona"] != ""){
                    echo '<td><img src="'.$value["foto_persona"].'" class="img-thumbnail" width="40px"></td>';
                  }else{
                    echo '<td><img src="views/images/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                  }
                  if($value["status_persona"] != '0'){
                    print '<td><button class="btn btn-success btn-xs btnActivar" title="Cambiar estado" idPersona="'.$value["rowid_persona"].'" estadoUsuario="0">Activado</button></td>';
                  }else{
                    print '<td><button class="btn btn-danger btn-xs btnActivar" title="Cambiar estado" idPersona="'.$value["rowid_persona"].'" estadoUsuario="1">Desactivado</button></td>';
                  }
                  print'<td>
                    <div class="btn-group">
                    <button class="btn btn-warning btnEditarPersona" idUsuario="'.$value["rowid_persona"].'"  title="Editar Persona"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-success btnAsignarPPL" idUsuario="'.$value["rowid_persona"].'"  title="Asignar PPL"><i class="fa  fa-user-plus"></i></button>

                    </div>
                  </td>';
                print'</tr>';

               $i++;    } ?>

              </table>
