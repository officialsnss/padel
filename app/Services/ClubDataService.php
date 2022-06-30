<?php

namespace App\Services;

/**
 * Interface ClubDataService
 *
 * @package App\Services\WCAD
 */
interface ClubDataService
{
    /**
     * Method used to fetch the clun data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getClubs($request);

    public function getClubData($id);

}