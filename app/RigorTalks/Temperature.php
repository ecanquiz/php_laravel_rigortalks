<?php

namespace App\RigorTalks;

use App\Exceptions\TemperatureNegativeException;

class Temperature
{
    private $measure;
    
    public function __construct(int $measure)
    {
        $this->checkMeasureIsPositive($measure);      
        
        $this->measure = $measure;
    }
    
    public function measure(): int
    {
        return $this->measure;
    }
    
    /**
     * @param int $measure
     * @throw TemperatureNegativeException
     */
    private function checkMeasureIsPositive($measure):void
    {
        if ($measure < 0) {
            throw new TemperatureNegativeException("Measure should be positive");
        }  
    }
}
