<?php

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Mailer\Email;
use Cake\Validation\Validator;

class ContatoForm extends Form
{
    // Criar o schema do Formulário
    public function _buildSchema(Schema $schema): Schema
    {
        $schema->addField('nome', 'string');
        $schema->addField('email', 'string');
        $schema->addField('msg', 'text');

        return $schema;
    }

    // validação do Formulário
    public function _buildValidator(Validator $validator): Validator
    {
        $validator->add('mensagem', [
            'minLength' => [
                'rule' => ['minLength', 10],
                'message' => 'A mensagem precisa ter pelo menos 10 caracteres'
            ]
        ]);

        $validator->notEmpty('nome');
        $validator->notEmpty('email');

        return $validator;
    }

    // Processar Formulário
    public function _execute(array $data)
    {
        $email = new Email('gmail');
        $email->to('cursocakephp@gmail.com');
        $email->subject('Email enviado pelo site');

        $mensagem = "Contato feito pelo site <br>
            Nome: {$data['nome']} <br>
            Email: {$data['email']} <br>
            Mensagem: {$data['mensagem']} <br>
        ";

        return $email->send('mensagem');
    }
}
