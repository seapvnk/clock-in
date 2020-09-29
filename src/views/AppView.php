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

        $params = array_merge($params, [
            'user' => $user,
            'workingHours' => $workingHours,
            'workedInterval' => $workingHours->getWorkedInterval()->format('%H:%I:%S'),
            'exitTime' => $workingHours->getExitTime()->format('H:i:s'),
            'activeClock' => $workingHours->getActiveClock(),
        ]);

        parent::render( $params );
    }


    public static function renderTitle($title, $subtitle, $icon)
    {
        include TEMPLATE_PATH . '/title.php';
    }

}