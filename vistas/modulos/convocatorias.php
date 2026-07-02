  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>Convocatorias</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                      <li class="breadcrumb-item active">Convocatorias</li>
                  </ol>
              </div>
          </div>
      </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          
          <!-- TABLA PRINCIPAL DE CONVOCATORIAS -->
          <div class="card bg-dark text-white mb-4">
              <div class="card-header border-0 d-flex justify-content-between align-items-center">
                  <h3 class="card-title font-weight-bold mb-0" style="font-size: 1.5rem; line-height: 2;">GESTIÓN DE CONVOCATORIAS</h3>
                  <div class="card-tools ml-auto">
                      <!-- Modificado para limpiar formulario si es nueva -->
                      <button type="button" class="btn btn-success btnNuevaConvocatoria" data-toggle="modal" data-target="#modal-agregarConvocatoria">
                          <i class="fas fa-plus"></i> Nueva Convocatoria
                      </button>
                  </div>
              </div>
              <div class="card-body">
                  <table id="tblConvocatorias" class="table table-dark table-bordered table-striped dt-responsive nowrap" style="width:100%">
                      <thead style="background-color: #198754; color: white;">
                          <tr>
                              <th style="width: 5%">#</th>
                              <th style="width: 25%">Tipo de Apoyo</th>
                              <th style="width: 30%">Fechas (Inicio - Cierre)</th>
                              <th style="width: 10%">Cupos</th>
                              <th style="width: 15%">Estado</th>
                              <th style="width: 15%">Acciones</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                            $convocatorias = ControladorConvocatorias::ctrListarConvocatorias();
                            foreach ($convocatorias as $key => $value) {
                                
                                // Obtener el nombre del apoyo desde la base de datos
                                $itemApoyo = "id_apoyo"; // Asumiendo que la PK es id_apoyo
                                $valorApoyo = $value["apoyo_id"];
                                $respuestaApoyo = ControladorApoyos::ctrMostrarApoyos($itemApoyo, $valorApoyo);
                                $nombreApoyo = $respuestaApoyo ? $respuestaApoyo["descripcion_apoyo"] : "Apoyo Desconocido";

                                echo '<tr>
                                    <td>'.($key+1).'</td>
                                    <td>'.$nombreApoyo.'</td>
                                    <td><i class="far fa-calendar-alt mr-1"></i> '.$value["fecha_inicio"].' / '.$value["fecha_fin"].'</td>
                                    <td>'.$value["cupos_personas"].'</td>';
                                
                                if($value["estado_en_convocatoria"] == "ABIERTA"){
                                    echo '<td><span class="badge badge-primary" style="font-size: 0.9em; padding: 6px;">Abierta</span></td>';
                                } else if($value["estado_en_convocatoria"] == "GUARDADA"){
                                    echo '<td><span class="badge badge-secondary" style="font-size: 0.9em; padding: 6px;">Guardada</span></td>';
                                } else {
                                    echo '<td><span class="badge badge-danger" style="font-size: 0.9em; padding: 6px;">Cerrada</span></td>';
                                }

                                echo '<td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-light btnEditarConvocatoria" idConvocatoria="'.$value["id"].'" data-toggle="modal" data-target="#modal-agregarConvocatoria"><i class="fas fa-edit"></i></button>
                                        </div>
                                      </td>
                                </tr>';
                            }
                          ?>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </section>

  <!-- ========================================================================================================
  MODAL: AGREGAR / EDITAR CONVOCATORIA
  ========================================================================================================= -->

  <div class="modal fade" id="modal-agregarConvocatoria" data-backdrop="static">
      <div class="modal-dialog modal-xl">
          <div class="modal-content bg-dark text-white">
              
              <!-- FORMULARIO ESTÁNDAR PARA CREAR/EDITAR -->
              <form id="formConvocatoria" method="POST">
                  
                  <!-- Estados y PK -->
                  <input type="hidden" name="estado_en_convocatoria" id="estado_en_convocatoria" value="">
                  <input type="hidden" name="id_convocatoria_editar" id="id_convocatoria_editar" value="">

                  <div class="modal-header" style="background-color: #343a40;">
                      <h4 class="modal-title font-weight-bold" id="tituloModalConvocatoria"><i class="fas fa-clipboard-list mr-2"></i> Apertura de Convocatoria</h4>
                      <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  
                  <div class="modal-body" style="background-color: #454d55 !important;">
                      
                      <!-- 1. DATOS GENERALES -->
                      <div class="card bg-dark text-white mb-4">
                          <div class="card-header border-0 pb-0">
                              <h3 class="card-title font-weight-bold text-success" style="font-size: 1.1rem;">1. Datos Generales del Apoyo</h3>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-8 form-group">
                                      <label for="apoyo_id">Tipo de Apoyo <span class="text-danger">*</span></label>
                                      <div class="d-flex align-items-center">
                                          <select id="apoyo_id" name="apoyo_id" class="form-control" required>
                                              <option value="" disabled selected>Seleccione un apoyo...</option>
                                              <?php
                                                $apoyos = ControladorApoyos::ctrMostrarApoyosActivos(null, null);
                                                if($apoyos){
                                                    foreach ($apoyos as $key => $value) {
                                                        $duality = ($value["apoyo_dual"] == 1) ? 'true' : 'false';
                                                        echo '<option value="'.$value["id_apoyo"].'" data-duality="'.$duality.'">'.$value["descripcion_apoyo"].'</option>';
                                                    }
                                                }
                                              ?>
                                          </select>
                                          <span id="badge_duality" class="badge ml-3 d-none" style="font-size: 0.95rem; padding: 8px 12px;"></span>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6 form-group">
                                      <label for="fecha_inicio">Fecha de Inicio <span class="text-danger">*</span></label>
                                      <div class="input-group">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-calendar-plus"></i></span>
                                          </div>
                                          <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                                      </div>
                                  </div>
                                  <div class="col-md-6 form-group">
                                      <label for="fecha_fin">Fecha de Cierre <span class="text-danger">*</span></label>
                                      <div class="input-group">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                          </div>
                                          <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6 form-group">
                                      <label for="cupos_personas">Cupos Disponibles <span class="text-danger">*</span></label>
                                      <div class="input-group">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-users"></i></span>
                                          </div>
                                          <input type="number" name="cupos_personas" id="cupos_personas" class="form-control" min="1" placeholder="Ej: 50" required>
                                      </div>
                                  </div>
                                  <div class="col-md-6 form-group">
                                      <label for="duracion_meses">Duración (Meses) <span class="text-danger">*</span></label>
                                      <div class="input-group">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                          </div>
                                          <input type="number" name="duracion_meses" id="duracion_meses" class="form-control" value="6" min="1" required>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- 2. BAREMO -->
                      <div class="card bg-dark text-white mb-1">
                          <div class="card-header border-0 d-flex justify-content-between align-items-center pb-0">
                              <h3 class="card-title font-weight-bold text-success" style="font-size: 1.1rem;">2. Baremo de Evaluación y Requisitos</h3>
                              <div class="card-tools ml-auto">
                                  <button type="button" id="btnAgregarCriterio" class="btn btn-success btn-sm"><i class="fas fa-plus mr-1"></i> Agregar Criterio</button>
                              </div>
                          </div>
                          <div class="card-body">
                              <div id="baremoContainer" class="mb-3">
                                  <!-- Las filas se inyectarán aquí vía AJAX/jQuery -->
                              </div>
                              <div id="baremoEmptyState" class="text-center py-4 text-muted" style="border: 2px dashed #6c757d; border-radius: 5px;">
                                  <i class="fas fa-folder-open fa-2x mb-2 text-secondary"></i>
                                  <h6>No hay requisitos configurados</h6>
                                  <small>Presiona el botón "Agregar Criterio" para comenzar.</small>
                              </div>
                          </div>
                      </div>

                  </div>
                  
                  <!-- BOTONES ACCION -->
                  <div class="modal-footer justify-content-between" style="background-color: #343a40;">
                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                      <div>
                          <button type="button" id="btnBorrador" class="btn btn-secondary mr-2"><i class="fas fa-save mr-1"></i> Guardar Borrador</button>
                          <button type="button" id="btnPublicar" class="btn btn-primary"><i class="fas fa-rocket mr-1"></i> Publicar Convocatoria</button>
                      </div>
                  </div>

                  <!-- Ejecución del controlador PHP -->
                  <?php
                    $crearConvocatoria = new ControladorConvocatorias();
                    $crearConvocatoria->ctrCrearConvocatoria();
                  ?>
                  
              </form>
          </div>
      </div>
  </div>

  <!-- ========================================================================================================
  TEMPLATE BAREMO (Oculto en DOM, clonado por jQuery)
  ========================================================================================================= -->
  <template id="baremoRowTemplate">
      <div class="baremo-row row align-items-center bg-secondary p-2 mb-2 rounded" style="border: 1px solid #6c757d;">
          
          <div class="col-md-5 mb-2 mb-md-0">
              <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-dark text-white border-0"><i class="fas fa-file-alt"></i></span>
                  </div>
                  <input type="text" name="baremo[nombre_item][]" class="form-control nombre-item-input" placeholder="Nombre del documento / requisito" required>
              </div>
          </div>

          <div class="col-md-3 mb-2 mb-md-0">
              <div class="input-group input-group-sm">
                  <input type="number" step="0.01" name="baremo[puntaje_valor][]" class="form-control text-right puntaje-valor-input" value="10.00" required>
                  <div class="input-group-append">
                      <span class="input-group-text bg-dark text-white border-0">pts</span>
                  </div>
              </div>
          </div>

          <div class="col-md-3 mb-2 mb-md-0 d-flex align-items-center pl-md-4">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                  <input type="hidden" name="baremo[es_critico][]" value="0" class="hidden-critico-input">
                  <input type="checkbox" class="custom-control-input toggle-critico" id="switch_templ">
                  <label class="custom-control-label font-weight-normal text-light" for="switch_templ">¿Es crítico?</label>
              </div>
          </div>

          <div class="col-md-1 text-right">
              <button type="button" class="btn btn-danger btn-sm btn-eliminar-fila" title="Eliminar este criterio"><i class="fas fa-trash"></i></button>
          </div>
          
      </div>
  </template>
