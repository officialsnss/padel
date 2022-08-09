<?php

namespace App\Services;

/**
 * Interface BatDataService
 *
 * @package App\Services
 */
interface BatDataService
{
    /**
     * Method used to fetch the court data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getBatDetails($clubId);

}