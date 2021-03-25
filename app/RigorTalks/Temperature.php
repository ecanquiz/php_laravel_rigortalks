<?php

namespace App\RigorTalks;

use App\Exceptions\TemperatureNegativeException;
use App\RigorTalks\ColdThresholdSource;

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
   
    public function isSuperHot(): bool
    {
        $threshold = $this->getThreshold();

	    return $this->measure() > $threshold;
    }

    protected function getThreshold()
    {
        // It could also be
	// global $conn	    
        $conn = \Doctrine\DBAL\DriverManager::getConnection(array(
           'dbname' => 'mydb',
	   'user' => 'user',
	   'password' => 'secret',
	   'host' => 'localhost',
	   'driver' => 'pdo_mysql',
        ), new \Doctrine\DBAL\Configuration());
	
	return $conn->fetchColumn('SELECT hot_threshold FROM configuration');
    }

    public function isSuperCold(ColdThresholdSource $coldThresholdSource)    
    {
      $threshold = $coldThresholdSource->getThreshold();

      return $this->measure() < $threshold;
    }

}
