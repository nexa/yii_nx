<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\utils\NxHelper;

class UserSign extends ActiveRecord {
    public $rememberMe = true;
    public $repassword;
    public $newpassword;
    public $renewpassword;

    public static function tableName() {
        return '{{%user_sign}}';
    }

    public function attributeLabels() {
        return [
            'name' => '用户名',
            'password' => '密码',
            'email' => '电子邮箱',
            'phone' => '手机号码',
            'openid' => 'OpenID',
            'repassword' => '确认密码',
            'newpassword' => '新密码',
            'renewpassword' => '确认新密码',
        ];
    }

    public function rules() {
        return [
            ['name', 'required', 'message' => '请输入用户名', 'on' => ['reg', 'login', 'seekpassword', 'mailchangepassword', 'changemail', 'changepassword']],
            ['name', 'unique', 'message' => '该用户名已经被注册', 'on' => ['reg']],
            ['phone', 'required', 'message' => '请输入手机号', 'on' => ['reg']],
            ['phone', 'unique', 'message' => '该手机号已经被注册', 'on' => ['reg']],
            ['phone', 'match', 'pattern' => '/^1[0-9]{10}$/', 'message' => '请输入有效的手机号','on' => ['reg']],
            ['password', 'required', 'message' => '请输入密码', 'on' => ['reg', 'login', 'mailchangepassword']],
            ['password', 'validatePassword', 'on' => 'login'],
           // ['email', 'required', 'message' => '请输入电子邮箱', 'on' => ['reg', 'seekpassword', 'changeemail']],
           // ['email', 'unique', 'message' => '该电子邮箱已经被占用', 'on' => ['reg']],
           // ['email', 'email', 'on' => ['reg', 'seekpassword', 'changeemail']],
           // ['email', 'validateEmail', 'on' => ['seekpassword']],
            ['repassword', 'required', 'message' => '请输入确认密码', 'on' => ['reg', 'mailchangepassword']],
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => '确认密码和密码不相同', 'on' => ['reg', 'mailchangepassword']],
            ['newpassword', 'required', 'message' => '请输入新密码', 'on' => ['changepassword']],
            ['renewpassword', 'compare', 'compareAttribute' => 'newpassword', 'message' => '确认新密码和新密码不相同', 'on' => ['changepassword']],
            ['rememberMe', 'boolean', 'on' => ['login']],
        ];
    }

    public function validatePassword () {
        if (!$this->hasErrors()) {
            $data = self::find()->where('name = :name and password = :password',
                [':name' => $this->name, ':password' => NxHelper::md5($this->password)])->one();
            if (is_null($data)) {
                $this->addError('password', '用户名或密码错误');
            }
        }       
    }

    public function validateEmail() {
        
    }

    public function createToken($name, $time) {
        return NxHelper::md5(NxHelper::md5($name).
            base64_encode(Yii::$app->request->userIP).NxHelper::md5($time));
    }

    public function reg($data) {
        $this->scenario = 'reg';
        if ($this->load($data) && $this->validate()) {
            $this->password = NxHelper::md5($this->password);
            if ($this->save(false))
                return true;
        }
        return false;
    }

    public function login($data) {
        $this->scenario = 'login';
        if ($this->load($data) && $this->validate()) {
            $lifetime = $this->rememberMe ? 3600 * 23 : 0;
            $session = Yii::$app->session;
            session_set_cookie_params($lifetime);
            $session['user'] = [
                'name' => $this->name,
                'isLogin' => 1,
            ];
            $this->updateAll(['logintime' => time(), 'loginip' => ip2long(Yii::$app->request->userIP)],
                'name = :name', [':name' => $this->name]);
            return (bool)$session['user']['isLogin'];
        }
        return false;
    }
}
