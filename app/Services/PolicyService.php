<?php

namespace App\Services;

/**
 * Interface PolicyService
 *
 * @package App\Services
 */
interface PolicyService
{
    /**
     * Method used to fetch the players data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getPolicies($id);
}