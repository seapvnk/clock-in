<main class="content">
    <?php
        ManageView::renderTitle(
            'Relatório Gerencial',
            'Resumo das horas trabalhadas dos funcionários',
            'chart-bar',
        );

    ?>

    <div class="summary-boxes">
        <div class="summary-box bg-info">
            <i class="fas fa-users"></i>
            <p class="title">Qtde de funcionários</p>
            <h3 class="value"><?= $activeUsersCount ?></h3>
        </div>
    </div>

    <div class="summary-box bg-danger">
            <i class="fas fa-bed"></i>
            <p class="title">Faltas</p>
            <h3 class="value"><?= count($absentUsers) ?></h3>
        </div>
    </div>

    <div class="summary-box bg-success">
            <i class="far fa-hourglass"></i>
            <p class="title">Horas no mês</p>
            <h3 class="value"><?= $hoursInMonth ?></h3>
        </div>
    </div>

    <?php if (count($absentUsers) > 0 || 1): ?>
        <div class="card mt-4 p-4 shadow-none">
            <div class="card-header">
                <h4 class="card-title">Faltosos do dia</h4>
                <p class="card-category">Relação dos funcionários que ainda não bateram o ponto</p>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <th>Nome</th>
                    </thead>
                    <tbody>
                        <?php foreach($absentUsers as $name): ?>
                            <tr>
                                <td><?= $name ?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif;?>

</main>