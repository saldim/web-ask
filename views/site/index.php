<?php
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\helpers\Html;

$this->title = 'Задайте анонимный вопрос';
?>
<div id="intro">
    <h2>Задайте анонимный вопрос</h2> <h5>и вы получите ответ прямо на этой странице</h5>
</div>
    <div id="qthanks" class="hidden"><h2>Спасибо!</h2><h5> Ваш вопрос зарегистрирован. Посетите эту страницу через некоторое время, чтобы увидеть ответ.</h5><button id="showagain" class="btn btn-primary">Задать еще один вопрос</button> </div>
<div id="qwrap">
    <div id="qform">
<?php
$form=ActiveForm::begin();
echo $form->field($questions, 'name')->textarea(['style'=>'height:8em;resize:none;']);
echo "<div id=\"qcap\">";
echo $form->field($questions, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className())->label('');
echo "</div>";
//echo $form->field($questions, 'email')->textInput()->hint('Можно оставить пустым');
?>
<div id="qbtn"><input type="submit" id="qsubmit" class="btn btn-primary" value="Отправить"></div>
        <div id="qstate" class="hidden"><img src="/img/ldg.gif"></div>
</div></div>
<div id="awrap">
<?php
ActiveForm::end();
Pjax::begin(['enablePushState' => true,
    'timeout' => 5000,]);
echo Html::a("Обновить", ['site/index'], ['class' => 'hidden', 'id'=> 'refr']);
foreach ($models as $ans){

        echo "<hr>";
        $qname=$ans->question->name;
        echo "<div id=\"qtext\">$qname</div>";
        echo "<div id=\"atext\">$ans->answer</div>";
        $date = new DateTime($ans->question->date);
        $qdate=$date->format('d.m.Y');
        echo "<div id=\"qdate\">$qdate</div>";

}
echo LinkPager::widget([
    'pagination' => $pages,
]);
Pjax::end();
?>
</div>
    <div id="downcopy">&copy Дмитрий Салихов, <?= date('Y') ?><div id="rules">При использовании сайта вы выражаете согласие с <a href="/privacy" target="_blank">политикой конфиденциальности</a></div></div>
<?php
$autorefreshscript = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refr").click(); }, 20000);
});
JS;
//$this->registerJs($autorefreshscript);

$showagainscript = <<< JS
$( "#showagain" ).click(function() {
     $('#qthanks').css('opacity', '0');
     setTimeout(function () {
     $('#qthanks').addClass('hidden');
     $('#intro').removeClass('hidden');
     $('#qwrap').removeClass('hidden');
     $('#qsubmit').removeClass('hidden');
     $('#qthanks').css('opacity', '100');
     }, 1000);
});
JS;
$this->registerJs($showagainscript);


$js = <<<JS
 function ShowThanks(){
 $('#qwrap').addClass('hidden');
 $('#intro').addClass('hidden');
 $('#qthanks').css('opacity', '0');
 $('#qthanks').removeClass('hidden');
 $('#qthanks').css('padding-top', '120pt');
 setTimeout(function () {
 $('#qthanks').css('padding-top', '0pt');
 $('#qthanks').css('opacity', '100');
}, 5);
 }
 $('form').on('beforeSubmit', function(){
 $('#qsubmit').addClass('hidden');
 $('#qstate').removeClass('hidden');
 var data = $(this).serialize();
 $.ajax({
 url: '/',
 type: 'POST',
 data: data,
 success: function(res){
ShowThanks();
 $("#w0")[0].reset();
 $('#qstate').addClass('hidden');
 grecaptcha.reset();
 },
 error: function(){
 alert('Ошибка!');
 $('#qsubmit').removeClass('hidden');
  $('#qstate').addClass('hidden');
 }
 });
 return false;
 });
JS;

$this->registerJs($js);


