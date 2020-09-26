<main class="content shadow-sm">
    <?php 
        DayView::renderTitle('Registrar ponto', 
                             'Mantenha seu ponto consistente',
                             'check');

        DayView::renderMessage();
        
    ?>
    
    <div class="card shadow-none">
        <div class="card-header p-2">
            <h3 class="text-center"><?= $today ?></h3>
            <p class="mb-0 text-center">Os batimentos efetuados hoje</p>
        </div>
        <div class="card-body">
            <div class="d-flex m-4 justify-content-around">
                <span class="record">Entrada 1: <?= $records->time1?? '---' ?> </span>
                <span class="record">Saída 1: <?= $records->time2?? '---' ?> </span>
            </div>
            <div class="d-flex m-4 justify-content-around">
                <span class="record">Entrada 2: <?= $records->time3?? '---' ?> </span>
                <span class="record">Saída 2: <?= $records->time4?? '---' ?> </span>
            </div>
        </div>
        <div class="card-footer bg-mute d-flex justify-content-end">
            <a href="?" class="btn btn-success btn-lg m-2">
                <i class="fas fa-check mr-2"></i>
                Bater o ponto
            </a>
        </div>
    </div>
</main>