<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

class ProdutosController extends AppController
{
    public function index()
    {
        $produtosTable = TableRegistry::get('Produtos');    // para usar a tabela produtos

        $produtos = $produtosTable->find('all');            // busca todos os produtos da tabela

        //para buscar um produto pelo id
        //$umProduto = $produtosTable->get(1);

        $this->set('produtos', $produtos);                        // enviar dados para a view
    }

    public function novo()
    {
        $produtoTable = TableRegistry::get('Produtos');     // para usar a tabela produtos

        $produto = $produtoTable->newEntity();                    // Cria uma Entidade Vazia

        $this->set('produto', $produto);                          // enviar dados para a view
    }

    public function editar(int $id)
    {
        $produtoTable = TableRegistry::get('Produtos');     // para usar a tabela produtos
        $produto = $produtoTable->get($id);                       // buscar do banco um produto pelo id

        $this->set('produto', $produto);                          // enviar o produto para a view

        $this->render('novo');                              //renderizar a view novo, para reaproveitar o formulário
    }

    public function salva()
    {
        $produtoTable = TableRegistry::get('Produtos');     // para usar a tabela produtos

        $produto = $produtoTable->newEntity($this->request->data()); // criar um nova entidade com os dados da requisição

        if ($produtoTable->save($produto)) {                        // tenta salvar o produto no banco
            $msg = "Produto cadastrado com sucesso";
            $this->Flash->set($msg, ['element' => 'success']);      // Flash Scope (Flash Message)
        } else {
            $msg = "Erro ao salvar o produto";
            $this->Flash->set($msg, ['element' => 'error']);        // Flash Scope (Flash Message)
        }

       $this->redirect('/Produtos/index');                  // redireciona usuário
    }

    public function excluir(int $id)
    {
        $produtoTable = TableRegistry::get('Produtos');     // para usar a tabela produtos

        $produto = $produtoTable->get($id);                        // Cria a entidade a partir do registro do banco

        if ($produtoTable->delete($produto)) {
            $msg = "Produto excluído com sucesso";
            $this->Flash->set($msg, ['element' => 'success']);      // Flash Scope (Flash Message)
        } else {
            $msg = "Erro ao excluir produto";
            $this->Flash->set($msg, ['element' => 'error']);        // Flash Scope (Flash Message)
        }

        $this->redirect('Produtos/index');                  // redirecionar usuário
    }

    public function login()
    {

    }

}
