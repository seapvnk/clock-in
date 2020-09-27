<?php

class AppView extends View
{
    protected static $styles = [];
    protected static $templates = [];

    public static function render($params = [])
    {

        Loader::model('WorkingHours');

        $user = unserialize(Session::state()->user);
        $workingHours = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));

        parent::render($params + [
            'user' => $user,
            'workingHours' => $workingHours,
            'workedInterval' => $workingHours->getWorkedInterval()->format('%H:%I:%S'),
            'exitTime' => $workingHours->getExitTime()->format('H:i:s'),
            'activeClock' => $workingHours->getActiveClock(),
        ]);
    }


    public static function renderTitle($title, $subtitle, $icon)
    {
        include TEMPLATE_PATH . '/title.php';
    }

}