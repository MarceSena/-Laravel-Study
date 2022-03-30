<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;
use App\Http\Requests\ProdutosRequest;

class ProdutoController extends Controller
{
    public function lista()
    {
        $produtos = $produtos = Produto::all();
        return view('listagem')->with('produtos', $produtos);;
    }

    public function mostra($id)
    {
        $produto = Produto::find($id);

        if (empty($produto)) {
            return "Esse produto não existe";
        }

        return view('detalhes')->with('p', $produto);
    }

    public function novo()
    {
        return view('formulario');
    }

    public function adiciona(ProdutosRequest $request)
    {
        Produto::create($request->all());
        return redirect('/produtos')->withInput($request->only('nome'));
    }

    public function remove($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        return redirect()->action([ProdutoController::class, 'lista']);
    }
}
