<?php
/**
 * 命令模式
 */

/**
 * Interface IComponent 组件对象接口
 */

interface Command {
    public function execute();
}
interface ListCommand extends  Command
{
    public function remove(Command $command);
    public function add(Command $command);
}

/**
 * Class Person 
 */
class MacroCommand implements ListCommand{
    private $_commandList;
 
    public function __construct() {
        $this->_commandList = [];
    }
 
    public function remove(Command $command)
    {
        $key = array_search($command,$this->_commandList);
        if($key == false){
            return FALSE;
        }
        echo "移除".$command->name."\n";
        unset($this->_commandList[$key]);
        return TRUE;
    }

    public function add(Command $command){
        echo "点份".$command->name."\n";
        return $this->_commandList[] = $command;
    }

    public function execute() {
        echo "确定下单\n";
        foreach ($this->_commandList as $command) {
            $command->execute();
        }
    }
}

/**
 * 命令
 */
class BakeMutton implements Command {
 
    private $_barbecuer;
    public $name;
 
    public function __construct(Barbecuer $barbecuer) {
        $this->_barbecuer = $barbecuer;
        $this->name = __CLASS__;
    }
    public function execute() {
        $this->_barbecuer->bakeMutton();
    }
}
class BakeChicken implements Command {
 
    private $_barbecuer;
    public $name;
 
    public function __construct(Barbecuer $barbecuer) {
        $this->_barbecuer = $barbecuer;
        $this->name = __CLASS__;
    }
    public function execute() {
        $this->_barbecuer->bakeChicken();
    }
}
class BakeChickenWing implements Command {
 
    private $_barbecuer;
    public $name;
 
    public function __construct(Barbecuer $barbecuer) {
        $this->_barbecuer = $barbecuer;
        $this->name = __CLASS__;
    }
    public function execute() {
        $this->_barbecuer->bakeChickenWing();
    }
}
 /**
 * 烧烤厨师
 */
class Barbecuer {
 
    private $_name;
 
    public function __construct($name) {
        $this->_name = $name;
    }
 
    public function bakeMutton() {
        echo $this->_name . "开始烤羊肉.\n";
    }
    public function bakeChicken() {
        echo $this->_name . "开始烤鸡肉.\n";
    }
    public function bakeChickenWing() {
        echo $this->_name . "开始烤鸡翅膀.\n";
    }
}
 /**
 * 服务员
 */
class Waiter {
 
    private $_command;
 
    public function __construct(Command $command) {
        $this->_command = $command;
    }
 
    public function action() {
        $this->_command->execute();
    }
}
 /**
 * Main
 */
class Main {
    public static function run() {
        $barbecuer = new Barbecuer('烧烤厨师');
 
        $bakeMutton = new BakeMutton($barbecuer);
        $bakeChicken = new BakeChicken($barbecuer);
        $bakeChickenWing = new BakeChickenWing($barbecuer);
 
        $macroCommand = new MacroCommand();
        $macroCommand->add($bakeMutton);
        $macroCommand->add($bakeChicken);
        $macroCommand->add($bakeChickenWing);
 
        $waiter = new Waiter($macroCommand);
 
        $macroCommand->remove($bakeMutton);
 
        $waiter = new Waiter($macroCommand);
        $waiter->action();
    }
}
 
Main::run();