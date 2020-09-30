<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;

class ProdutosController extends AppController
{
    public $paginate = [                                // definindo a quantidade de elementos por página
        'limit' => 5
    ];

    public function initialize()
    {
        parent::initialize();                               // Executa o método initialized da classe pai
        $this->loadComponent('Paginator');          // Carregar o componente de paginação
        $this->loadComponent('Csrf');               // Carregar componente CSRF, token
    }

    public function index()
    {
        $produtosTable = TableRegistry::get('Produtos');    // para usar a tabela produtos

        $produtos = $produtosTable->find('all');            // busca todos os produtos da tabela

        //para buscar um produto pelo id
        //$umProduto = $produtosTable->get(1);

        $this->set('produtos', $this->paginate($produtos));      // enviar dados para a view com paginação
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
        $produtoTable = TableRegistry::get('Produtos');         // para usar a tabela produtos

        $produto = $produtoTable->newEntity($this->request->data()); // criar um nova entidade com os dados da requisição

        if (!$produto->errors() && $produtoTable->save($produto)) {   // verifica se não tem erros no produto e tenta salvar no banco
            $msg = "Produto cadastrado com sucesso";
            $this->Flash->set($msg, ['element' => 'success']);      // Flash Scope (Flash Message)

            $this->redirect('Produtos');                        // redireciona
        } else {
            $msg = "Erro ao salvar o produto";
            $this->Flash->set($msg, ['element' => 'error']);        // Flash Scope (Flash Message)
            $this->set('produto', $produto);               // Envia produto para view
            $this->render('novo');                  // renderiza view novo, volta para o formulário
        }
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

}
