<?php

namespace App\RigorTalks;

use App\Exceptions\TemperatureNegativeException;

class Temperature
{
    private $measure;
    
    private function __construct(int $measure)
    {
        $this->setMeasure($measure);
    }
    
    private function setMeasure(int $measure):void
    {
        $this->checkMeasureIsPositive($measure); 
        $this->measure = $measure;
    }
    
    /**
     * @param int $measure
     * @throw TemperatureNegativeException
     */
    private function checkMeasureIsPositive(int $measure):void
    {
        if ($measure < 0) {
            throw TemperatureNegativeException::fromMeasure($measure);
        }  
    }
    
    public static function take($measure): self
    {
        return new static($measure);
    }
    
    public function measure(): int
    {
        return $this->measure;
    }  
   


}
