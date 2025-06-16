<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();

        return response()->json([
            'status' => 'sucesso',
            'mensagem' => 'Todos os produtos!',
            'dados' => $produtos
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'categoria' => 'required|string|max:100',
            'quantidade' => 'required|integer|min:0',
            'valor' => 'required|numeric|min:0'
        ]);

        $produto = Produto::create($validated);

        return response()->json([
            'status' => true,
            'mensagem' => 'Produto criado com sucesso.',
            'produto' => $produto
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Produto não encontrado.'
            ], 404);
        }

        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'categoria' => 'required|string|max:100',
            'quantidade' => 'required|integer|min:0',
            'valor' => 'required|numeric|min:0'
        ]);

        $produto->update($validated);

        return response()->json([
            'status' => true,
            'mensagem' => 'Produto atualizado com sucesso.',
            'produto' => $produto
        ], 200);
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Produto não encontrado.'
            ], 404);
        }

        $produto->delete();

        return response()->json([
            'status' => true,
            'mensagem' => 'Produto deletado com sucesso.'
        ], 200);
    }
}
