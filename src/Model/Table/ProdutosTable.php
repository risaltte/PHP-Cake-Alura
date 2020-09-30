<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProdutosTable extends Table
{
    public function validationDefault(Validator $validator): Validator
    {
        $validator->requirePresence('nome', true)           // campo nome obrigatório e não vazio
            ->notEmpty('nome');

        $validator->add('descricao', [                                      // criar uma regra específica
            'minLength' => [                                                      // nome da regra
                'rule' => ['minLength', 10],                                      // regra - tamanho mínimo de 10 caracteres
                'message' => 'A descrição deve ter pelo menos 10 caracteres'      // mensagem
            ]
        ]);

        $validator->add('preco', [                                                 // criar uma regra específica
            'decimal' => [                                                              // nome da regra
                'rule' => ['decimal', 2],                                               // regra - decimal com duas casas
                'message' => 'Por favor digite um número decimal separado por ponto'    // mensagem
            ]
        ]);

        return $validator;
    }
}
