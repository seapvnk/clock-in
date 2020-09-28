<main class="content shadow-sm">
    <?php 
        MonthView::renderTitle('Relatório mensal', 
                             'Mantenha seu ponto consistente',
                             'calendar');

        MonthView::renderMessage();
    ?>
    <div>

        <form class="mb-4" action="#" method="post">
            <div class="row d-flex align-items-center">
                <div class="col-5">
                    <?php if ($user->is_admin): ?>
                    <select style="height: 40px" name="user" id="" class="form-control" placeholder="Selecione o usuário">
                        <option value="">Selecione o usuário</option>
                        <?php foreach ($users as $user): ?>
                            <?php $selected = $user->id === $selectedUserId? 'selected' : ''; ?> 
                            <option <?= $selected ?> value="<?= $user->id ?>"><?= $user->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php endif; ?>
                </div>
                <div class="col-5">
                    <select style="height: 40px"  name="period" id="" class="mx-2 form-control" placeholder="Selecione o periodo">
                        <?php foreach ($periods as $key => $month): ?>
                            <?php $selected = $key === $selectedPeriod? 'selected' : ''; ?> 
                            <option <?= $selected ?> value="<?= $key ?>"><?= $month ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-2">
                    <button  style="height: 40px" class="btn btn-info btn-round"><i class="fas fa-search"></i></button>
                </div>
            </div>    
        </form>

        <table class="table bordered table-striped table-hover">
            <thead>
                <th>Dia</th>
                <th>Entrada 1</th>
                <th>Saída 1</th>
                <th>Entrada 2</th>
                <th>Saída 2</th>
            </thead>

            <tbody>
                <?php foreach ($report as $registry): ?>
                    <tr>
                        <td><?= Utility::formatDateWithLocale($registry->work_date, '%A, %d de %B de %Y'); ?></td>
                        <td><?= $registry->time1; ?></td>
                        <td><?= $registry->time2; ?></td>
                        <td><?= $registry->time3; ?></td>
                        <td><?= $registry->time4; ?></td>
                        <td><?= $registry->getBalance(); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="bg-info text-white">
                    <td>Horas trabalhadas</td>
                    <td colspan=3><?= $sumOfWorkedTime ?></td>
                    <td>Saldo mensal</td>
                    <td><?= $balance ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>