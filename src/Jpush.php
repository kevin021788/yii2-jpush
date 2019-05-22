<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/22
 * Time: 16:37
 */

namespace push\Jpush;

use \Yii;
use \yii\base\Component;
use \yii\base\InvalidConfigException;

class Jpush extends Component
{
    public $app_key;
    public $app_secret;

    private $jpush;

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        dd($this);
        if(empty($this->app_key) || empty($this->app_secret)) {
            throw new InvalidConfigException("app_key和app_secret必须设置");
        }
        $this->jpush = new \JPush($this->app_key, $this->app_secret);
    }

    public function __call($method, $args = [])
    {
        return call_user_func_array(array($this->jpush, $method), $args);
    }
}