<?php

namespace App\Services;

/**
 * Interface ClubDataService
 *
 * @package App\Services
 */
interface ClubDataService
{
    /**
     * Method used to fetch the club data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getClubs();

    public function getSingleClub($id);

}