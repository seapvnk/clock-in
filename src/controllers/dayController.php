<?php

Loader::model('WorkingHours');

function dayController()
{
    Session::validate();

    $date = (new DateTime())->getTimestamp();
    $today = strftime('%d de %B de %Y', $date);

    $user = unserialize(Session::state()->user);

    $records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));


    Loader::view('Day', [
        'today' => $today,
        'records' => $records,
    ]);
}
