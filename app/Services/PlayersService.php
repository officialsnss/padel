<?php

namespace App\Services;

/**
 * Interface PlayersService
 *
 * @package App\Services
 */
interface PlayersService
{
    /**
     * Method used to fetch the players data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getPlayersList();

    public function getPlayerDetails($playerId);

}