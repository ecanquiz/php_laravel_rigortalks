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
    use TemperatureTestable;

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
        $this->assertFalse(
	        TemperatureTestClass::take(10)->isSuperHot()
	    );
    }

    /**
     * @test
     */ 
    public function tryToCheckIfASuperHotTemperatureIsSuperHot()
    {
        $this->assertTrue(
	        TemperatureTestClass::take(100)->isSuperHot()
	    );
    }

    /**
     * @test
     */ 
    public function tryToCheckIfASuperColdTemperatureIsSuperiCold()
    {
        $this->assertTrue(
	        Temperature::take(10)->isSuperCold(
	            $this 
	        )
	    );
    }    
    
    /**
     * @test
     */ 
    public function tryToCheckIfASuperColdTemperatureIsSuperiColdWithAnomClass()
    {
        $this->assertTrue(
	        Temperature::take(10)->isSuperCold(
	            new class implements ColdThresholdSource {	            
	                public function getThreshold(): int // this method is in the trait 
                    {
                        return 50;
                    }
	            }
	        )
	    );
    }
    
    /**
     * @test
     */ 
    public function tryToCreateATemperatureFromStation()
    {        
        $this->assertSame(
            50,
            Temperature::fromStation(
                $this // these method is in the trait
            )->measure()
        );     
    }
    
}
