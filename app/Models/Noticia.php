<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Noticia extends Model
{
    protected $table = 'noticias';
    protected $fillable = ['titulo', 'resumen', 'texto'];

    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentario::class);
    }

    public function puedeEditarse(): bool
    {
        return $this->created_at->addMinutes(20)->isFuture();
    }

    public function tieneComentarios(): bool
    {
        return $this->comentarios()->exists();
    }
}