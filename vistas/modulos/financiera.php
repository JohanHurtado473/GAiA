<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Apoyos</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">Financiera</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">


  <div class="container-fluid" style="padding: 20px;">
    <!-- Botones Superiores y Buscador sin fondo blanco para heredar el gris -->
    <div class="container-header-financiera w-100">
      <div class="seleccion-apoyos">
        <!-- Iconos: fa-lock, fa-phone-alt, fa-utensils, fa-car-side -->
        <div class="row w-100">
          <div class="col-auto mb-2" style="width: 220px;">
            <div class="info-box bg-success btn-apoyo active" data-target="#tab-sostenimiento"
              style="cursor:pointer; min-height: 50px; padding: 5px; margin-bottom: 0;">
              <span class="info-box-icon" style="width: 50px; font-size: 1.5rem;"><i class="fas fa-lock"></i></span>
              <div class="info-box-content" style="padding: 5px 10px;">
                <span class="info-box-text text-wrap" style="font-size: 0.85rem; line-height: 1.1;">Apoyo de
                  sostenimiento</span>
              </div>
            </div>
          </div>
          <div class="col-auto mb-2" style="width: 220px;">
            <div class="info-box bg-success btn-apoyo" data-target="#tab-datos"
              style="cursor:pointer; min-height: 50px; padding: 5px; margin-bottom: 0;">
              <span class="info-box-icon" style="width: 50px; font-size: 1.5rem;"><i
                  class="fas fa-phone-alt"></i></span>
              <div class="info-box-content" style="padding: 5px 10px;">
                <span class="info-box-text text-wrap" style="font-size: 0.85rem; line-height: 1.1;">apoyo de
                  datos</span>
              </div>
            </div>
          </div>
          <div class="col-auto mb-2" style="width: 220px;">
            <div class="info-box bg-success btn-apoyo" data-target="#tab-alimentacion"
              style="cursor:pointer; min-height: 50px; padding: 5px; margin-bottom: 0;">
              <span class="info-box-icon" style="width: 50px; font-size: 1.5rem;"><i class="fas fa-utensils"></i></span>
              <div class="info-box-content" style="padding: 5px 10px;">
                <span class="info-box-text text-wrap" style="font-size: 0.85rem; line-height: 1.1;">apoyo de
                  alimentación</span>
              </div>
            </div>
          </div>
          <div class="col-auto mb-2" style="width: 220px;">
            <div class="info-box bg-success btn-apoyo" data-target="#tab-transporte"
              style="cursor:pointer; min-height: 50px; padding: 5px; margin-bottom: 0;">
              <span class="info-box-icon" style="width: 50px; font-size: 1.5rem;"><i class="fas fa-car-side"></i></span>
              <div class="info-box-content" style="padding: 5px 10px;">
                <span class="info-box-text text-wrap" style="font-size: 0.85rem; line-height: 1.1;">apoyo de
                  transporte</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Gran contenedor con borde (como en la imagen) -->
    <div class="main-border-container" style="border: 1px solid #585858ff; padding-bottom: 10px;">
      <!-- Tablas por apoyo -->
      <div class="tab-content w-100" id="tab-content-apoyos">

        <!-- Tab Sostenimiento -->
        <div class="tab-pane fade show active" id="tab-sostenimiento" role="tabpanel">
          <table id="tblSostenimiento" class="table table-bordered table-striped tbl-GAiA w-100">
            <thead>
              <tr>
                <th>Identificacion</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Ficha</th>
                <th>Estado</th>
                <th>última modificación</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $aprendicesSostenimiento = [
                ["1", "Arnulfo slamandra maecha gil", "arnulfo.salamandra@soy.sena.edu.co", "3063989", "06/11/2025"],
                ["2", "Carlos Eduardo Perez Diaz", "carlos.perez@soy.sena.edu.co", "3063990", "07/11/2025"],
                ["3", "Maria Fernanda Gomez Lopez", "maria.gomez@soy.sena.edu.co", "3063991", "08/11/2025"],
                ["4", "Andres Felipe Santos Castro", "andres.santos@soy.sena.edu.co", "3063992", "09/11/2025"],
                ["5", "Laura Valentina Ramirez Ruiz", "laura.ramirez@soy.sena.edu.co", "3063993", "10/11/2025"],
                ["6", "Juan Camilo Herrera Blanco", "juan.herrera@soy.sena.edu.co", "3063994", "11/11/2025"],
                ["7", "Pedro Pablo Leon Jaramillo", "pedro.leon@soy.sena.edu.co", "3063995", "12/11/2025"],
                ["8", "Ana Milena Orozco Tovar", "ana.orozco@soy.sena.edu.co", "3063996", "13/11/2025"],
                ["9", "Santiago de la Cruz", "santiago.cruz@soy.sena.edu.co", "3063997", "14/11/2025"],
                ["10", "Valeria Victoria Mejia", "valeria.mejia@soy.sena.edu.co", "3063998", "15/11/2025"],
                ["11", "Francisco Javier Mora", "francisco.mora@soy.sena.edu.co", "3063999", "16/11/2025"],
                ["12", "Natalia Rocio Cardenas", "natalia.cardenas@soy.sena.edu.co", "3064000", "17/11/2025"],
                ["13", "Hugo Alejandro Caceres", "hugo.caceres@soy.sena.edu.co", "3064001", "18/11/2025"],
                ["14", "Diana Marcela Ospina", "diana.ospina@soy.sena.edu.co", "3064002", "19/11/2025"],
                ["15", "Luis Eduardo Beltran", "luis.beltran@soy.sena.edu.co", "3064003", "20/11/2025"]
              ];
              foreach ($aprendicesSostenimiento as $aprendiz):
                ?>
                <tr>
                  <td><?php echo $aprendiz[0]; ?></td>
                  <td><?php echo $aprendiz[1]; ?></td>
                  <td><?php echo $aprendiz[2]; ?></td>
                  <td><?php echo $aprendiz[3]; ?></td>
                  <td><span class="btn-aprobacion"><i class="fas fa-check"></i> aprobado</span></td>
                  <td><?php echo $aprendiz[4]; ?></td>
                  <td class="acciones-btns">
                    <button class="btn-icon" data-toggle="modal" data-target="#modalTerceros"><i
                        class="far fa-file-alt"></i></button>
                    <button class="btn-icon" data-toggle="modal" data-target="#modalValoresComprometer"><i
                        class="far fa-eye"></i></button>
                    <button class="btn-icon" data-toggle="modal" data-target="#modalValidarRechazar"><i
                        class="fas fa-clipboard-list"></i></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Tab Datos -->
        <div class="tab-pane fade" id="tab-datos" role="tabpanel">
          <table id="tblDatos" class="table table-bordered table-striped tbl-GAiA w-100">
            <thead>
              <tr>
                <th>Identificacion</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Ficha</th>
                <th>Estado</th>
                <th>última modificación</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $aprendicesDatos = [
                ["11", "Maria del Carmen Fernandez", "maria.fernandez@soy.sena.edu.co", "3063989", "10/12/2025"],
                ["12", "Jorge Eliecer Romero", "jorge.romero@soy.sena.edu.co", "3063989", "11/12/2025"]
              ];
              foreach ($aprendicesDatos as $aprendiz):
                ?>
                <tr>
                  <td><?php echo $aprendiz[0]; ?></td>
                  <td><?php echo $aprendiz[1]; ?></td>
                  <td><?php echo $aprendiz[2]; ?></td>
                  <td><?php echo $aprendiz[3]; ?></td>
                  <td><span class="btn-aprobacion"><i class="fas fa-check"></i> aprobado</span></td>
                  <td><?php echo $aprendiz[4]; ?></td>
                  <td class="acciones-btns">
                    <button class="btn-icon" data-toggle="modal" data-target="#modalTerceros"><i
                        class="far fa-file-alt"></i></button>
                    <button class="btn-icon" data-toggle="modal" data-target="#modalValoresComprometer"><i
                        class="far fa-eye"></i></button>
                    <button class="btn-icon" data-toggle="modal" data-target="#modalValidarRechazar"><i
                        class="fas fa-clipboard-list"></i></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Tab Alimentacion -->
        <div class="tab-pane fade" id="tab-alimentacion" role="tabpanel">
          <table id="tblAlimentacion" class="table table-bordered table-striped tbl-GAiA w-100">
            <thead>
              <tr>
                <th>Identificacion</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Ficha</th>
                <th>Estado</th>
                <th>última modificación</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Vacío por ahora -->
            </tbody>
          </table>
        </div>

        <!-- Tab Transporte -->
        <div class="tab-pane fade" id="tab-transporte" role="tabpanel">
          <table id="tblTransporte" class="table table-bordered table-striped tbl-GAiA w-100">
            <thead>
              <tr>
                <th>Identificacion</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Ficha</th>
                <th>Estado</th>
                <th>última modificación</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Vacío por ahora -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- Botones inferiores y paginación (dentro del borde como en Figma) -->
      <div class="footer-row px-3 mt-3">
        <div class="info-buttons">
          <button class="btn-info-bottom" data-toggle="modal" data-target="#modalInfoAdicional">Informacion
            adicional</button>
          <button class="btn-info-bottom" data-toggle="modal" data-target="#modalInfoBancaria">informacion
            bancaria</button>
          <button class="btn-info-bottom" data-toggle="modal" data-target="#modalDescargarReportes">descargar
            reportes</button>
        </div>
        <div id="paginacionCustom" class="paginacion-custom"></div>
      </div>
    </div>
  </div>
  <!-- /.card -->

  <!-- ==============================================
  MODALES DE FINANCIERA (ESTILO modal-secondary ADMINLTE)
  =============================================== -->
  <!-- 1. Modal Info Adicional -->
  <div class="modal fade" id="modalInfoAdicional">
    <div class="modal-dialog">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-user-plus mr-2"></i> INFORMACION ADICIONAL</h4>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Seleccione el apoyo</label>
            <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-smile"></i></span></div>
              <select class="form-control text-dark">
                <option value="">Seleccione...</option>
                <option value="Sostenimiento">Apoyo de sostenimiento</option>
                <option value="Datos">Apoyo de datos</option>
                <option value="Alimentacion">Apoyo de alimentación</option>
                <option value="Transporte">Apoyo de transporte</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Valor del apoyo</label>
            <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
              <input type="text" class="form-control text-dark" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label>Tiempo del apoyo</label>
            <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
              </div>
              <input type="text" class="form-control text-dark" placeholder="">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-primary btn-accion-guardar" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 2. Modal Información Bancaria -->
  <div class="modal fade" id="modalInfoBancaria">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-user-plus mr-2"></i> INFORMACION BANCARIA DE APRENDICES</h4>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group" style="max-width: 300px;">
            <select class="form-control text-dark">
              <option value="">Filtrar aprendices</option>
            </select>
          </div>
          <table class="table table-bordered table-sm mt-3 text-center bg-white text-dark">
            <thead class="bg-success">
              <tr>
                <th>Identificación</th>
                <th>Nombre completo</th>
                <th>Ficha</th>
                <th>Datos bancarios</th>
                <th>Notificar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>112233</td>
                <td>Pepito Perez</td>
                <td>3063989</td>
                <td>SI</td>
                <td><button class="btn btn-sm btn-light btn-notificar"><i class="far fa-bell"></i></button></td>
              </tr>
              <tr>
                <td>112233</td>
                <td>Pepito Perez</td>
                <td>3063989</td>
                <td>NO</td>
                <td><button class="btn btn-sm btn-light btn-notificar"><i class="far fa-bell"></i></button></td>
              </tr>
              <tr>
                <td>112233</td>
                <td>Pepito Perez</td>
                <td>3063989</td>
                <td>SI</td>
                <td><button class="btn btn-sm btn-light btn-notificar"><i class="far fa-bell"></i></button></td>
              </tr>
            </tbody>
          </table>
          <div class="d-flex justify-content-end">
            <ul class="pagination pagination-sm m-0">
              <li class="page-item"><a class="page-link text-dark" href="#">Anterior</a></li>
              <li class="page-item active"><a class="page-link bg-success border-success" href="#">1</a></li>
              <li class="page-item"><a class="page-link text-dark" href="#">Siguiente</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 3. Modal Descargar Reportes -->
  <div class="modal fade" id="modalDescargarReportes">
    <div class="modal-dialog">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-user-plus mr-2"></i> DESCARGAR REPORTES DE BENEFICIARIOS</h4>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <div class="form-group text-left">
            <label>Seleccione el apoyo</label>
            <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-smile"></i></span></div>
              <select class="form-control text-dark">
                <option value="">Seleccione...</option>
                <option value="Sostenimiento">Apoyo de sostenimiento</option>
                <option value="Datos">Apoyo de datos</option>
                <option value="Alimentacion">Apoyo de alimentación</option>
                <option value="Transporte">Apoyo de transporte</option>
              </select>
            </div>
          </div>
          <button type="button" class="btn btn-success mt-3 w-50 btn-reporte-xls"><i class="fas fa-download"></i>
            Reporte por aprendiz</button>
          <br>
          <button type="button" class="btn btn-success mt-3 w-50 btn-reporte-zip"><i class="fas fa-download"></i>
            Reporte en excel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 4. Modal Validar/Rechazar (Enviar Documentos) -->
  <div class="modal fade" id="modalValidarRechazar">
    <div class="modal-dialog">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-exclamation-circle mr-2"></i> ENVIAR DOCUMENTOS</h4>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body border m-3 bg-light text-dark">
          <p><em>Documentos:</em><br>
            • Formato_de_terceros_Pepito<br>
            • Valores a comprometer<br>
            <em>Estado: Pendiente de validación</em>
          </p>
          <p class="mb-0">¿Los documentos son correctos?</p>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-primary btn-enviar-financiera" data-dismiss="modal">Enviar a
            financiera</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 5. Modal Formato Terceros -->
  <div class="modal fade" id="modalTerceros">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-user-plus mr-2"></i> FORMATO DE TERCEROS</h4>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row border m-1 p-3">
            <div class="col-md-6 form-group">
              <label>Consecutivo</label>
              <input type="text" class="form-control text-dark" value="1" readonly>
            </div>
            <div class="col-md-6"></div>

            <div class="col-md-6 form-group">
              <label>Primer Nombre</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Segundo nombre</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Primer apellido</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Segundo apellido</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Tipo documento</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Número documento</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Teléfono celular</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Correo electrónico</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Dirección</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Código ciudad</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Ciudad</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Código departamento</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Departamento</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Banco</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Número cuenta</label>
              <input type="text" class="form-control text-dark">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-primary btn-accion-guardar" data-dismiss="modal">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 6. Modal Valores a Comprometer -->
  <div class="modal fade" id="modalValoresComprometer">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-user-plus mr-2"></i> VALORES A COMPROMETER</h4>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row border m-1 p-3">
            <div class="col-md-6 form-group">
              <label>Consecutivo</label>
              <input type="text" class="form-control text-dark" value="1" readonly>
            </div>
            <div class="col-md-6"></div>

            <div class="col-md-6 form-group">
              <label>Primer Nombre</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Segundo nombre</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Primer apellido</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Segundo apellido</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Número documento</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Valor del apoyo</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Tiempo de duración</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Banco</label>
              <input type="text" class="form-control text-dark">
            </div>
            <div class="col-md-6 form-group">
              <label>Número cuenta</label>
              <input type="text" class="form-control text-dark">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-end">
          <button type="button" class="btn btn-primary btn-accion-guardar" data-dismiss="modal">Guardar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 7. Modal de Notificación Global (Tipo Toast/Éxito) -->
  <div class="modal fade" id="modalNotificacionSuccess">
    <div class="modal-dialog modal-sm" style="position: absolute; top: 10%; right: 10%;">
      <div class="modal-content bg-success">
        <div class="modal-header border-0 pb-0">
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pt-0 text-left">
          <p class="mb-0"></p>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->

<script src="vistas/js/financiera.js"></script>

<!-- </div> -->
<!-- /.content-wrapper -->