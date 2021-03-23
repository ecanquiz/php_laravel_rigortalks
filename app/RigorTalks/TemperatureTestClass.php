<?php

namespace App\RigorTalks;

class TemperatureTestClass extends Temperature
{

    protected function getThreshold()
    {	
	   return 50;   
    }

}
