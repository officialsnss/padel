<?php

namespace App\Services;

/**
 * Interface LevelsService
 *
 * @package App\Services
 */
interface LevelsService
{
    /**
     * Method used to fetch the levels data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getLevelsList();

}