<?php

namespace NewsParserPlugin\Controllers\Admin;

use NewsParserPlugin\Services\Admin\CronService;

class AdminCronController
{
    public function addTwoHoursInterval(array $schedules): array
    {
        $cronService = new CronService();
        return $cronService->addNewInterval($schedules, "Two Hours", 7200);
    }

    public function addParserCronTask()
    {
        $this->addCronTask('parserCheckNewPosts','Two Hours');
    }

    private function addCronTask(string $taskName, string $period, int $timeStart = NULL)
    {
        $cronService = new CronService();
        $cronService->addCronTaskNow($taskName, $period, $timeStart);
    }
}