<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Answers */
/* @var $form yii\widgets\ActiveForm */
$param = ['options' =>[ Yii::$app->request->get('id') => ['Selected' => true]]];
?>

<div class="answers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'answer')->textarea(['rows' => 6])->label('Ответ')?>

    <?= $form->field($model, 'questionId')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Questions::find()->all(),'id','name'),$param)->label('Вопрос') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
