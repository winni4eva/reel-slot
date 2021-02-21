<?php

namespace App\Http\Controllers;

use App\Services\Payline;

class PaylineService
{   
    public function __construct()
    {
        //
    }

    public function detectPayLine(array $reels, array $symbolIds, $columns = 5, $rows = 3) 
    {
        $symblosCount = count($symbolIds);
        
        for ($i=0; $i < $symblosCount; $i++) { 
            $currentSymbol = $symbolIds[$i];
            if ($this->allRowsMatchSymbol($reels, $currentSymbol, $columns, $rows)) {
                return true;
            }
            if ($this->diagonalArrowRowsMatchSymbol($reels, $currentSymbol, $columns, $rows)) {
                return true;
            }
            if ($this->diagonalArrowRowsMatchSymbol($reels, $currentSymbol, $columns, $rows, 'up')) {
                return true;
            }
            if ($this->symbolsFormAnUmbrellaShape($reels, $currentSymbol, $columns, $rows)) {
                return true;
            }
            if ($this->symbolsFormAnUmbrellaShape($reels, $currentSymbol, $columns, $rows, 'up')) {
                return true;
            }
        }
        return false;
    }

    protected function allRowsMatchSymbol($reels, $symbolId, $columns, $rows) {
        $rowCount = count($rows);
        $columnCount = count($columns);
        for ($i=0; $i < $rowCount; $i++) { 
            $matchedSymbols = [];
            for ($j=0; $j < $columnCount; $j++) { 
                if ($reels[$i][$j]['id'] == $symbolId) {
                    array_push($matchedSymbols, $symbolId);
                }
            }
            if (count($matchedSymbols) == $columnCount) {
                return true;
            }
        }
        return false;
    }

    protected function diagonalArrowRowsMatchSymbol($reels, $symbolId, $columns, $rows, $arrowPosition = 'bottom') {
        $rowCount = count($rows);
        $leftDiagonal = [];
        $rightDiagonal = [];
        if (strtolower($arrowPosition) === 'up') {
            $reels = array_reverse($reels);
            //$reels = collect($reels)->reverse()->all();
        }

        for ($i=0; $i < $rowCount; $i++) {
            $colIndex = 0;
            array_push($leftDiagonal, $reels[$i][$colIndex]);
            array_push($rightDiagonal, $reels[$i][($columns-($i+1))]);
            $colIndex = $colIndex + 1;
        }

        $allIdsMatched = collect($leftDiagonal)
            ->merge($rightDiagonal)
            ->every(function ($id, $key) use($symbolId) {
            return $id == $symbolId;
        });

        if ($allIdsMatched) {
            return true;
        }

        return false;
    }

    protected function symbolsFormAnUmbrellaShape($reels, $symbolId, $columns, $rows, $arrowPosition = 'bottom') 
    {
        $rowCount = count($rows) - 1;
        $matchedSymbols = [];
        $columnCount = $columns - 1;
        if (strtolower($arrowPosition) === 'up') {
            $reels = array_reverse($reels);
            //$reels = collect($reels)->reverse()->all();
        }

        for ($i=0; $i < $rowCount; $i++) {
            $colIndex = 0;
            if ($i == 0) {
                $firstSymbol = $reels[$i][$colIndex];
                $lastSymbol = $reels[$i][$columnCount];
                array_push($matchedSymbols, $firstSymbol);
                array_push($matchedSymbols, $lastSymbol);
            } else {
                $row = $reels[$i];
                unset($row[$colIndex]);
                unset($row[$columnCount]);
                array_merge($matchedSymbols, $row);
            }
        }

        $allIdsMatched = collect($matchedSymbols)
            ->every(function ($id, $key) use($symbolId) {
            return $id == $symbolId;
        });

        if ($allIdsMatched) {
            return true;
        }

        return false;
    }

    protected function symbolsFormAZeeShape($reels, $symbolId, $columns, $rows, $arrowPosition = 'bottom') 
    {
        $rowCount = count($rows) - 1;
        $matchedSymbols = [];
        $columnCount = $columns - 1;
        if (strtolower($arrowPosition) === 'up') {
            $reels = array_reverse($reels);
            //$reels = collect($reels)->reverse()->all();
        }

        for ($i=0; $i < $rowCount; $i++) {
            switch ($i) {
                case 0:
                    [$firstSymbol, $secondSymbol] = $reels[$i];
                    array_merge($matchedSymbols, [$firstSymbol, $secondSymbol]);
                    break;
                case 1:
                    array_push($matchedSymbols, $reels[$i][2]);
                    break;
                case 2:
                    [,,,$fourthSymbol, $fifthSymbol] = $reels[$i];
                    array_merge($matchedSymbols, [$fourthSymbol, $fifthSymbol]);
                    break;
                default:
                    continue;
                    break;
            }
        }

        $allIdsMatched = collect($matchedSymbols)
            ->every(function ($id, $key) use($symbolId) {
            return $id == $symbolId;
        });

        if ($allIdsMatched) {
            return true;
        }

        return false;
    }

}
