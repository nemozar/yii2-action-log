<?php
namespace nemozar\yii2ActionLog\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "public.action_logs".
 *
 * @property int $id
 * @property string $time
 * @property string $url
 * @property string $post_data
 * @property int $id_user
 * @property string $controller
 * @property string $action
 * @property string $referer
 */
class ActionLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.action_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time'], 'safe'],
            [['url'], 'required'],
            [['url', 'post_data', 'controller', 'action', 'referer'], 'string'],
            [['id_user'], 'default', 'value' => null],
            [['id_user'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'url' => 'Url',
            'post_data' => 'Post Data',
            'id_user' => 'Id User',
            'controller' => 'Controller',
            'action' => 'Action',
            'referer' => 'Referer',
        ];
    }

    public function getControllerName()
    {
        return basename(str_replace('\\', '/', $this->controller));
    }

    static public function getControllerList()
    {
        $controllers = ActionLogs::find()->select('controller')->distinct()->all();
        return ArrayHelper::map($controllers, 'controller', 'controllerName');
    }

    static public function getActionList()
    {
        $controllers = ActionLogs::find()->select('action')->distinct()->all();
        return ArrayHelper::map($controllers, 'action', 'action');
    }
}
