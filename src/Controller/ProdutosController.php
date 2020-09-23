<?php

namespace App\Controller;

class ProdutosController extends AppController
{
    public function index()
    {
        $msg = "Bem vindos ao CakePHP";
        $this->set('msg', $msg);
    }
}
