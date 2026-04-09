  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inscripciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Inscripciones</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Botones superiores -->
      <div class="row mb-4">
        <div class="col-md-6 mb-2">
          <button class="btn btn-primary btn-block" style="border-radius: 5px; font-weight: 500;">Inscripción a apoyos</button>
        </div>
        <div class="col-md-6 mb-2">
          <button class="btn btn-primary btn-block" style="border-radius: 5px; font-weight: 500;">Preguntas Frecuentes</button>
        </div>
      </div>

      <!-- Tarjeta principal -->
      <div class="card">
        <div class="card-body">

          <!-- VISTA USUARIO -->
          <div id="vistaUsuario">

          <?php 
          $categorias = [
            "SOSTENIMIENTO REGULAR",
            "ALIMENTACION TEMPORAL",
            "MEDIOS TECNOLOGICOS Y DATOS",
            "TRANSPORTE"
          ];

          foreach ($categorias as $categoria) : ?>
          <div class="mb-4">
            <h5 class="mb-2" style="font-weight: 600; font-size: 1.1rem;">
              <?php echo $categoria; ?> <span class="text-muted" style="font-size: 0.85rem; margin-left: 5px;">| 20/100</span>
            </h5>
            <div class="table-responsive">
              <table class="table table-sm table-bordered text-center m-0" style="min-width: 900px;">
                <thead>
                  <tr style="background-color: #0b8043; color: white;">
                    <th style="font-size: 0.75rem; vertical-align: middle; width: 10%;">AUTORIZACION<br>DE MENOR</th>
                    <th style="font-size: 0.75rem; vertical-align: middle; width: 10%;">DISCAPACIDAD</th>
                    <th style="font-size: 0.75rem; vertical-align: middle; width: 10%;">COMUNIDAD<br>ETNICA</th>
                    <th style="font-size: 0.75rem; vertical-align: middle; width: 10%;">CAMPESINO</th>
                    <th style="font-size: 0.75rem; vertical-align: middle; width: 10%;">CABEZA<br>DE FAMILIA</th>
                    <th style="font-size: 0.75rem; vertical-align: middle; width: 10%;">VICTIMA<br>DE CONFLICTO</th>
                    <th style="font-size: 0.75rem; vertical-align: middle; width: 10%;">VIOLENCIA<br>DE GENERO</th>
                    <th style="font-size: 0.75rem; vertical-align: middle; width: 10%;">EMBARAZADA<br>/LACTANCIA</th>
                    <th style="font-size: 0.75rem; vertical-align: middle; width: 10%;">SISBEN<br>A/B</th>
                    <th style="font-size: 0.75rem; vertical-align: middle; width: 10%;">DESPLAZADO<br>NATURAL</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="bg-danger py-1" style="font-size: 0.8rem;">Rechazado</td>
                    <td class="bg-danger py-1" style="font-size: 0.8rem;">Rechazado</td>
                    <td class="bg-warning py-1 text-dark" style="font-size: 0.8rem; font-weight: 500;">Pendiente</td>
                    <td class="bg-danger py-1" style="font-size: 0.8rem;">Rechazado</td>
                    <td class="bg-danger py-1" style="font-size: 0.8rem;">Rechazado</td>
                    <td class="bg-secondary py-1" style="font-size: 0.8rem;">No Presentado</td>
                    <td class="bg-danger py-1" style="font-size: 0.8rem;">Rechazado</td>
                    <td class="bg-success py-1" style="font-size: 0.8rem;">Aprobado</td>
                    <td class="bg-danger py-1" style="font-size: 0.8rem;">Rechazado</td>
                    <td class="bg-success py-1" style="font-size: 0.8rem;">Aprobado</td>
                  </tr>
                  <tr>
                    <td class="py-2"><i class="fas fa-upload fa-lg" style="cursor: pointer;"></i></td>
                    <td class="py-2"><i class="fas fa-upload fa-lg" style="cursor: pointer;"></i></td>
                    <td class="py-2"><i class="fas fa-ban fa-lg text-muted"></i></td>
                    <td class="py-2"><i class="fas fa-upload fa-lg" style="cursor: pointer;"></i></td>
                    <td class="py-2"><i class="fas fa-upload fa-lg" style="cursor: pointer;"></i></td>
                    <td class="py-2"><i class="fas fa-ban fa-lg text-muted"></i></td>
                    <td class="py-2"><i class="fas fa-upload fa-lg" style="cursor: pointer;"></i></td>
                    <td class="py-2"><i class="fas fa-ban fa-lg text-muted"></i></td>
                    <td class="py-2"><i class="fas fa-upload fa-lg" style="cursor: pointer;"></i></td>
                    <td class="py-2"><i class="fas fa-ban fa-lg text-muted"></i></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <?php endforeach; ?>
          </div>
          <!-- /VISTA USUARIO -->

          <!-- VISTA ADMINISTRADOR -->
          <div id="vistaAdmin" style="display: none;">
            <div class="row align-items-center mb-4">
              <div class="col-md-8 d-flex flex-wrap" style="gap: 10px;">
                <button class="btn d-flex align-items-center" style="background-color: #0b8043; color: white; border-radius: 8px; padding: 8px 15px;">
                  <i class="fas fa-wallet fa-lg mr-2"></i>
                  <div class="text-left text-sm" style="line-height: 1.1;">Apoyo de<br>sostenimiento</div>
                </button>
                <button class="btn d-flex align-items-center" style="background-color: #0b8043; color: white; border-radius: 8px; padding: 8px 15px;">
                  <i class="fas fa-phone-alt fa-lg mr-2"></i>
                  <div class="text-left text-sm" style="line-height: 1.1;">apoyo<br>de datos</div>
                </button>
                <button class="btn d-flex align-items-center" style="background-color: #0b8043; color: white; border-radius: 8px; padding: 8px 15px;">
                  <i class="fas fa-utensils fa-lg mr-2"></i>
                  <div class="text-left text-sm" style="line-height: 1.1;">apoyo de<br>alimentación</div>
                </button>
                <button class="btn d-flex align-items-center" style="background-color: #0b8043; color: white; border-radius: 8px; padding: 8px 15px;">
                  <i class="fas fa-car fa-lg mr-2"></i>
                  <div class="text-left text-sm" style="line-height: 1.1;">apoyo de<br>transporte</div>
                </button>
              </div>
              <div class="col-md-4">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="border: 1px solid #28a745; border-right: none; border-radius: 8px 0 0 8px; background-color: transparent;"><i class="far fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Buscar aprendiz" style="border: 1px solid #28a745; border-left: none; border-radius: 0 8px 8px 0; background-color: transparent;">
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-bordered text-center mb-4 text-nowrap">
                <thead>
                  <tr style="background-color: #0b8043; color: white;">
                    <th style="font-weight: 500;">Identificacion</th>
                    <th style="font-weight: 500;">Nombre</th>
                    <th style="font-weight: 500;">Correo</th>
                    <th style="font-weight: 500;">Ficha</th>
                    <th style="font-weight: 500; width: 15%;">Estado</th>
                    <th style="font-weight: 500;">Fecha De Inscripcion</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $estadosAdmin = ['Inscrito', 'En Proceso', 'Inscrito', 'En Proceso', 'Inscrito', 'Inscrito', 'En Proceso', 'En Proceso', 'Inscrito'];
                  foreach ($estadosAdmin as $estado) : ?>
                  <tr>
                    <td class="align-middle">1</td>
                    <td class="align-middle">Ken</td>
                    <td class="align-middle">Ken@Gmail.Com</td>
                    <td class="align-middle">3063989</td>
                    <td class="p-0 align-middle">
                      <?php if($estado == 'Inscrito'): ?>
                        <div class="w-100 h-100 d-flex justify-content-center align-items-center py-2 bg-success text-white" style="min-height: 40px;">
                          <i class="fas fa-check mr-2"></i> Inscrito
                        </div>
                      <?php else: ?>
                        <div class="w-100 h-100 d-flex justify-content-center align-items-center py-2 bg-warning text-dark" style="min-height: 40px;">
                          <i class="fas fa-check mr-2"></i> En Proceso
                        </div>
                      <?php endif; ?>
                    </td>
                    <td class="align-middle">06/11/2025</td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <div class="d-flex justify-content-end">
              <ul class="pagination mt-2">
                <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
              </ul>
            </div>
          </div>
          <!-- /VISTA ADMINISTRADOR -->

        </div>
        <div class="card-footer position-relative d-flex justify-content-center align-items-center">
          <button id="btnSubirDocumento" class="btn btn-primary px-4" style="border-radius: 5px;">
            <i class="fas fa-file-upload mr-2"></i> Subir documento de certificación bancaria
          </button>
          <div class="position-absolute" style="right: 20px;">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="switchVistaAdmin">
              <label class="custom-control-label" for="switchVistaAdmin" style="cursor: pointer;" title="Cambiar a vista de administrador"></label>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var switchBtn = document.getElementById('switchVistaAdmin');
          var vistaUsuario = document.getElementById('vistaUsuario');
          var vistaAdmin = document.getElementById('vistaAdmin');
          var btnDoc = document.getElementById('btnSubirDocumento');

          if(switchBtn) {
            switchBtn.addEventListener('change', function() {
              if(this.checked) {
                vistaUsuario.style.display = 'none';
                vistaAdmin.style.display = 'block';
                if(btnDoc) btnDoc.style.display = 'none';
              } else {
                vistaUsuario.style.display = 'block';
                vistaAdmin.style.display = 'none';
                if(btnDoc) btnDoc.style.display = 'block';
              }
            });
          }
        });
      </script>

    </section>
    <!-- /.content -->
  
  <!-- </div> -->
  <!-- /.content-wrapper -->