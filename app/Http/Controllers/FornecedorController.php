<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::all();

        return response()->json([
            'status' => true,
            'mensagem' => 'Lista de fornecedores',
            'dados' => $fornecedores
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'cnpj' => 'required|digits:14|unique:fornecedores,cnpj',
            'email' => 'required|email|unique:fornecedores,email'
        ]);

        $fornecedor = Fornecedor::create($validated);

        return response()->json([
            'status' => true,
            'mensagem' => 'Fornecedor cadastrado com sucesso.',
            'fornecedor' => $fornecedor
        ], 201);
    }

    public function show($id)
    {
        $fornecedor = Fornecedor::find($id);

        if (!$fornecedor) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Fornecedor não encontrado.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'fornecedor' => $fornecedor
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $fornecedor = Fornecedor::find($id);

        if (!$fornecedor) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Fornecedor não encontrado.'
            ], 404);
        }

        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'cnpj' => 'required|digits:14|unique:fornecedores,cnpj,' . $id,
            'email' => 'required|email|unique:fornecedores,email,' . $id
        ]);

        $fornecedor->update($validated);

        return response()->json([
            'status' => true,
            'mensagem' => 'Fornecedor atualizado com sucesso.',
            'fornecedor' => $fornecedor
        ], 200);
    }

    public function destroy($id)
    {
        $fornecedor = Fornecedor::find($id);

        if (!$fornecedor) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Fornecedor não encontrado.'
            ], 404);
        }

        $fornecedor->delete();

        return response()->json([
            'status' => true,
            'mensagem' => 'Fornecedor deletado com sucesso.'
        ], 200);
    }
}
