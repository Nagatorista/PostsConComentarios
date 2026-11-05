@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 600px;">
    <h2 class="mb-4">Editar Comentario</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('comentarios.update', $comentario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="valoracion" class="form-label">Valoración</label>
            <select name="valoracion" id="valoracion" class="form-select" required>
                <option value="5" {{ $comentario->valoracion == 5 ? 'selected' : '' }}>5 - Excelente</option>
                <option value="4" {{ $comentario->valoracion == 4 ? 'selected' : '' }}>4 - Bueno</option>
                <option value="3" {{ $comentario->valoracion == 3 ? 'selected' : '' }}>3 - Regular</option>
                <option value="2" {{ $comentario->valoracion == 2 ? 'selected' : '' }}>2 - Malo</option>
                <option value="1" {{ $comentario->valoracion == 1 ? 'selected' : '' }}>1 - Muy Malo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea name="mensaje" id="mensaje" rows="4" class="form-control" required>{{ old('mensaje', $comentario->mensaje) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="{{ route('noticias.show', $comentario->noticia_id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection