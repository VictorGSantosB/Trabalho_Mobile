<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{


    public function index()
    {
        $categorias = Categoria::all(['id', 'nome']);

        return response()->json([
            'status' => true,
            'mensagem' => 'Lista de categorias carregada com sucesso.',
            'categorias' => $categorias
        ], 200);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
        ]);

        $categoria = Categoria::create([
            'nome' => $request->nome,
        ]);

        return response()->json([
            'status' => true,
            'mensagem' => 'Categoria criada com sucesso.',
            'categoria' => $categoria,
        ], 201);
    }


    public function destroy($id)
{
    $categoria = Categoria::find($id);

    if (!$categoria) {
        return response()->json([
            'status' => false,
            'mensagem' => 'Categoria não encontrada.'
        ], 404);
    }

    $categoria->delete();

    return response()->json([
        'status' => true,
        'mensagem' => 'Categoria deletada com sucesso.'
    ], 200);
}


public function update(Request $request, $id)
{
    $categoria = Categoria::find($id);

    if (!$categoria) {
        return response()->json([
            'status' => false,
            'mensagem' => 'Categoria não encontrada.'
        ], 404);
    }

    $request->validate([
        'nome' => 'required|string|max:100',
    ]);

    $categoria->update([
        'nome' => $request->nome
    ]);

    return response()->json([
        'status' => true,
        'mensagem' => 'Categoria atualizada com sucesso.',
        'categoria' => $categoria
    ], 200);
}
}
