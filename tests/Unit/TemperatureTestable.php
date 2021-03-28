<?php

namespace Tests\Unit;

trait TemperatureTestable {

    public function getThreshold(): int
    {
        return 50;
    }

    public function sensor()
    {
        return $this;
    }
    
    public function temperature()
    {
        return $this;
    }
    
    public function measure()
    {
        return 50;
    }

}
