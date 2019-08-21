<?php

namespace nemozar\yii2ActionLog;

class Module extends \yii\base\Module
{
    /**
     * @var set user model in web.php for search
     */
    public $userModel;

    public $modelUserName;

    public function init()
    {
        parent::init();
    }
}
