<?php

namespace App\RigorTalks;

use App\Exceptions\TemperatureNegativeException;

class Temperature
{
    private $measure;
    
    public function __construct(int $measure)
    {        
        if ($measure >= 0) {
            $this->measure = $measure;
        } else {
            throw new TemperatureNegativeException("Measure should be positive");
        }
    }
    
    public function measure(): int
    {
        return $this->measure;
    }
}
