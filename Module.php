<?php

namespace nemozar\yii2ActionLog;

class Module extends \yii\base\Module
{
    /**
     * @var string set user model in web.php for search
     */
    public $userModel;

    /**
     * @var string name field in model {$userModel} who showed at info table
     */
    public $modelUserName;

    /**
     * @var bool enabled save log in table
     */
    public $enabled;

    public function init()
    {
        parent::init();
    }
}
