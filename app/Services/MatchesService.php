<?php

namespace App\Services;

/**
 * Interface MatchesService
 *
 * @package App\Services
 */
interface MatchesService
{
    /**
     * Method used to fetch the players data
     *
     * @param $request
     *
     * @return mixed
     */
    public function getUpcomingMatches();

    public function getMatchesList($key);

    public function getMatchDetails($matchId);

    public function sendRequest($request);

    public function acceptRequest($request);

}