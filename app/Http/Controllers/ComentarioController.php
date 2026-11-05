<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, $noticiaId)
    {
        $request->validate([
            'mensaje' => 'required|string',
            'valoracion' => 'required|in:1,2,3,4,5'
        ]);

        Comentario::create([
            'noticia_id' => $noticiaId,
            'mensaje' => $request->mensaje,
            'valoracion' => $request->valoracion,
        ]);

        return redirect()->route('noticias.show', $noticiaId)->with('success', 'Comentario publicado con éxito.');
    }

    public function edit($id)
    {
        $comentario = Comentario::findOrFail($id);

        if (!$comentario->puedeEditarOBorrar()) {
            return redirect()->route('noticias.show', $comentario->noticia_id)
                ->with('error', 'Han pasado más de 5 minutos. Ya no puedes editar este comentario.');
        }

        return view('comentarios.edit', compact('comentario'));
    }

    public function update(Request $request, $id)
    {
        $comentario = Comentario::findOrFail($id);

        if (!$comentario->puedeEditarOBorrar()) {
            return redirect()->route('noticias.show', $comentario->noticia_id)
                ->with('error', 'Han pasado más de 5 minutos. Ya no puedes editar este comentario.');
        }

        $request->validate([
            'mensaje' => 'required|string',
            'valoracion' => 'required|in:1,2,3,4,5'
        ]);

        $comentario->update($request->only(['mensaje', 'valoracion']));

        return redirect()->route('noticias.show', $comentario->noticia_id)
            ->with('success', 'Comentario actualizado.');
    }

    public function destroy($id)
    {
        $comentario = Comentario::findOrFail($id);
        $noticiaId = $comentario->noticia_id;

        if (!$comentario->puedeEditarOBorrar()) {
            return redirect()->route('noticias.show', $noticiaId)
                ->with('error', 'Han pasado más de 5 minutos. Ya no puedes borrar este comentario.');
        }

        $comentario->delete();

        return redirect()->route('noticias.show', $noticiaId)
            ->with('success', 'Comentario eliminado.');
    }
}