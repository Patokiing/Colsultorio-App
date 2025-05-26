@extends('adminlte::page')

@section('title', 'Autorización')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Autorizar Cita</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('guardar.cita', ['id' => $cita->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>ID:</label>
                                <p>{{ $cita->id }}</p>
                            </div>
                            <div class="form-group">
                                <label>Fecha:</label>
                                <p>{{ $cita->fech }}</p>
                            </div>
                            <div class="form-group">
                                <label>Especialidad:</label>
                                <p>{{ $cita->especialidad ? $cita->especialidad->nombre : 'N/A' }}</p>
                                <input type="hidden" id="id_especialidad" name="id_especialidad" value="{{ $cita->especialidad ? $cita->especialidad->id : '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="id_doc">Doctor:</label>
                                <select class="form-control" id="id_doc" name="id_doc" required>
                                    <option value="">Seleccione un doctor</option>
                                    <!-- Options will be dynamically added here via JavaScript -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="observaciones">Observaciones:</label>
                                <textarea class="form-control" id="observaciones" name="observaciones" rows="4" required></textarea>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" name="action" value="autorizar" class="btn btn-success">Autorizar</button>
                                <a href="{{ route('citas') }}" class="btn btn-primary">Atrás</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#id_especialidad').change(function() {
            var especialidadId = $(this).val();
            if (especialidadId) {
                $.ajax({
                    url: '/fetch-doctores',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id_especialidad: especialidadId
                    },
                    success: function(data) {
                        $('#id_doc').html('<option value="">Seleccione un doctor</option>');
                        if (data.length > 0) {
                            $.each(data, function(key, doctor) {
                                $('#id_doc').append('<option value="' + doctor.id + '">' + doctor.nombre + '</option>');
                            });
                        } else {
                            $('#id_doc').html('<option value="">No hay doctores disponibles para esta especialidad</option>');
                        }
                    }
                });
            } else {
                $('#id_doc').html('<option value="">Seleccione una especialidad primero</option>');
            }
        });
        // Trigger the change event initially if a default especialidad is set
        $('#id_especialidad').trigger('change');
    });
</script>
@stop
