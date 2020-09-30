<?php

namespace App\Controller;

use App\Form\ContatoForm;

class ContatoController extends AppController
{
    public function index()
    {
        $contato = new ContatoForm();

        if ($this->request->is('post')) {
           if ($contato->execute($this->request->data())) {
               $this->Flash->set('E-mail enviado com sucesso', ['element' => 'success']);
           } else {
               $this->Flash->set('Falha ao enviar o E-mail', ['element' => 'error']);
           }
        }

        $this->set('contato', $contato);
    }
}
