@extends('layouts.app')

@section('content')
<div class="row g-5">
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            Últimas Noticias
        </h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="mb-4 text-end">
            <a href="{{ route('noticias.create') }}" class="btn btn-success">Crear Nueva Noticia</a>
        </div>

        @forelse($noticias as $noticia)
            <article class="blog-post mb-5">
                <h2 class="display-6 link-body-emphasis mb-1">
                    <a href="{{ route('noticias.show', $noticia->id) }}" class="text-decoration-none">{{ $noticia->titulo }}</a>
                </h2>
                <p class="blog-post-meta text-muted">{{ $noticia->created_at->format('d M Y H:i') }}</p>

                <p>{{ $noticia->resumen }}</p>
                
                <a href="{{ route('noticias.show', $noticia->id) }}" class="btn btn-outline-primary btn-sm">Leer más y ver comentarios ({{ $noticia->comentarios->count() }})</a>
            </article>
            <hr>
        @empty
            <p class="text-muted">No hay noticias publicadas todavía.</p>
        @endforelse

        <!-- Paginación -->
        <div class="mt-4">
            {{ $noticias->links() }}
        </div>
    </div>

    <!-- Barra lateral estándar del Blog -->
    <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
            <div class="p-4 mb-3 bg-body-tertiary rounded">
                <h4 class="fst-italic">Sobre este Blog</h4>
                <p class="mb-0">Un espacio de noticias en tiempo real con restricciones de tiempo para edición y control riguroso de comentarios.</p>
            </div>
        </div>
    </div>
</div>
@endsection