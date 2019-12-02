<?php
namespace common\modules\chat\widgets;


use Yii;
use common\modules\chat\assets\ChatAsset;

class Chat extends \yii\bootstrap\Widget
{
    public $port = 8000;
    
    public function init()
    {
        ChatAsset::register($this->view);
        $this->view->registerJsVar('wsPort', $this->port);
    }
    
    public function run()
    {
        return $this->render('chat');
    }
}
