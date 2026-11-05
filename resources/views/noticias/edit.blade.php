@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 700px;">
    <h2 class="mb-4">Editar Noticia</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('noticias.update', $noticia->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $noticia->titulo) }}" required maxlength="200">
        </div>

        <div class="mb-3">
            <label for="resumen" class="form-label">Resumen</label>
            <textarea class="form-control" id="resumen" name="resumen" rows="3" required maxlength="500">{{ old('resumen', $noticia->resumen) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="texto" class="form-label">Contenido completo</label>
            <textarea class="form-control" id="texto" name="texto" rows="8" required>{{ old('texto', $noticia->texto) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Noticia</button>
        <a href="{{ route('noticias.show', $noticia->id) }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection