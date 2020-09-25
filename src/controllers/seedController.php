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

function seedController()
{
    print_r(getDayTemplateByOdds(90, 5, 5));
}