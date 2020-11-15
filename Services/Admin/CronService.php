<?php

namespace NewsParserPlugin\Services\Admin;

use NewsParserPlugin\Models\CronModel;

class CronService
{
    public function addCronTaskNow(string $taskName,string $period,int $timeStart = null):bool
    {
        $periodName = strtolower(str_replace(' ','',$period));
        if(CronModel::nextTaskRun( $taskName )) {
            return false;
        }
        if(CronModel::addTask($timeStart, $periodName, $taskName) === NULL){
            return true;
        }
        return false;
    }
    public function addNewInterval(array $schedules, string $name, int $time):array
    {
        $scheduleName = strtolower(str_replace(' ','',$name));
        $schedules[$scheduleName] = [
            'interval' => $time,
            'display' => __( $name )
        ];
        return $schedules;
    }
}