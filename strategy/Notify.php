<?php 

// 定义飞行类，所有新的飞行类都必须实现fly()方法
interface Notify{
    public function send();
}


class Wechat implements Notify{
    public function send(){
        echo '微信模版消息';
    }
}

class email implements Notify{
    public function send(){
        echo 'Email';
    }
}

class site implements Notify{
    public function send(){
        echo '站内信';
    }
}


class SMS implements Notify{
    public function send(){
        echo '短信';
    }
}


class Template{
    private $_strategy;
    private $_isChange = false;

    /**
     * 构造方法
     * 辞职使用到了依赖注入和类型约束的概念
     */
    public function __construct(Notify $notify){
        $this->_strategy = $notify;
    }

    // 改变飞行
    public function change(Notify $notify){
        $this->_strategy = $notify;
        $this->_isChange = true;
    }

    
    public function sendMessage(){
        // var_dump($this->_strategy);exit;
        if($this->_isChange){
            echo 'change';
            $this->_strategy->send();
        }else{
            $this->_strategy->send();
        }
    }
}

// 调用
$strategy = new Template(new wechat());

//print_r($strategy->sendMessage());
// 发微信消息
$strategy->sendMessage();

// 发短信
$strategy->change(new SMS());
$strategy->sendMessage();

// 发邮件
$strategy->change(new email());
$strategy->sendMessage();