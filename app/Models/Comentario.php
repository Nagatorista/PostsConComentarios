<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Comentario extends Model
{
    protected $table = 'comentarios';
    protected $fillable = ['noticia_id', 'mensaje', 'valoracion'];

    public function noticia(): BelongsTo
    {
        return $this->belongsTo(Noticia::class);
    }

    public function puedeEditarOBorrar(): bool
    {
        return $this->created_at->addMinutes(5)->isFuture();
    }
}