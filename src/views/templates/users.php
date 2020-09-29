<main class="content">
    <?php
        UsersView::renderTitle(
            'Cadastro de usuários',
            'Mantenha os dados dos usuários atualizados',
            'users',
        );
        UsersView::renderMessage();
    ?>
    <a class="btn btn-lg btn-primary mb-3" href="saveUser">Novo usuário</a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Data de Admissão</th>
            <th>Data de Desligamento</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->start_date ?></td>
                    <td><?= $user->end_date ?></td>
                    <td>
                        <a href="saveUser?update=<?= $user->id ?>" style="font-size: 12px" class="p-2 btn-sm btn btn-warning rounded-circle">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="?delete=<?= $user->id ?>" style="font-size: 12px" class="p-2 btn-sm btn btn-danger rounded-circle">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>