<?php
    echo $this->Flash->render('auth');      // redenrizar mensagem componente de autentição, o cake 3.9 não precisa disso
?>

<h1>Acesso ao Sistema</h1>

<?php
   echo $this->Form->create();
   echo $this->Form->input('username');
   echo $this->Form->input('password');
   echo $this->Form->button('Acessar');
   echo $this->Form->end();
?>
