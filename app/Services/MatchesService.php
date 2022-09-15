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
    public function getUpcomingMatches($request);

    public function getMatches($request);

    public function getMatchDetails($request);

    public function sendRequest($request);

    public function acceptRequest($request);

    public function filterMatchData($request);

    public function getPlayersListInMatch($request);
}