<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\RigorTalks\Temperature;

class TemperatureTest extends TestCase
{

    /**
    * @test
    */
    public function tryToCreateAValidTemperatureWithNamedConstructor()
    {
        $measure = 18;        
        $this->assertSame(
            $measure,
            (Temperature::take($measure))->measure()
        );
    }
    
    /**
     * @test
     * @expectedException \App\Exceptions\TemperatureNegativeException     
     */
    public function tryToCreateANonValidTemperature()
    {   
        $this->expectException(\App\Exceptions\TemperatureNegativeException::class);  
	Temperature::take(-1);     
    }
  
    /**
    * @test
    */
    public function tryToCreateAValidTemperature()
    {
        $measure = 18;        
        $this->assertSame(
            $measure,
            (Temperature::take($measure))->measure()
        );
    }
}
