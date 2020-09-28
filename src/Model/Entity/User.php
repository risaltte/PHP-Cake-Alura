<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
    public function _setPassword(string $password): string
    {
        return (new DefaultPasswordHasher)->hash($password);

        // O método recebe a senha em texto claro e retorna um hash da senha para armazenar no banco.
    }
}
