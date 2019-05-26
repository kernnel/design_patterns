<?php

// head first design pattern

// 观察三个气象测量数据（温度、湿度、气压）

class Weather implements SplSubject{
    public $temperature;
    public $humidity;
    public $pressure;

    public $observers = [];
    
    // 把观察对象添加进去
    public function attach(SplObserver $observer){
        return array_push($this->observers,$observer);
    }

    public function detach(SplObserver $observer){
        // 删除观察对象
        $key = array_search($observer,$this->observers,true);

        if(false !== $key){
            unset($this->observers[$key]);
            return true;
        }
        
        return false;
    }

    public function notify(){
        if(!empty($this->observers)){
            foreach($this->observers as $key => $observer){
                $observer->update($this);
            }
        }
    }

    public function register($temperature,$humidity,$pressure){
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;

        $reg_result = true;
        if($reg_result){
            $this->notify();
            return true;
        }

        return false;
    }
}


class temperatureObserver implements SplObserver{
    public function update(SplSubject $subject){
        echo "温度：".$subject->temperature.PHP_EOL;
    }
}

class humidityObserver implements SplObserver{
    public function update(SplSubject $subject){
        echo "湿度：".$subject->humidity.PHP_EOL;
    }
}

class pressureObserver implements SplObserver{
    public function update(SplSubject $subject){
        echo "气压：".$subject->pressure.PHP_EOL;
    }
}



$weather = new Weather();

$weather->attach(new temperatureObserver());
$weather->attach(new humidityObserver());
$weather->attach(new pressureObserver());


$weather->register('40°','65','↓');