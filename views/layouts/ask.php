<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">

    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Задать анонимный вопрос"/>
    <meta property="og:description" content="Здесь можно задать анонимный вопрос Дмитрию Салихов"/>
    <meta property="og:image" content="https://ask.saldim.ru/img/og_ex.jpg" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="675" />
    <meta property="og:url" content="http://ask.saldim.ru/"/>
    <meta property="og:site_name" content="Задать анонимный вопрос"/>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter50112904 = new Ya.Metrika2({
                        id:50112904,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/tag.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks2");
    </script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function(){
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#1d8a8a"
                    },
                    "button": {
                        "background": "#62ffaa"
                    }
                },
                "theme": "classic",
                "position": "bottom-right",
                "content": {
                    "message": "Наш сайт использует файлы cookies для того, чтобы вы могли получить наилучшие впечатления",
                    "dismiss": "Понятно",
                    "link": "Подробнее",
                    "href": "/privacy"
                }
            })});
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/50112904" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->


</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
 <?php
    NavBar::begin([
        'brandLabel' => 'ask.saldim.ru',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
 echo Nav::widget([
     'options' => ['class' => 'navbar-nav navbar-right'],
     'items' => [
         //['label' => 'О сервисе', 'url' => ["/site/about"]],
         ['label' => 'На основной сайт >', 'url' => ["/site/saldim"]],
     ],
 ]);
 if (!Yii::$app->user->isGuest){
     echo Nav::widget([
         'options' => ['class' => 'navbar-nav navbar-right'],
         'items' => [
             Yii::$app->user->isGuest ? (
             ['label' => 'Вход', 'url' => ['/site/login']]
             ) : (
                 '<li>'
                 . Html::beginForm(['/site/logout'], 'post')
                 . Html::submitButton(
                     'Выход (' . Yii::$app->user->identity->username . ')',
                     ['class' => 'btn btn-link logout']
                 )
                 . Html::endForm()
                 . '</li>'
             )
         ],
     ]);
     echo Nav::widget([
         'options' => ['class' => 'navbar-nav navbar-right'],
         'items' => [
             ['label' => 'Админка', 'url' => ["/admin\/"]],
         ],
     ]);
 }
 NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
