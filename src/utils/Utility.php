<?php
class Utility
{
    const DAILY_TIME = 8 * 60 ** 2;
    const HOUR = 3600;
    
    public static function redirect($location)
    {
        $url = BASE_URL . '/' . $location;
        header("Location: ${url}");
    }

    public static function getDateAsDateTime($date)
    {
        return is_string($date)? new Datetime($date) : $date;
    }

    public static function isWeekend($date)
    {
        $inputDate = self::getDateAsDateTime($date);
        return $inputDate->format('N') >= 6;
    }

    public static function isBefore($date1, $date2)
    {
        $inputDate1 = self::getDateAsDateTime($date1);
        $inputDate2 = self::getDateAsDateTime($date2);

        return $inputDate1 <= $inputDate2;
    }

    public static function getNextDay($date)
    {
        $inputDate = self::getDateAsDateTime($date);
        $inputDate->modify('+1 day');

        return $inputDate;
    }

    public static function addMessage($msg, $type)
    {
        Session::state()->message = serialize([
            'type' => $type,
            'message' => $msg,
        ]);
    }

    public static function sumIntervals($interval1, $interval2)
    {
        $date = new DateTime('00:00:00');
        $date->add($interval1);
        $date->add($interval2);

        return (new DateTime('00:00:00'))->diff($date);
    }

    public static function subtractIntervals($interval1, $interval2)
    {
        $date = new DateTime('00:00:00');
        $date->add($interval1);
        $date->sub($interval2);

        return (new DateTime('00:00:00'))->diff($date);
    }

    public static function getDateFromInterval($interval)
    {
        return (new DateTimeImmutable($intarval->format('%H:%i:%s')));
    }

    public static function getSecondsFromDateInterval($interval)
    {
        $d1 = new DateTimeImmutable();
        $d2 = $d1->add($interval);
        return $d2->getTimestamp() - $d1->getTimestamp();
    }

    public static function getDateFromString($str)
    {
        return DateTimeImmutable::createFromFormat('h:i:s', $str);
    }
}