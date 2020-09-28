<?php

function manageController()
{
    Session::validate();

    Loader::model('WorkingHours');

    $activeUsersCount = User::getActiveUsersCount();

    $yearAndMonth = (new DateTime())->format('Y-m');

    $absentUsers = WorkingHours::getAbsentUsers();

    $seconds = WorkingHours::getWorkedTimeInMonth($yearAndMonth);
    $hoursInMonth = explode(':', Utility::getTimeStringFromSeconds($seconds))[0];
    
    Loader::view('Manage', [
        'activeUsersCount' => $activeUsersCount,
        'absentUsers' => $absentUsers,
        'hoursInMonth' => $hoursInMonth,
    ]);
}