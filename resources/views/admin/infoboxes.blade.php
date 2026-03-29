<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-gradient-blue elevation-2">
            <span class="info-box-icon"><i class="fa fa-clipboard-list"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Órdenes de Exámenes</span>
                <span class="info-box-number">{{$ordensCount}}</span>
                <span class="progress-description">
                    <a class="btn btn-outline-light btn-xs" href="{{route('admin.ordens.index')}}">
                        <i class="fa fa-arrow-alt-circle-right mr-1"></i> Gestión Órdenes
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-gradient-green elevation-2">
            <span class="info-box-icon"><i class="fa fa-user-plus"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pacientes Registrados</span>
                <span class="info-box-number">{{$pacientesCount}}</span>
                <span class="progress-description">
                     <a class="btn btn-outline-light btn-xs" href="{{route('admin.pacientes.index')}}">
                        <i class="fa fa-arrow-alt-circle-right mr-1"></i> Ver Pacientes
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-institutional elevation-2">
            <span class="info-box-icon"><i class="fa fa-microscope"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Exámenes Realizados</span>
                <span class="info-box-number">{{$detaOrdenCount}}</span>
                <span class="progress-description">
                     <a class="btn btn-outline-light btn-xs" href="{{route('admin.examens.index')}}">
                        <i class="fa fa-arrow-alt-circle-right mr-1"></i> Ver Catálogo
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-dark-yellow elevation-2">
            <span class="info-box-icon"><i class="fa fa-calendar-check"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Citas Pendientes</span>
                <span class="info-box-number">{{$citasPendientesCount}}</span>
                <span class="progress-description">
                    <a class="btn btn-outline-dark btn-xs" href="{{route('admin.citas.index')}}">
                        <i class="fa fa-arrow-alt-circle-right mr-1"></i> Gestión Citas
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>
