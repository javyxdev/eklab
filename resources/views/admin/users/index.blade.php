@extends('adminlte::page')

@section('title', 'Gestión de Usuarios')

@section('css')
    <style>
        /* Reducción del font general de la tabla en un 20% */
        #usersTable {
            font-size: 0.8rem !important;
        }
        #usersTable td, #usersTable th {
            padding: 0.5rem !important;
            vertical-align: middle !important;
        }
    </style>
@stop

@section('content_header')
    <h1><i class="fa fa-users-cog"></i> Gestión de Usuarios</h1>
    <p>Administración de cuentas de acceso al sistema.</p>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary" onclick="createUser()">
                <i class="fa fa-user-plus fa-fw"></i> NUEVO USUARIO
            </button>
        </div>
        <div class="card-body">
            @if (session('info'))
                <div class="alert alert-success">
                    {{ session('info') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table id="usersTable" class="table table-striped table-bordered table-hover">
                <thead class="bg-institutional text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" onclick="editUser({{ $user }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @if($user->id !== auth()->id())
                                    <button class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Crear/Editar Usuario -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-institutional text-white">
                    <h5 class="modal-title" id="userModalLabel">Usuario</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="userForm" method="POST">
                    @csrf
                    <div id="method_field"></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña <span id="pass_help" class="text-muted small"></span></label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password_confirmation">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                },
                "responsive": true,
                "autoWidth": false,
            });

            // Lógica para ver/ocultar contraseña
            $('.toggle-password').click(function() {
                const targetId = $(this).data('target');
                const passwordInput = $('#' + targetId);
                const icon = $(this).find('i');

                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });

        function createUser() {
            $('#userForm').attr('action', "{{ route('admin.users.store') }}");
            $('#method_field').html('');
            $('#userModalLabel').text('Nuevo Usuario');
            $('#userForm')[0].reset();
            $('#password').attr('required', true);
            $('#pass_help').text('(Mínimo 8 caracteres)');
            $('#userModal').modal('show');
        }

        function editUser(user) {
            let url = "{{ route('admin.users.update', ':id') }}";
            url = url.replace(':id', user.id);
            
            $('#userForm').attr('action', url);
            $('#method_field').html('@method("PUT")');
            $('#userModalLabel').text('Editar Usuario: ' + user.name);
            
            $('#name').val(user.name);
            $('#email').val(user.email);
            $('#password').attr('required', false);
            $('#pass_help').text('(Dejar en blanco para no cambiar)');
            
            $('#userModal').modal('show');
        }

        function deleteUser(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#101931',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/admin/usersDelete/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response === 'OK') {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El usuario ha sido eliminado.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error',
                                xhr.responseText || 'No se pudo eliminar el usuario',
                                'error'
                            );
                        }
                    });
                }
            })
        }
    </script>
@stop
