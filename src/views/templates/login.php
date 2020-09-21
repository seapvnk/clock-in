<div class="container login-container">

    <?php require_once TEMPLATE_PATH . "/messages.php" ?>

    <form action="" method="post">
        <div class="card login-card">
        
            <div class="card-header bg-primary text-white">
                <h1 class="text-center" style="padding: 0.1em 0">
                    <i class="fas fa-clock"></i>
                    clock-in!
                </h1>
            </div>
            
            <div class="card-body">

                <label for="email">E-mail</label>
                <div class="form-group <?= $errors['email']? 'has-danger': '' ?>">
                    <input
                        class="form-control <?= $errors['email']? 'form-control-danger is-invalid': ''?>"
                        type="email" 
                        name="email" 
                        id="email"
                        value="<?= $email?? '' ?>"
                        placeholder="Informe seu e-mail"
                        autofocus
                    >
                    <div class="invalid-feedback">
                        <?= $errors['email']?? '' ?>
                    </div>
                </div>

                <label for="password">Senha</label>
                <div class="form-group <?= $errors['password']? 'has-danger': '' ?>">
                    <input
                        class="form-control <?= $errors['password']? 'form-control-danger is-invalid': '' ?>"
                        type="password" 
                        name="password" 
                        id="password"
                        placeholder="Informe sua senha"
                        autofocus
                    >
                    <div class="invalid-feedback">
                        <?= $errors['password']?? '' ?>
                    </div>
                </div>
                
            </div>

            <div class="card-footer text-right" style="padding: 1rem">
                <button class="btn btn-lg btn-primary">Entrar</button>
            </div>
        
        </div>

    </form>
</div>