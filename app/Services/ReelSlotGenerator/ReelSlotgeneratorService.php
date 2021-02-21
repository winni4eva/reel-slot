<?php

namespace App\Services\ReelSlotGenerator;

class ReelSlotGeneratorService
{   

    public function __construct(){}

    public function generate(array $symbols, $columns = 5, $rows = 3): array 
    {
        $reel = [];
        for ($i=0; $i < $rows; $i++) { 
            $myRowArray = [];
            for ($j=0; $j < $columns; $j++) { 
                array_push($myRowArray, $symbols[rand(0, $columns - 1)]);
            }
            array_push($reel, $myRowArray);
        }
        return $reel;
    }

}
