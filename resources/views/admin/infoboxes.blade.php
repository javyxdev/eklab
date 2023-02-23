<div class="card">
    <div class="card-header">Estadísticas Rápidas</div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <div class="info-box bg-gradient-blue">
                    <span class="info-box-icon"><i class="fa fa-clipboard-list"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ORDENES DE EXAMENES</span>
                        <span class="info-box-number">{{$ordensCount}}</span>
                        <!-- The progress section is optional -->
                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <a class="btn btn-primary btn-sm" href="{{route('admin.ordens.index')}}">
                                <i class="fa fa-arrow-alt-circle-left fa-sm fa-fw"></i>
                                IR A GESTION ORDENES
                            </a>
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <div class="col-3">
                <div class="info-box bg-gradient-green">
                    <span class="info-box-icon"><i class="fa fa-user-plus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">PACIENTES REGISTRADOS</span>
                        <span class="info-box-number">{{$pacientesCount}}</span>
                        <!-- The progress section is optional -->
                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                             <a class="btn btn-success btn-sm" href="{{route('admin.pacientes.index')}}">
                                <i class="fa fa-arrow-alt-circle-left fa-sm fa-fw"></i>
                                VER PACIENTES
                            </a>
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <div class="col-3">
                <div class="info-box bg-gradient-orange">
                    <span class="info-box-icon"><i class="fa fa-microscope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">EXAMENES REALIZADOS</span>
                        <span class="info-box-number">{{$detaOrdenCount}}</span>
                        <!-- The progress section is optional -->
                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                             <a class="btn btn-sm" href="{{route('admin.examens.index')}}">
                                <i class="fa fa-arrow-alt-circle-left fa-sm fa-fw"></i>
                                CATALOGO EXAMENES
                            </a>
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <div class="col-3">
                <div class="info-box bg-gradient-cyan">
                    <span class="info-box-icon"><i class="fa fa-vials"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">CATEGORIAS DE EXAMEN</span>
                        <span class="info-box-number">{{$categoriasCount}}</span>
                        <!-- The progress section is optional -->
                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                            <a class="btn btn-sm" href="{{route('admin.categoria_examens.index')}}">
                                <i class="fa fa-arrow-alt-circle-left fa-sm fa-fw"></i>
                                CATEGORIAS DE EXAMEN
                            </a>
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
        </div>
    </div>
</div>
