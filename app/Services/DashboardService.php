<?php

namespace App\Services;

/**
 * Interface DashboardService
 *
 * @package App\Services
 */
interface DashboardService
{
    /**
     * Method used to fetch the dashboard data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getPopularClubs($request);

}