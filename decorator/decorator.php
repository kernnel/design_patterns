<?php
/**
 * 装饰器模式
 */

/**
 * Interface IComponent 组件对象接口
 */
interface IComponent
{
    public function display();
}

/**
 * Class Person 待装饰对象
 */
class Person implements IComponent{
    private $_name;

    /**
     * Person constructor. 构造方法
     *
     * @param $name 对象人物名称
     */
    public function __construct($name)
    {
        $this->_name = $name;
    }

    /**
     * 实现接口方法
     */
    public function display()
    {
        echo "装扮者：{$this->_name}<br/>";
    }
}

/**
 * Class Clothes 所有装饰器父类-服装类
 */
class Clothes implements IComponent
{
    protected $component;

    /**
     * 接收装饰对象
     *
     * @param IComponent $component
     */
    public function decorate(IComponent $component)
    {
        $this->component = $component;
    }

    /**
     * 输出
     */
    public function display()
    {
        if(!empty($this->component))
        {
            $this->component->display();
        }
    }

}


/**
 * 下面为具体装饰器类
 */

/**
 * Class Sneaker 运动鞋
 */
class Sneaker extends Clothes
{
    public function display()
    {
        echo "运动鞋  ";
        parent::display();
    }
}

/**
 * Class Tshirt T恤
 */
class Tshirt extends Clothes
{
    public function display()
    {
        echo "T恤  ";
        parent::display();
    }
}

/**
 * Class Coat 外套
 */
class Coat extends Clothes
{
    public function display()
    {
        echo "外套  ";
        parent::display();
    }
}

/**
 * Class Trousers 裤子
 */
class Trousers extends Clothes
{
    public function display()
    {
        echo "裤子  ";
        parent::display();
    }
}


/**
 * 客户端测试代码
 */
class Client
{
    public static function test()
    {
        $zhangsan = new Person('张三');
        $lisi     = new Person('李四');

        $sneaker  = new Sneaker();
        $coat     = new Coat();

        $sneaker->decorate($zhangsan);
        $coat->decorate($sneaker);
        $coat->display();

        echo "<hr/>";

        $trousers = new Trousers();
        $tshirt   = new Tshirt();

        $trousers->decorate($lisi);
        $tshirt->decorate($trousers);
        $tshirt->display();
    }
}

Client::test();