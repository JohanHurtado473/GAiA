  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>Fichas</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                      <li class="breadcrumb-item active">Fichas</li>
                  </ol>
              </div>
          </div>
      </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          <div class="card bg-dark text-white">
              <div class="card-header border-0 d-flex justify-content-between align-items-center">
                  <h3 class="card-title font-weight-bold mb-0" style="font-size: 1.5rem; line-height: 2;">FICHAS</h3>
                  <div class="card-tools ml-auto">
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-agregarFicha">Agregar Ficha</button>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="tblFichas" class="table table-dark table-bordered table-striped dt-responsive nowrap" style="width:100%">
                      <thead style="background-color: #198754; color: white;">
                          <tr>
                              <th style="width: 10px;">ID</th>
                              <th>Código de la Ficha</th>
                              <th>Sede</th>
                              <th>Acciones</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                            $respuesta = ControladorFichas::ctrListarFichas();
                            foreach ($respuesta as $key => $ficha) {
                                echo "<tr>";
                                echo "<td>" . ($key + 1) . "</td>";
                                echo "<td>" . $ficha['codigo'] . "</td>";
                                echo "<td>" . $ficha['descripcion_sede'] . "</td>";
                                echo "<td>";
                                echo '<div class="btn-group">
                            <button class="btn btn-sm btn-outline-light btnEditarFicha" idFicha="'.$ficha["id_ficha"].'" data-toggle="modal" data-target="#modal-editarFicha"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-outline-light btnEliminarFicha" idFicha="'.$ficha["id_ficha"].'"><i class="fas fa-trash"></i></button>
                          </div>
                        </td>';
                                echo "</tr>";
                            };
                            ?>
                      </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </div>
  </section>
  <!-- /.content -->

  <!-- ********************************************************************************************************
  AGREGAR FICHA   -->

  <div class="modal fade" id="modal-agregarFicha">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Agregar Ficha</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="" method="post">

                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                          </div>
                          <input type="text" class="form-control" name="nuevoCodigoFicha" id="nuevoCodigoFicha" placeholder="Ingresar código de la ficha" required>
                      </div>

                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-building"></i></span>
                          </div>
                          <select class="form-control" name="nuevaSedeFicha" required>
                              <option value="">Seleccionar sede</option>
                              <?php
                              $sedes = ControladorSedes::ctrListarSedes();
                              foreach ($sedes as $key => $value) {
                                  echo '<option value="'.$value["id_sede"].'">'.$value["descripcion_sede"].'</option>';
                              }
                              ?>
                          </select>
                      </div>

              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
              <?php
                $agregarFicha = new ControladorFichas();
                $agregarFicha->ctrAgregarFicha();
                ?>
              </form>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- ********************************************************************************************************
  EDITAR FICHA   -->

  <div class="modal fade" id="modal-editarFicha">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Editar Ficha</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p>Funcionalidad de edición pendiente</p>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary">Guardar</button>
              </div>
          </div>
      </div>
  </div>