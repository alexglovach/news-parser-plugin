<?php

namespace NewsParserPlugin\Models;

class CronModel
{

    /**
     * @param int|null $timeStart
     * @param string $period
     * @param string $taskName
     * @return bool
     */
    public static function addTask(int $timeStart = NULL, string $period, string $taskName)
    {

        if(!$timeStart) {
            $timeStart = time();
        }
        return wp_schedule_event( $timeStart, $period, $taskName);
    }

    /**
     * @param string $taskName
     * @return int|bool
     */
    public static function nextTaskRun(string $taskName)
    {
        wp_next_scheduled($taskName);
        return wp_next_scheduled($taskName);
    }
}