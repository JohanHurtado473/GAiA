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

        <!-- Tarjetas de Apoyos -->
        <div class="row justify-content-center px-4" id="accordionApoyos">
          
          <!-- ALIMENTACION -->
          <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <!-- small box -->
            <div class="small-box apoyo-radial-card">
              <div class="inner">
                <h4>ALIMENTACIÓN</h4>
                <p>Apoyo Disponible</p>
              </div>
              <div class="icon">
                <i class="fas fa-utensils"></i>
              </div>
              <div class="small-box-footer p-2 d-flex justify-content-center flex-wrap">
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn" data-toggle="modal" data-target="#modalAlimentacion">Info. Apoyo</button>
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn" data-toggle="modal" data-target="#modalDetalleAlimentacion">Detalles</button>
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn">Aceptar</button>
              </div>
            </div>
          </div>

          <!-- MEDIOS TECNOLOGICOS -->
          <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <!-- small box -->
            <div class="small-box apoyo-radial-card">
              <div class="inner">
                <h4>MEDIOS TECNOLÓGICOS</h4>
                <p>Apoyo Disponible</p>
              </div>
              <div class="icon">
                <i class="fas fa-laptop"></i>
              </div>
              <div class="small-box-footer p-2 d-flex justify-content-center flex-wrap">
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn" data-toggle="modal" data-target="#modalMedios">Info. Apoyo</button>
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn" data-toggle="modal" data-target="#modalDetalleMedios">Detalles</button>
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn">Aceptar</button>
              </div>
            </div>
          </div>

          <!-- SOSTENIMIENTO REGULAR -->
          <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <!-- small box -->
            <div class="small-box apoyo-radial-card">
              <div class="inner">
                <h4>SOSTENIMIENTO</h4>
                <p>Apoyo Disponible</p>
              </div>
              <div class="icon">
                <i class="fas fa-hand-holding-usd"></i>
              </div>
              <div class="small-box-footer p-2 d-flex justify-content-center flex-wrap">
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn" data-toggle="modal" data-target="#modalSostenimiento">Info. Apoyo</button>
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn" data-toggle="modal" data-target="#modalDetalleSostenimiento">Detalles</button>
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn">Aceptar</button>
              </div>
            </div>
          </div>

          <!-- TRANSPORTE -->
          <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <!-- small box -->
            <div class="small-box apoyo-radial-card">
              <div class="inner">
                <h4>TRANSPORTE</h4>
                <p>Apoyo Disponible</p>
              </div>
              <div class="icon">
                <i class="fas fa-bus"></i>
              </div>
              <div class="small-box-footer p-2 d-flex justify-content-center flex-wrap">
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn" data-toggle="modal" data-target="#modalTransporte">Info. Apoyo</button>
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn" data-toggle="modal" data-target="#modalDetalleTransporte">Detalles</button>
                <button type="button" class="btn btn-sm m-1 shadow-sm apoyo-btn">Aceptar</button>
              </div>
            </div>
          </div>

        </div>
        
      </div>


      <!-- Modales de Información de Apoyos -->

      <!-- Modal Alimentación -->
      <div class="modal fade" id="modalAlimentacion">
        <div class="modal-dialog">
          <div class="modal-content apoyo-modal-secundario">
            <div class="modal-header">
              <h4 class="modal-title">
                <i class="fas fa-utensils"></i> Alimentación
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Se informa a los aprendices que está disponible el apoyo de Alimentación.</p>
              <p class="font-weight-bold">APOYO DISPONIBLE DESDE EL 11/02/2025 HASTA EL 28/02/2025</p>
              <p class="mb-0">CUPOS DISPONIBLES: 70</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Modal Medios -->
      <div class="modal fade" id="modalMedios">
        <div class="modal-dialog">
          <div class="modal-content apoyo-modal-secundario">
            <div class="modal-header">
              <h4 class="modal-title">
                <i class="fas fa-laptop"></i> Medios Tecnológicos
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Se informa a los aprendices que está disponible el apoyo de Medios Tecnológicos.</p>
              <p class="font-weight-bold">APOYO DISPONIBLE DESDE EL 11/02/2025 HASTA EL 28/02/2025</p>
              <p class="mb-0">CUPOS DISPONIBLES: 70</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Sostenimiento -->
      <div class="modal fade" id="modalSostenimiento">
        <div class="modal-dialog">
          <div class="modal-content apoyo-modal-secundario">
            <div class="modal-header">
              <h4 class="modal-title">
                <i class="fas fa-hand-holding-usd"></i> Sostenimiento Regular
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Se informa a los aprendices que está disponible el apoyo de Sostenimiento Regular.</p>
              <p class="font-weight-bold">APOYO DISPONIBLE DESDE EL 11/02/2025 HASTA EL 28/02/2025</p>
              <p class="mb-0">CUPOS DISPONIBLES: 70</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Transporte -->
      <div class="modal fade" id="modalTransporte">
        <div class="modal-dialog">
          <div class="modal-content apoyo-modal-secundario">
            <div class="modal-header">
              <h4 class="modal-title">
                <i class="fas fa-bus"></i> Transporte
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Se informa a los aprendices que está disponible el apoyo de Transporte.</p>
              <p class="font-weight-bold">APOYO DISPONIBLE DESDE EL 11/02/2025 HASTA EL 28/02/2025</p>
              <p class="mb-0">CUPOS DISPONIBLES: 70</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <!--=====================================
      MODALES DE DETALLES DE APOYOS
      ======================================-->

      <!-- Modal Detalle Alimentación -->
      <div class="modal fade" id="modalDetalleAlimentacion">
        <div class="modal-dialog modal-lg">
          <div class="modal-content apoyo-modal-secundario">
            <div class="modal-header">
              <h4 class="modal-title">
                <i class="fas fa-utensils"></i> Alimentación - Detalles
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Es aquel que se otorga a los aprendices de formación laboral y formación tecnológica, de todas las modalidades y jornadas que cumplan con los requisitos, y cuyo propósito es apoyar la permanencia del aprendiz en su proceso formativo.</p>
              <p>La modalidad de entrega para los apoyos de alimentación trimestral será mediante consignación o transferencia bancaria al aprendiz.</p>
              <p>Se fija en CIEN MIL PESOS M/CTE ($100.000) mensuales, por periodos fijos de tres meses, para el aprendiz, previo cumplimiento de los requisitos. Su desembolso se debe hacer mes vencido.</p>
              <p>Este recurso será entregado para que el aprendiz lo utilice exclusivamente en la compra de alimentos.<br>
              El aprendiz que sea adjudicado mediante resolución deberá firmar un acta de compromiso de buen uso del apoyo de alimentación.</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Detalle Medios Tecnológicos -->
      <div class="modal fade" id="modalDetalleMedios">
        <div class="modal-dialog modal-lg">
          <div class="modal-content apoyo-modal-secundario">
            <div class="modal-header">
              <h4 class="modal-title">
                <i class="fas fa-laptop"></i> Medios Tecnológicos - Detalles
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>El Apoyo de Medios Tecnológicos - Plan de Datos es un beneficio económico que el SENA entrega a los aprendices mediante consignación o transferencia bancaria, con el objetivo de ayudarles a cubrir el costo mensual de su plan de datos, necesario para desarrollar sus actividades de formación en etapa lectiva o productiva.</p>
              <p>Este apoyo está dirigido a aprendices de formación laboral y tecnológica, sin importar la modalidad, siempre que estén vinculados a un centro o ambiente de aprendizaje y cumplan con los requisitos establecidos en la convocatoria.</p>
              <p>La entrega del apoyo se realiza mes a mes, no se acumula ni se paga de manera retroactiva, por lo que no se pueden juntar pagos de varios meses en una sola consignación.</p>
              <p>El valor del beneficio es de $50.000 mensuales, y puede otorgarse hasta por un máximo de tres meses, siempre que el aprendiz mantenga los requisitos. El desembolso se hace mes vencido.</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Detalle Sostenimiento Regular -->
      <div class="modal fade" id="modalDetalleSostenimiento">
        <div class="modal-dialog modal-lg">
          <div class="modal-content apoyo-modal-secundario">
            <div class="modal-header">
              <h4 class="modal-title">
                <i class="fas fa-hand-holding-usd"></i> Sostenimiento Regular - Detalles
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>El Apoyo de Sostenimiento es el recurso en dinero equivalente al cincuenta por ciento (50%) del salario mínimo legal mensual vigente (SMLMV), que se entrega mensualmente a los aprendices matriculados en un programa de formación laboral o de formación tecnológica, en modalidad presencial, virtual o a distancia, y que, además, cumplan con las condiciones establecidas para ser beneficiarios del apoyo, según la disponibilidad de cupos y presupuesto de la entidad.</p>
              <p>No aplica para programas de ampliación de cobertura, articulación con la media, ni para los programas en los niveles de especialización tecnológica o profundización técnica.</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Detalle Transporte -->
      <div class="modal fade" id="modalDetalleTransporte">
        <div class="modal-dialog modal-lg">
          <div class="modal-content apoyo-modal-secundario">
            <div class="modal-header">
              <h4 class="modal-title">
                <i class="fas fa-bus"></i> Transporte - Detalles
              </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>El Apoyo de Transporte es aquel que se otorga a los aprendices de formación laboral y formación tecnológica, en modalidad presencial o a distancia, que cumplan con los requisitos establecidos y cuyo propósito es apoyar la permanencia y asistencia del aprendiz en su proceso formativo, mediante transferencia bancaria directa al beneficiario.</p>
              <p>La modalidad de entrega para los apoyos de transporte se realizará mediante consignación o transferencia bancaria directa al aprendiz.</p>
              <p>El apoyo de transporte temporal debe entregarse mes a mes al aprendiz, según la modalidad adoptada. No será acumulativo ni retroactivo; es decir, no se debe realizar en una misma entrega, ni en un (1) mismo mes, la asignación correspondiente a dos (2) o tres (3) meses.</p>
              <p>Se fija en CIEN MIL PESOS M/CTE ($100.000) mensuales, por periodos mínimos de tres (3) meses, previo cumplimiento de los requisitos. Su desembolso se debe realizar mes a mes y/o mes vencido.</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  
  <!-- </div> -->
  <!-- /.content-wrapper -->