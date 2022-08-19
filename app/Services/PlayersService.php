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
    public function getPopularPlayers();

    public function getPlayersList();
    
    public function getPlayerDetails();

    public function followPlayer($request);

    public function addPlayerDetails($request);

}