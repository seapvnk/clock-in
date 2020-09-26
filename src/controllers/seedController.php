<?php

define('REGULAR_DAY',   0);
define('EXTRA_DAY',     1);
define('LAZY_DAY',      2);

function workDayTemplate($template)
{
    $workDayTemplate = [
        [
            'time1' => '08:00:00',
            'time2' => '12:00:00',
            'time3' => '13:00:00',
            'time4' => '17:00:00',
            'worked_time' => Utility::DAILY_TIME,
        ],
    
        [
            'time1' => '08:00:00',
            'time2' => '12:00:00',
            'time3' => '13:00:00',
            'time4' => '18:00:00',
            'worked_time' => Utility::DAILY_TIME + Utility::HOUR,
        ],
    
        [
            'time1' => '08:30:00',
            'time2' => '12:00:00',
            'time3' => '13:00:00',
            'time4' => '18:00:00',
            'worked_time' => Utility::DAILY_TIME - (Utility::HOUR / 2),
        ],
    ];

    return $workDayTemplate[$template];
}

function getDayTemplateByOdds($regularRate, $extraRate, $lazyRate)
{
    $value = rand(0, 100);
    if ($value <= $regularRate) {
        return workDayTemplate(REGULAR_DAY);
    } else if ($value <= $regularRate + $extraRate) {
        return workDayTemplate(EXTRA_DAY);
    } else {
        return workDayTemplate(LAZY_DAY);
    }
}


Loader::model('WorkingHours');

Database::execute('DELETE FROM working_hours');
Database::execute('DELETE FROM users WHERE id > 5');

function populateWorkingHours($userId, $initialDate, $regularRate, $extraRate, $lazyRate)
{
    $currentDate = $initialDate;
    $yersterday = new Datetime();
    $yersterday->modify('-1 day');

    $columns = [
        'user_id' => $userId,
        'work_date' => $currentDate,
    ];

    while (Utility::isBefore($currentDate, $yersterday)) {
        if (!Utility::isWeekend($currentDate)) {
            $template = getDayTemplateByOdds($regularRate, $extraRate, $lazyRate);
            $columns = array_merge($columns, $template);
            $workingHours = new WorkingHours($columns);
            $workingHours->insert();
        }
        $currentDate = Utility::getNextDay($currentDate)->format('Y-m-d');
        $columns['work_date'] = $currentDate;
    }
}


function seedController()
{

    $lastMonth = strtotime('first day of last month');
    populateWorkingHours(1, date('Y-m-1'), 70, 20, 10);
    populateWorkingHours(3, date('Y-m-d', $lastMonth), 20, 75, 5);
    populateWorkingHours(4, date('Y-m-d', $lastMonth), 20, 10, 70);

}