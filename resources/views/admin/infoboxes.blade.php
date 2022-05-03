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
                            <div class="progress-bar" style="width: 25%"></div>
                        </div>
                        <span class="progress-description">
                            25% Increase in 30 Days
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
                            <div class="progress-bar" style="width: 89%"></div>
                        </div>
                        <span class="progress-description">
                            89% Increase in 30 Days
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
                            <div class="progress-bar" style="width: 50%"></div>
                        </div>
                        <span class="progress-description">
                            50% Increase in 30 Days
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
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                            70% Increase in 30 Days
                        </span>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
        </div>
    </div>
</div>
