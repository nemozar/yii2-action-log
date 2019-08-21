yii2-action-log
=========

Extension logged all request for controllers. Saved in database url, post data, user, referrer. There is a form for viewing and searching logs.


Config modules in web.php. 

userModel - model for show user name in report. 

modelUserName - field in model with user name. 

Enabled - if set false logs will be not saved in database.

```
'logs' => [
    'class' => 'nemozar\yii2ActionLog\Module',
    'userModel' => \komeks\yii2User\models\User::class,
    'modelUserName' => 'username',
    'enabled' => true
]
```

Up migrations

```
./yii migrate --migrationPath=@yii/rbac/migrations/ 
```

For saved logs add trair for need controllers:

```
class RatingController extends Controller
{
    use LogsTrait;

    ...
}
```

Url for form show `/logs/log/index`