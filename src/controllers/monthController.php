<?php

Loader::model('WorkingHours');

function monthController()
{
    Session::validate();

    $currentDate = new DateTime();

    $user = unserialize(Session::state()->user);
    $users = null;

    if ($user->is_admin) {
        $users = User::all();

    }
    
    $selectedPeriod = $_POST['period'] ?? $currentDate->format('Y-m');
    $selectedUserId = $_POST['user'] ?? $user->id;
    $periods = [];
    
    for ($yearDiff = 0; $yearDiff <= 2; $yearDiff++) {
        $year = (date('Y')) - $yearDiff;
        for ($month = 12; $month >= 1; $month--) {
            $date = new DateTime("{$year}-{$month}-1");
            $periods[$date->format('Y-m')] =  strftime("%B de %Y", $date->getTimestamp());

        }
    }
    
    $registries = WorkingHours::getMonthlyReport($selectedUserId, $selectedPeriod);

    $report = [];
    $workday = 0;
    $sumOfWorkedTime = 0;
    $lastDay = Utility::getLastDayOfMonth($selectedPeriod)->format('d');

    for ($day = 1; $day <= $lastDay; $day++) {
        $date = $selectedPeriod . '-' .sprintf("%02d", $day);

        $registry = $registries[$date]?? null;

        if (Utility::isPastWorkday($date)) {
            $workday++;
        }

        if ($registry) {
            $sumOfWorkedTime += $registry->worked_time;
            array_push($report, $registry);
        } else {
            array_push($report, new WorkingHours([
                'work_date' => $date,
                'worked_time' => 0,
            ]));
        }
    }

    $expectedTime = $workday * Utility::DAILY_TIME;
    $balance = Utility::getTimeStringFromSeconds(abs($sumOfWorkedTime - $expectedTime));
    $sign = ($sumOfWorkedTime - $expectedTime) >= 0? '+' : '-';

    Loader::view('Month', [
        'report' => $report,
        'sumOfWorkedTime' => $sumOfWorkedTime,
        'balance' => $sign . $balance,
        'periods' => $periods,
        'selectedPeriod' => $selectedPeriod,
        'selectedUserId' => $selectedUserId,
        'users' => $users,
    ]);
}
