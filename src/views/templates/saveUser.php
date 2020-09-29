<main class="content">
    <?php
        SaveUserView::renderTitle(
            'Cadastro de usuário',
            'Crie e atualize o usuário',
            'user'
        );
        SaveUserView::renderMessage();

        $userToUpdate = new User([
            'name' => null,
            'email' => null,
            'start_date' => null,
            'end_date' => null,
            'is_admin' => null,
        ]);

        if (isset($_GET['update'])) {
            $userToUpdate = User::one(['id' => $_GET['update']]);
        }
        
        $id = $userToUpdate->id?? null;
        $name = $userToUpdate->name?? '';
        $email = $userToUpdate->email?? '';
        $start_date = $userToUpdate->start_date?? '';
        $end_date = $userToUpdate->end_date?? '';
        $is_admin = $userToUpdate->is_admin?? false;


    ?>

    <form action="#" method="POST">
        <?php if($id): ?>
            <input type="hidden" name="id" value=<?= $id ?>>
        <?php endif; ?>
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nome</label>
                <input 
                    type="text"
                    id="name"
                    name="name" 
                    placeholder="Informe o nome"
                    class="form-control <?= $errors['name'] ? 'is-invalid' : '' ?>"
                    value="<?= $name?>"
                >
                <div class="invalid-feedback"><?= $errors['name'] ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input 
                    type="email"
                    id="email"
                    name="email" 
                    placeholder="Informe o e-mail"
                    class="form-control <?= $errors['email'] ? 'is-invalid' : '' ?>"
                    value="<?= $email?>"
                >
                <div class="invalid-feedback"><?= $errors['email'] ?></div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Senha</label>
                <input 
                    type="password"
                    id="password"
                    name="password" 
                    placeholder="Informe a senha"
                    class="form-control <?= $errors['password'] ? 'is-invalid' : '' ?>"
                >
                <div class="invalid-feedback"><?= $errors['password'] ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="confirm_password">Confirme a senha</label>
                <input
                    datepicker_color="none"
                    type="password"
                    id="confirm-password"
                    name="confirm_password" 
                    placeholder="Confirme a senha"
                    class="form-control <?= $errors['confirm-password'] ? 'is-invalid' : '' ?>"
                >
                <div class="invalid-feedback"><?= $errors['confirm-password'] ?></div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="start_date">Data de Admissão</label>
                <input
                    datepicker_color="none"
                    placeholder="Informe a data de admissão"
                    type="date"
                    id="start_date"
                    name="start_date" 
                    class="date-picker form-control <?= $errors['start_date'] ? 'is-invalid' : '' ?>"
                    value="<?= $start_date?>"
                >
                <div class="invalid-feedback"><?= $errors['start_date'] ?></div>
            </div>
            <div class="form-group col-md-6">
                <label for="end_date">Data de Desligamento</label>
                <input
                    placeholder="Informe a data de desligamento"
                    type="date"
                    id="end_date"
                    name="end_date" 
                    class="date-picker form-control <?= $errors['end_date'] ? 'is-invalid' : '' ?>"
                    value="<?= $end_date?>"
                >
                <div class="invalid-feedback"><?= $errors['end_date'] ?></div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6"> </div>

            <div class="form-group col-md-6">
                <label for="is_admin">Administrador</label> <br>
                <input type="checkbox" name="is_admin" id="is_admin" class="bootstrap-switch"
                    data-on-label="SIM"
                    data-off-label="NÂO"
                    <?= $is_admin? 'checked' : '' ?>
                />
                <div class="invalid-feedback"><?= $errors['is_admin'] ?></div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6"> </div>

            <div class="form-group col-md-6">
                <button class="btn btn-primary btn-lg">Salvar</button>
                <a href="users" class="btn btn-secondary btn-lg">Cancelar</a>
            </div>
        </div>
    </form>
</main>