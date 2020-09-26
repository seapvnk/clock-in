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
}