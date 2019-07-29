<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Answers */

$this->title = 'Ответить';
$this->params['breadcrumbs'][] = ['label' => 'Ответы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
