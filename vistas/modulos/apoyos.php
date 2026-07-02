<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar Apoyos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Apoyos</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="card bg-dark text-white">
      <div class="card-header border-0 d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold mb-0" style="font-size: 1.5rem; line-height: 2;">APOYOS</h3>
        <div class="card-tools ml-auto">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarApoyo">
                Agregar Apoyo
            </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="tblApoyos" class="table tablaApoyos table-dark table-bordered table-striped dt-responsive nowrap" style="width:100%">
          <thead style="background-color: #198754; color: white;">
          <tr>
            <th style="width:10px">#</th>
            <th>Descripción del apoyo</th>
            <th>¿Dual?</th>
            <th>Estado</th>
            <th>Información</th>
            <th>Icono</th>
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>
            <?php
              $item = null;
              $valor = null;
              $apoyos = ControladorApoyos::ctrMostrarApoyos($item, $valor);

              foreach ($apoyos as $key => $value) {
                echo '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["descripcion_apoyo"].'</td>';

                if($value["apoyo_dual"] == 1){
                  echo '<td><button class="btn btn-success btn-xs btnActivarDual" idApoyo="'.$value["id_apoyo"].'" estadoDual="0">Sí</button></td>';
                }else{
                  echo '<td><button class="btn btn-danger btn-xs btnActivarDual" idApoyo="'.$value["id_apoyo"].'" estadoDual="1">No</button></td>';
                }

                if($value["estado_apoyo"] == 1){
                  echo '<td><button class="btn btn-success btn-xs btnActivarApoyo" idApoyo="'.$value["id_apoyo"].'" estadoApoyo="0">Activo</button></td>';
                }else{
                  echo '<td><button class="btn btn-danger btn-xs btnActivarApoyo" idApoyo="'.$value["id_apoyo"].'" estadoApoyo="1">Inhabilitado</button></td>';
                }

                $info = $value["informacion_apoyo"];
                if(strlen($info) > 60){
                  $infoRecortada = substr($info, 0, 60);
                  $infoFull = htmlspecialchars($info, ENT_QUOTES, 'UTF-8');
                  echo '<td>'.$infoRecortada.'... <a href="#" class="btnVerMas text-info" data-toggle="modal" data-target="#modalVerMas" data-info="'.$infoFull.'"><strong>ver más</strong></a></td>';
                }else{
                  echo '<td>'.$info.'</td>';
                }

                // HAY QUE HABILITAR EL PROCESO DE QUE SI EL APOYO NO HA TENIDO CONVOCATORIAS ASOCIADAS SE PUEDA ELIMINAR, DE LO CONTRARIO NO SE PUEDE ELIMINAR
                echo '<td><i class="'.$value["apoyo_icono"].' fa-lg"></i></td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-sm btn-outline-info btnEditarApoyo" idApoyo="'.$value["id_apoyo"].'" data-toggle="modal" data-target="#modalEditarApoyo"><i class="fas fa-edit"></i></button>
                          </div>
                        </td>
                      </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->    

  </section>
  <!-- /.content -->

<!-- </div> -->
<!-- /.content-wrapper -->


<!--=====================================
MODAL AGREGAR APOYO
======================================-->
<div id="modalAgregarApoyo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header">
          <h4 class="modal-title">Agregar apoyo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- CUERPO DEL MODAL -->
        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-hand-holding-heart"></i></span>
                </div>
                <input type="text" class="form-control input-lg" name="nuevaDescripcionApoyo" placeholder="Ingresar nombre del apoyo" required>
              </div>
            </div>

            <!-- ENTRADA PARA APOYO DUAL -->
            <div class="form-group">
                <label>¿Permite apoyo dual?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="nuevoApoyoDual" id="nuevoApoyoDualSi" value="1">
                    <label class="form-check-label" for="nuevoApoyoDualSi">Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="nuevoApoyoDual" id="nuevoApoyoDualNo" value="0" checked>
                    <label class="form-check-label" for="nuevoApoyoDualNo">No</label>
                </div>
            </div>

            <!-- ENTRADA PARA LA INFORMACIÓN -->
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                </div>
                <textarea class="form-control input-lg" name="nuevaInformacionApoyo" rows="3" placeholder="Ingresar información detallada" required></textarea>
              </div>
            </div>

            <!-- ENTRADA PARA EL ICONO -->
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="previewNuevoIcono"><i class="fas fa-icons"></i></span>
                </div>
                <input type="text" class="form-control input-lg" id="nombreNuevoIcono" placeholder="Seleccione un icono" readonly required>
                <input type="hidden" name="nuevoApoyoIcono" id="nuevoApoyoIcono" required>
                <div class="input-group-append">
                    <button class="btn btn-primary btnAbrirModalIconos" data-target-preview="previewNuevoIcono" data-target-name="nombreNuevoIcono" data-target-hidden="nuevoApoyoIcono" type="button" data-toggle="modal" data-target="#modalIconos">Buscar</button>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar apoyo</button>
        </div>

        <?php
          if(class_exists('ControladorApoyos')){
              $crearApoyo = new ControladorApoyos();
              $crearApoyo->ctrCrearApoyo();
          }
        ?>

      </form>

    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR APOYO
======================================-->
<div id="modalEditarApoyo" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header">
          <h4 class="modal-title">Editar apoyo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <!-- CUERPO DEL MODAL -->
        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-hand-holding-heart"></i></span>
                </div>
                <input type="text" class="form-control input-lg" name="editarDescripcionApoyo" id="editarDescripcionApoyo" value="" required>
                <input type="hidden" id="idApoyo" name="idApoyo">
              </div>
            </div>

            <!-- ENTRADA PARA APOYO DUAL -->
            <div class="form-group">
                <label>¿Permite apoyo dual?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="editarApoyoDual" id="editarApoyoDualSi" value="1">
                    <label class="form-check-label" for="editarApoyoDualSi">Sí</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="editarApoyoDual" id="editarApoyoDualNo" value="0">
                    <label class="form-check-label" for="editarApoyoDualNo">No</label>
                </div>
            </div>

            <!-- ENTRADA PARA HABILITAR O INHABILITAR APOYO -->
            <div class="form-group">
                <label>Estado del apoyo</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="editarEstadoApoyo" id="editarEstadoActivo" value="1">
                    <label class="form-check-label" for="editarEstadoActivo">Activo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="editarEstadoApoyo" id="editarEstadoInhabilitado" value="0">
                    <label class="form-check-label" for="editarEstadoInhabilitado">Inhabilitado</label>
                </div>
            </div>

            <!-- ENTRADA PARA LA INFORMACIÓN -->
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                </div>
                <textarea class="form-control input-lg" name="editarInformacionApoyo" id="editarInformacionApoyo" rows="3" required></textarea>
              </div>
            </div>

            <!-- ENTRADA PARA EL ICONO -->
            <div class="form-group">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="previewEditarIcono"><i class="fas fa-icons"></i></span>
                </div>
                <input type="text" class="form-control input-lg" id="nombreEditarIcono" placeholder="Seleccione un icono" readonly required>
                <input type="hidden" name="editarApoyoIcono" id="editarApoyoIcono" required>
                <div class="input-group-append">
                    <button class="btn btn-primary btnAbrirModalIconos" data-target-preview="previewEditarIcono" data-target-name="nombreEditarIcono" data-target-hidden="editarApoyoIcono" type="button" data-toggle="modal" data-target="#modalIconos">Buscar</button>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

        <?php
          if(class_exists('ControladorApoyos')){
              $editarApoyo = new ControladorApoyos();
              $editarApoyo->ctrEditarApoyo();
          }
        ?> 

      </form>

    </div>
  </div>
</div>

<!--=====================================
MODAL VER MÁS INFO
======================================-->
<div id="modalVerMas" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- CABEZA DEL MODAL -->
      <div class="modal-header">
        <h4 class="modal-title">Información del apoyo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- CUERPO DEL MODAL -->
      <div class="modal-body">
        <p id="textoInfoCompleta" style="text-align: justify; white-space: pre-wrap;"></p>
      </div>

      <!-- PIE DEL MODAL -->
      <div class="modal-footer justify-content-end">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!--=====================================
MODAL ICONOS
======================================-->
<div id="modalIconos" class="modal fade" role="dialog" style="z-index: 1060;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- CABEZA DEL MODAL -->
      <div class="modal-header">
        <h4 class="modal-title">Seleccionar Icono</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- CUERPO DEL MODAL -->
      <div class="modal-body">
        <div class="form-group">
            <input type="text" class="form-control" id="buscadorIconos" placeholder="Buscar icono por nombre...">
        </div>
        <div class="row" id="contenedorIconos" style="max-height: 400px; overflow-y: auto;">
            <!-- Iconos cargados por AJAX -->
        </div>
      </div>

      <!-- PIE DEL MODAL -->
      <div class="modal-footer justify-content-end">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<?php
  if(class_exists('ControladorApoyos')){
      $borrarApoyo = new ControladorApoyos();
      $borrarApoyo->ctrBorrarApoyo();
  }
?>