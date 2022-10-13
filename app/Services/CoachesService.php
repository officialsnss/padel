<?php

namespace App\Services;

/**
 * Interface CoachesService
 *
 * @package App\Services
 */
interface CoachesService
{
    /**
     * Method used to fetch the coaches data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getCoachesList();

    public function getCoachDetails($request);

    public function getCoachesListForBooking($request);
}