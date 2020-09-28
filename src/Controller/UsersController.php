<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class UsersController extends AppController
{
    public function beforeFilter(Event $event)    // método que é executado antes de qualquer Cntroller ser executado
    {
        parent::beforeFilter($event);           // Chama o método beforeFilter do pai (AppController) e repassa o evento

        $this->Auth->allow(['adicionar', 'salvar']); // informa as ações que devem ser liberadas pelo componente Auth sem autenticação
    }

    public function index()
    {
        // implementar Listagem de Usuários
    }

    public function adicionar()
    {
        $userTable = TableRegistry::get('Users');               // para usar tabela users

        $user = $userTable->newEntity();                                // criar uma entidade vazia

        $this->set('user', $user);                   // passa a variável user (registro vazio) para a view
    }

    public function salvar()
    {
        $userTable = TableRegistry::get('Users');                // para usar tabela users

        $user = $userTable->newEntity($this->request->data());          // cria uma entidade usuário com os dados vindo da requisição

        if ($userTable->save($user)) {                                  // salvar a entidade no banco
            $this->Flash->set("Usuário cadastrado com sucesso");        // Flass Scope (Flash Message)
        } else {
            $this->Flash->set("Erro ao cadastrar o usuário");           // Flass Scope (Flash Message)
        }

        $this->redirect('Users/adicionar');                         // Redireciona usuário
    }

    public function login()
    {
        if ($this->request->is('post')) {                           // verifica se a requisição é post
            $user = $this->Auth->identify();                              // sistema de identificação tenta identificar o usuário

            if ($user) {                                                   // Se encontrar usuário seta o usuário e redireciona
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            } else {                                                                       // Se não encontrar Envia menssagem de erro
                $this->Flash->set("Usuário ou senha inválidos", ['element' => 'error']);
            }
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());          // faz logoff usando o componente Auth que já tem a página de logout configurada
    }
}
