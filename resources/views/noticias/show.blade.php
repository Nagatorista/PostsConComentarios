@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <article class="blog-post">
        <h2 class="display-5 link-body-emphasis mb-1">{{ $noticia->titulo }}</h2>
        <p class="blog-post-meta">{{ $noticia->created_at->format('d M Y H:i') }}</p>
        
        <p class="lead">{{ $noticia->resumen }}</p>
        <hr>
        <div class="mb-4">
            {!! nl2br(e($noticia->texto)) !!}
        </div>

        <div class="mb-5">
            @if($noticia->puedeEditarse())
                <a href="{{ route('noticias.edit', $noticia->id) }}" class="btn btn-warning">Editar Noticia</a>
            @endif

            @if(!$noticia->tieneComentarios())
                <form action="{{ route('noticias.destroy', $noticia->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Borrar noticia?')">Borrar noticia</button>
                </form>
            @endif
        </div>
    </article>

    <section class="mt-5">
        <h3>Comentarios ({{ $noticia->comentarios->count() }})</h3>
        
        <div class="list-group mb-4">
            @forelse($noticia->comentarios as $c)
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">Valoración: {{ $c->valoracion }} ⭐</h6>
                        <small class="text-muted">{{ $c->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ $c->mensaje }}</p>

                    {{-- Regla: Si pasa de 5 min, no se puede editar ni borrar --}}
                    @if($c->puedeEditarOBorrar())
                        <small>
                            <a href="{{ route('comentarios.edit', $c->id) }}">Editar</a>
                            <form action="{{ route('comentarios.destroy', $c->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger bg-transparent border-0 p-0" style="cursor: pointer;" onclick="return confirm('¿Borrar comentario?')">
                                    Borrar
                                </button>
                            </form>
                        </small>
                    @endif
                </div>
            @empty
                <p class="text-muted">No hay comentarios aún. ¡Sé el primero en opinar!</p>
            @endforelse
        </div>

        <div class="card p-4 shadow-sm">
            <h4>Deja tu comentario</h4>
            <form action="{{ route('comentarios.store', $noticia->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="valoracion" class="form-label">Valoración (1 al 5)</label>
                    <select name="valoracion" class="form-select" required>
                        <option value="5">5 - Excelente</option>
                        <option value="4">4 - Bueno</option>
                        <option value="3">3 - Regular</option>
                        <option value="2">2 - Malo</option>
                        <option value="1">1 - Muy Malo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mensaje" class="form-label">Comentario</label>
                    <textarea name="mensaje" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Publicar comentario</button>
            </form>
        </div>
    </section>
</div>
@endsection