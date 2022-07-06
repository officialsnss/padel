<?php

namespace App\Services;

use App\Repositories\BatDataRepository;

/**
 * Class BatDataServiceImpl
 *
 * @package App\Services
 */
class BatDataServiceImpl implements BatDataService
{
    /**
     * BatDataServiceImpl constructor.
     *
     */
    public function __construct(BatDataRepository $batDataRepository)
    {
        $this->batDataRepository = $batDataRepository;
    }


     /**
     * Method used to fetch the bat summary list and count
     *
     * @return mixed
     */
    public function getBatDetails($clubId)
    {
        return $this->batDataRepository->getBatDetails($clubId);
    }
}