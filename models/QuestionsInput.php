<?php

namespace app\models;

class QuestionsInput extends Questions
{
    public $reCaptcha;

    public function rules()
    {
        if (YII_DEBUG) {
            return [
                [['name'], 'string'],
                [['email'], 'email'],
            ];
        } else {
            return [
                ['name', 'required'],
                [['name'], 'string', 'length' => [10, 180]],
                [['email'], 'email'],
                [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className()]
            ];
        }

    }
}