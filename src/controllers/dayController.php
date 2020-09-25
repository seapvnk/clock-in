<?php

function dayController()
{
    Session::validate();

    $date = (new DateTime())->getTimestamp();
    $today = strftime('%d de %B de %Y', $date);


    Loader::view('Day', [
        'today' => $today
    ]);
}
