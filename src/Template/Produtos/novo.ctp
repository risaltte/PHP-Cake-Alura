<?php
// Criar Formulário pelo Helper 'Form'
echo $this->Form->create($produto, ['action' => 'salva']);
echo $this->Form->input('id');
echo $this->Form->input('nome');
echo $this->Form->input('preco');
echo $this->Form->input('descricao');
echo $this->Form->button('Salvar');
echo $this->Form->end();
?>
