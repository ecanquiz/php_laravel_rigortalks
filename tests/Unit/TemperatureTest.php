<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\RigorTalks\{Temperature, TemperatureTestClass};

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

}
