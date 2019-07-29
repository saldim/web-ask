<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Questions */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Вопросы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (!isset($model->answers->answer)){
        echo Html::a('Ответить', ['answers/create', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        else{
            echo Html::a('Перейти к ответу', ['answers/view', 'id' => $model->answers->id], ['class' => 'btn btn-primary']);
        }

?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Точно?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'email:email',
            'ip',
            'answers.answer',
            'date',
        ],
    ]) ?>

</div>
