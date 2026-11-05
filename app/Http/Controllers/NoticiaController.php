<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::latest()->paginate(10);
        return view('noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('noticias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:200',
            'resumen' => 'required|max:500',
            'texto' => 'required',
        ]);

        Noticia::create($request->all());

        return redirect()->route('noticias.index')->with('success', 'Noticia creada con éxito.');
    }

    public function show($id)
    {
        $noticia = Noticia::with('comentarios')->findOrFail($id);
        return view('noticias.show', compact('noticia'));
    }

    public function edit($id)
    {
        $noticia = Noticia::findOrFail($id);

        if (!$noticia->puedeEditarse()) {
            return redirect()->route('noticias.show', $id)
                ->with('error', 'Han pasado más de 20 minutos. Ya no puedes editar esta noticia.');
        }

        return view('noticias.edit', compact('noticia'));
    }

    public function update(Request $request, $id)
    {
        $noticia = Noticia::findOrFail($id);

        if (!$noticia->puedeEditarse()) {
            return redirect()->route('noticias.show', $id)
                ->with('error', 'Han pasado más de 20 minutos. Ya no puedes editar esta noticia.');
        }

        $request->validate([
            'titulo' => 'required|max:200',
            'resumen' => 'required|max:500',
            'texto' => 'required',
        ]);

        $noticia->update($request->all());

        return redirect()->route('noticias.show', $id)->with('success', 'Noticia actualizada con éxito.');
    }

    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id);

        if ($noticia->tieneComentarios()) {
            return back()->with('error', 'Esta noticia tiene comentarios y no se puede borrar.');
        }

        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'Noticia eliminada correctamente.');
    }
}