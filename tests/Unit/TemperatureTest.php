<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\RigorTalks\{
  ColdThresholdSource,
  Temperature,
  TemperatureTestClass
};

class TemperatureTest extends TestCase implements ColdThresholdSource
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

    /**
     * @test
     */ 
    public function tryToCheckIfAColdTemperatureIsSuperHot()
    {
        //$this->markTestSkipped();
        $this->assertFalse(
	        TemperatureTestClass::take(10)->isSuperHot()
	    );
    }

    /**
     * @test
     */ 
    public function tryToCheckIfASuperHotTemperatureIsSuperHot()
    {
        //$this->markTestSkipped();
        $this->assertTrue(
	        TemperatureTestClass::take(100)->isSuperHot()
	    );
    }

    /**
     * @test
     */ 
    public function tryToCheckIfASuperColdTemperatureIsSuperiCold()
    {
        //$this->markTestSkipped();
        $this->assertTrue(
	    Temperature::take(10)->isSuperCold(
	        $this 
	   )
	);
    }

    public function getThreshold(): int
    {
        return 50;
    }
    
}
