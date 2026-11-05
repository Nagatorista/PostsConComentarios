@extends('layouts.app')

@section('content')
<div class="container my-5" style="max-width: 700px;">
    <h2 class="mb-4">Crear Nueva Noticia</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('noticias.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" required maxlength="200">
        </div>

        <div class="mb-3">
            <label for="resumen" class="form-label">Resumen (Máx. 500 caracteres)</label>
            <textarea class="form-control" id="resumen" name="resumen" rows="3" required maxlength="500">{{ old('resumen') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="texto" class="form-label">Contenido completo (Texto largo)</label>
            <textarea class="form-control" id="texto" name="texto" rows="8" required>{{ old('texto') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Noticia</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection