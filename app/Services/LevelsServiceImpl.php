<?php

namespace App\Services;

use App\Repositories\LevelsRepository;

/**
 * Class LevelsServiceImpl
 *
 * @package App\Services
 */
class LevelsServiceImpl implements LevelsService
{
    /**
     * LevelsServiceImpl constructor.
     *
     */
    public function __construct(LevelsRepository $levelsRepository)
    {
        $this->levelsRepository = $levelsRepository;
    }


     /**
     * Method used to fetch the levels summary list and count
     *
     * @return mixed
     */
    public function getLevelsList()
    {
        // Getting data of all the levels from the db
        $data = $this->levelsRepository->getLevelsList();
        $dataArray = [];

        foreach($data as $i => $row) {
            $dataArray[$i]['id'] = $row['id'];            
            $dataArray[$i]['name'] = $row['name'];  
        }
        return $dataArray;
    }

    public function getLevelById($id)
    {
        // Getting level data by id
        $data = $this->levelsRepository->getLevelById($id);
        return $data;
    }
}