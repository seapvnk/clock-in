<?php

class WorkingHours extends Model
{
    protected static $table = 'working_hours';
    protected static $columns = [
        'id',
        'user_id',
        'work_date',
        'time1',
        'time2',
        'time3',
        'time4',
        'worked_time',
    ];

    public static function loadFromUserAndDate($userId, $workDate)
    {
        $registry = self::one(['user_id' => $userId, 'work_date' => $workDate]);

        if (!$registry || empty($registry->values)) {

            $registry = new self([
                'user_id' => $userId,
                'work_date' => $workDate,
                'worked_time' => 0,
            ]);
        }

        return $registry;
    }

    public function getNextTime()
    {

        for ($i = 1; $i <= 4; $i++) {
            $time = "time$i";
            if (!$this->$time) return $time;
        }

        return null;
    }

    public function getActiveClock()
    {
        $nextTime = $this->getNextTime();
        if      (in_array($nextTime, ['time1', 'time3'])) return 'exitTime';
        elseif  (in_array($nextTime, ['time2', 'time4'])) return 'workedInterval';
        return null;
    }

    public function clockin($time)
    {
        $timeColumn = $this->getNextTime();
        if(!$timeColumn) {
            throw new AppException("Você já realizou os 4 batimentos do dia!");
        }
        $this->$timeColumn = $time;
        $this->worked_time = Utility::getSecondsFromDateInterval($this->getWorkedInterval());

        if($this->id) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    function getWorkedInterval()
    {
        [$t1, $t2, $t3, $t4] = $this->getTimes();

        $part1 = new DateInterval('PT0S');
        $part2 = new DateInterval('PT0S');

        if($t1) $part1 = $t1->diff(new DateTime());
        if($t2) $part1 = $t1->diff($t2);
        if($t3) $part2 = $t3->diff(new DateTime());
        if($t4) $part2 = $t3->diff($t4);

        return Utility::sumIntervals($part1, $part2);
    }

    function getLunchInterval()
    {
        [, $t2, $t3,] = $this->getTimes();
        $lunchInterval = new DateInterval('PT0S');

        if($t2) $lunchInterval = $t2->diff(new DateTime());
        if($t3) $lunchInterval = $t2->diff($t3);

        return $lunchInterval;
    }

    function getExitTime()
    {
        [$t1,,, $t4] = $this->getTimes();
        $workday = DateInterval::createFromDateString('8 hours');

        if(!$t1) {
            return (new DateTimeImmutable())->add($workday);
        } elseif($t4) {
            return $t4;
        } else {
            $total = Utility::sumIntervals($workday, $this->getLunchInterval());
            return $t1->add($total);
        }
    }

    public function getBalance()
    {
        if (!$this->time1 && !Utility::isPastWorkday($this->work_date)) return '';
        if ($this->worked_time == Utility::DAILY_TIME) return '';

        $balance = $this->worked_time - Utility::DAILY_TIME;
        $sign = $balance >= 0? '+' : '-';
        return $sign . Utility::getTimeStringFromSeconds(abs($balance));
    }

    public static function getAbsentUsers()
    {
        $today = new DateTime();
        $result = Database::query("
            SELECT name FROM users
            WHERE end_date is NULL
            AND id NOT IN (
                SELECT user_id FROM working_hours
                WHERE work_date = '{$today->format('Y-m-d')}'
                AND time1 IS NOT NULL
            )
        ");

        $absentUsers = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($absentUsers, $row['name']);
            }
        }

        return $absentUsers;
    }


    public static function getWorkedTimeInMonth($yearAndMonth)
    {
        $startDate = Utility::getFirstDayOfMonth($yearAndMonth)->format('Y-m-d');
        $endDate = Utility::getLastDayOfMonth($yearAndMonth)->format('Y-m-d');

        $result = self::select([
            'raw' => "work_date BETWEEN '$startDate' AND '$endDate'",
        ], "sum(worked_time) as sum");

        return $result->fetch_assoc()['sum'];
    }

    public static function getMonthlyReport($userId, $date)
    {
        $registries = [];
        $startDate = Utility::getFirstDayOfMonth($date)->format('Y-m-d');
        $endDate = Utility::getLastDayOfMonth($date)->format('Y-m-d');
        
        $result = self::select([
            'user_id' => $userId,
            'raw' => "work_date between '{$startDate}' AND '{$endDate}'" ,
        ]);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $registries[$row['work_date']] = new WorkingHours($row);
            }
        }

        return $registries;
    }

    private function getTimes()
    {
        $times = [];

        for ($i = 1; $i <= 4; $i++) {
            $time = "time$i";
            $this->$time? array_push($times, Utility::getDateFromString($this->$time)): array_push($times, null);
        }

        return $times;
    }

}