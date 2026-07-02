  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Identificacion de Apoyos</h1>
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
    <section class="content" id="vista-identificacion">
      <div class="container-fluid">
        <!-- Título -->
        <div class="row mb-5 justify-content-center mt-4">
          <div class="col-auto">
             <!-- Este border especifico se queda igual debido a que son clases nativas de bootstrap, pero el letter spacing irá a css -->
            
          </div>
        </div>

        <!-- Tarjetas de Apoyos Dinámicas -->
        <div class="row justify-content-center px-4" id="accordionApoyos">

          <?php
            $item = null;
            $valor = null;
            $apoyos = ControladorApoyos::ctrMostrarApoyosActivos($item, $valor);

            foreach ($apoyos as $key => $value) {
              
              // Buscar si existe una convocatoria activa (ABIERTA) para este apoyo
              $convocatoria = ControladorConvocatorias::ctrMostrarConvocatoria("apoyo_id", $value["id_apoyo"]);
              
              $disponible = false;
              if ($convocatoria && $convocatoria["estado_en_convocatoria"] == "ABIERTA") {
                $disponible = true;
              }

              // Estilo o estado del texto
              $estadoTexto = $disponible ? "Apoyo Disponible" : "Apoyo No Disponible";
              $descripcionMayus = mb_strtoupper($value["descripcion_apoyo"], 'UTF-8');
              
              echo '
               <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <!-- small box -->
                <div class="small-box apoyo-radial-card h-100">
                  <div class="inner">
                    <h4>'.$descripcionMayus.'</h4>
                    <p>'.$estadoTexto.'</p>
                  </div>
                  <div class="icon">
                    <i class="'.$value["apoyo_icono"].'"></i>
                  </div>
                  <div class="small-box-footer p-2 d-flex justify-content-center flex-wrap">
                    <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn" data-toggle="modal" data-target="#modalInfo'.$value["id_apoyo"].'">Info. Apoyo</button>
                    <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn" data-toggle="modal" data-target="#modalDetalle'.$value["id_apoyo"].'">Detalles</button>';
                    
                    if ($disponible) {
                      echo '<button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn btnAceptarApoyo" idApoyo="'.$value["id_apoyo"].'" nombreApoyo="'.htmlspecialchars($value["descripcion_apoyo"], ENT_QUOTES, 'UTF-8').'">Inscribirse</button>';
                    }

              echo '
                  </div>
                </div>
              </div>';
            }
          ?>

        </div>
        
      </div>


      <!--=====================================
      MODALES DINÁMICOS DE INFORMACIÓN DE APOYOS
      ======================================-->
      <?php
        foreach ($apoyos as $key => $value) {
          $convocatoria = ControladorConvocatorias::ctrMostrarConvocatoria("apoyo_id", $value["id_apoyo"]);
          
          $disponible = false;
          $fechaInicio = "";
          $fechaFin = "";
          $cupos = 0;

          if ($convocatoria && $convocatoria["estado_en_convocatoria"] == "ABIERTA") {
            $disponible = true;
            // Formatear fechas a DD/MM/YYYY en español
            $fechaInicio = date("d/m/Y", strtotime($convocatoria["fecha_inicio"]));
            $fechaFin = date("d/m/Y", strtotime($convocatoria["fecha_fin"]));
            $cupos = $convocatoria["cupos_personas"];
          }

          echo '
          <!-- Modal Info '.$value["descripcion_apoyo"].' -->
          <div class="modal fade" id="modalInfo'.$value["id_apoyo"].'">
            <div class="modal-dialog">
              <div class="modal-content apoyo-modal-secundario">
                <div class="modal-header">
                  <h4 class="modal-title">
                    <i class="'.$value["apoyo_icono"].'"></i> '.$value["descripcion_apoyo"].'
                  </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">';
                
                if ($disponible) {
                  echo '
                  <p>Se informa a los aprendices que está disponible el apoyo de '.$value["descripcion_apoyo"].'.</p>
                  <p class="font-weight-bold">APOYO DISPONIBLE DESDE EL '.$fechaInicio.' HASTA EL '.$fechaFin.'</p>
                  <p class="mb-0">CUPOS DISPONIBLES: '.$cupos.'</p>';
                } else {
                  echo '
                  <p>Actualmente no se encuentra ninguna convocatoria activa para el apoyo de '.$value["descripcion_apoyo"].'.</p>
                  <p class="mb-0">Próximamente se abrirán nuevas convocatorias.</p>';
                }

          echo '
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>';
        }
      ?>

      <!--=====================================
      MODALES DINÁMICOS DE DETALLES DE APOYOS
      ======================================-->
      <?php
        foreach ($apoyos as $key => $value) {
          echo '
          <!-- Modal Detalle '.$value["descripcion_apoyo"].' -->
          <div class="modal fade" id="modalDetalle'.$value["id_apoyo"].'">
            <div class="modal-dialog modal-lg">
              <div class="modal-content apoyo-modal-secundario">
                <div class="modal-header">
                  <h4 class="modal-title">
                    <i class="'.$value["apoyo_icono"].'"></i> '.$value["descripcion_apoyo"].' - Detalles
                  </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p style="text-align: justify; white-space: pre-line;">'.nl2br(htmlspecialchars($value["informacion_apoyo"], ENT_QUOTES, 'UTF-8')).'</p>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>';
        }
      ?>

    </section>
    <!-- /.content -->
  
  <!-- </div> -->
  <!-- /.content-wrapper -->