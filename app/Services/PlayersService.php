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
    public function getPopularPlayers($request);

    public function getPlayersList($request);
    
    public function getPlayerDetails($id);

    public function followPlayer($request);

    public function addPlayerDetails($request);

    public function addPlayerInMatch($request);
}