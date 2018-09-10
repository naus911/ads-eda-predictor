
<table id="example2" class="table table-bordered table-hover tablas">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Departamento</th>
                  <th>Foto</th>
                  <th>Usuario</th>
                  <th>Tipo Usuario</th>
                  <th>Ultimo login</th>
                  <th>Status</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $i=0; 
                  foreach ($usuarios as $key => $value) {
                    print'<tr>
                  <td>'.($i+1).'</td>
                  <td>'.$value['nombre_user'].' '.$value['aPaterno_user'].' '.$value['aMaterno_user'].' </td>
                  
                  <td>'.$value['departamento'].'</td>';
                  if($value["foto_user"] != ""){

                    echo '<td><img src="'.$value["foto_user"].'" class="img-thumbnail pic" width="40px" href="'.$value["foto_user"].'"></td>';

                  }else{

                    echo '<td><img src="views/images/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                  }
                  print '<td>'.$value['usuario'].'</td>
                  <td>'.$value['tipoUsuario'].'</td>
                  <td>'.$value['ultimo_login'].'</td>';
                  if($value["status_user"] != 0){

                    print '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["rowid_users"].'" estadoUsuario="0">Activado</button></td>';

                  }else{

                    print '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["rowid_users"].'" estadoUsuario="1">Desactivado</button></td>';

                  }
                  print'<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["rowid_users"].'" data-toggle="modal" data-target="#modalEditarUsuario" title="Editar Usuario"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["rowid_users"].'" fotoUsuario="'.$value["foto_user"].'" usuario="'.$value["usuario"].'" title="Eliminar Usuario"><i class="fa fa-times"></i></button>
                      

                    </div>  

                  </td>';
                print'</tr>';
                     
               $i++;    } ?>
                
              </table>
            