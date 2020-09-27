<aside class="sidebar">
    <nav class="menu mt-3">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="day"><i class="fas fa-check mr-2"></i> Registrar ponto</a>
            </li>
            <li class="nav-item">
                <a href=""><i class="far fa-calendar mr-2"></i> Relatório mensal</a>
            </li>
            <li class="nav-item">
                <a href=""><i class="fas fa-chart-bar mr-2"></i> Relatório gerencial</a>
            </li>
            <li class="nav-item">
                <a href=""><i class="fas fa-users mr-2"></i> Usuários</a>
            </li>
        </ul>
    </nav>
    <div class="sidebar-widgets">
        <div class="sidebar-widget">
            <i class="fas fa-clock icon text-info"></i>
            <div class="info">
                <span class="main text-info" 
                    <?= $activeClock === 'workedInterval'? 'active-clock' : '' ?>
                ><?= $workedInterval ?></span>
                <span class="label text-mute">Horas trabalhadas</span>
            </div>
        </div>

        <div class="division my-3"></div>

        <div class="sidebar-widget">
            <i class="fas fa-stopwatch icon text-danger"></i>
            <div class="info">
            <span class="main text-danger" 
                    <?= $activeClock === 'exitTime'? 'active-clock' : '' ?>
                ><?= $exitTime ?></span>
                <span class="label text-mute">Hora de saída</span>
            </div>
        </div>

        <div class="my-3"></div>

    </div>
</aside>