<table>
    <thead>
        <tr>
            <td>Id</td>
            <td>Nome</td>
            <td>Preço</td>
            <td>Preço com desconto</td>
            <td>Descrição</td>
            <td>Ações</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($produtos as $produto) : ?>
        <tr>
            <td><?= $produto['id']; ?></td>
            <td><?= $produto['nome']; ?></td>
            <td><?= $this->Money->format($produto['preco']); ?></td>
            <td><?= $this->Money->format($produto->calculaDesconto()); ?></td>
            <td><?= $produto['descricao']; ?></td>
            <td>
                <?= // gerar um link para editar cada produto passando o id
                    $this->Html->Link('Editar',
                    ['controller' => 'produtos', 'action' => 'editar', $produto['id']]);
                ?>
                <?= // gerar um link para excluir cada produto passando o id
                $this->Form->postLink('Excluir',
                    ['controller' => 'produtos', 'action' => 'excluir', $produto['id']],
                    ['confirm' => "Tem certeza que deseja excluir o produto {$produto['nome']} ?"]);
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
    // Criar Link pelo Helper Html
    echo $this->Html->Link('Novo Produto', ['controller' => 'produtos', 'action' => 'novo']);
?>

<?php
    // Criar Link pelo Helper Html para fazer logout
    echo $this->Html->Link('Logout', ['controller' => 'users', 'action' => 'logout']);
?>

<div class="paginator">
    <ul class="pagination">
        <?php
        // Criar navegação de páginas na view pelo componente Paginator
        echo $this->Paginator->prev('Voltar');
        echo $this->Paginator->numbers();
        echo $this->Paginator->next('Avançar');
        ?>
    </ul>
</div>

