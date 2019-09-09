<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;

class ProdutosController extends Controller
{
    public function index(){
        //Carregando os produtos do meu bd
        $produtos = Produto::paginate(5);
        //Retornar view com os produtos
        return view('produtos.index', compact('produtos'));
    }
    public function edit($id){
        //Carregar o meu produto do bd
        $produto = Produto::find($id);
        //Carregando as categorias
        $categorias = Categoria::all();
        //Retornando a view com o formulário para edição deste produto
        return view('produtos.edit',compact('produto','categorias'));
    }
    public function update($id){
        //Carregar o produto no bd
        $produto = Produto::find($id);
        //Alterando os campos do produto
        $produto->nome = request('nome');
        $produto->preco = request('preco');
        $produto->quantidade = request('quantidade');
        $produto->id_categoria = request('categoria');
        //Salvar alterações na base
        $produto->save();
        //Retornar para a lista de produtos ('/produtos')
        return redirect('/produtos');
    }
    public function create(){
        //Carregar as categorias
        $categorias = Categoria::all();
        //Retornar view
        return view('produtos.create',compact('categorias'));
    }
    public function store(){
        //Criar um novo produto
        $produto = new Produto();
        //Atribui valores para os campos do produto
        $produto->nome = request('nome');
        $produto->preco = request('preco');
        $produto->quantidade = request('quantidade');
        $produto->id_categoria = request('categoria');
        //Salvar o produto no bd
        $produto->save();
        //Retornar para a lista de produtos
        return redirect('/produtos');
    }
    public function destroy($id){
        //Carrega o produto
         //$produto = Produto::find($id);
        //Removendo o produto no bd
         //$produto->delete();
        Produto::where('id',$id)->delete();
        //Retornando para a lista de produtos
        return redirect('/produtos');
    }
    public function show($id){
        $produto = Produto::find($id);
        return view('produtos.show',compact('produto'));
    }
}
