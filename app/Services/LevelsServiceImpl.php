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
        $lang = auth()->user()->lang;

        // Check for no language in the header
        if($lang == null) {
            return ['error' => 'Please send a language in the header.'];
        }

        // Check if the language is other than english and arabic
        if($lang != "en" && $lang != "ar") {
            return ['error' => 'Only English (en) and Arabic (ar) are allowed as languages.'];
        }

        $dataArray = [];
        
        // Getting data of all the levels from the db
        $data = $this->levelsRepository->getLevelsList();

        foreach($data as $i => $row) {
            $dataArray[$i]['id'] = $row['id'];
            // Getting level name as per the selected language
            if($lang == "en") {
                $dataArray[$i]['name'] = $row['name'];  
            } elseif ($lang == "ar") {
                $dataArray[$i]['name'] = $row['name_arabic'];  
            }
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