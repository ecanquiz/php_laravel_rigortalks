<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\RigorTalks\Temperature;

class TemperatureTest extends TestCase
{
    /**
     * @test
     * @expectedException \App\Exceptions\TemperatureNegativeException     
     */
    public function tryToCreateANonValidTemperature()
    {   
        $this->expectException(\App\Exceptions\TemperatureNegativeException::class);  
        new Temperature(-1);     
    }
  
    /**
    * @test
    */
    public function tryToCreateAValidTemperature()
    {
        $measure = 18;        
        $this->assertSame(
            $measure,
            (new Temperature($measure))->measure()
        );
    }
}
