<main class="content">
    <?php 
        ConfirmDeleteView::renderTitle(
            'Confirmação de excluição',
            'Tem certeza que deseja excluir este usuário?',
            'exclamation-circle text-warning', 
        );
        $userToDelete
    ?>
    <table class="table table-hover table-striped">
        <thead>
            <td>Nome</td>
            <td>E-mail</td>
            <td>Data de Admissão</td>
            <?php if($userToDelete->end_date): ?>
                <td>Data de Desligamento</td>
            <?php endif; ?>
        </thead>
        <tbody>
            <tr>
                <td><?= $userToDelete->name ?></td>
                <td><?= $userToDelete->email ?></td>
                <td><?= $userToDelete->start_date ?></td>
                <?php if($userToDelete->end_date): ?>
                    <td><?= $userToDelete->end_date ?></td>
                <?php endif; ?>
            </tr>
        </tbody>
    </table>
    <a href="users?delete=<?= $userToDelete->id ?>" class="btn btn-lg btn-danger">Excluir</a>
    <a href="users" class="btn btn-lg btn-secondary">Cancelar</a>
</main>