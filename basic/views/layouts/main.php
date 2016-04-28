<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Retain',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'items' => [
//            ['label' => 'Tags editor', 'url' => ['/tags']],
//            ['label' => 'Results Archive', 'url' => ['/documents']],
//            ['label' => 'Profile', 'url' => ['/users/updateprofile']],
//
//        ],
//    ]);

    $navItems=[
        ['label' => 'Projects', 'url' => ['/projects'], 'visible' =>  !Yii::$app->user->isGuest],
        ['label' => 'Tags', 'url' => ['/tags'], 'visible' =>  !Yii::$app->user->isGuest],
        ['label' => 'Results Archive', 'url' => ['/documents'] , 'visible' =>  !Yii::$app->user->isGuest],
        ['label' => 'Profile', 'url' => ['/auth/profile/view'] , 'visible' =>  !Yii::$app->user->isGuest],
        ['label' => 'Users', 'url' => ['/auth/user'] , 'visible' =>  Yii::$app->user->getIsSuperAdmin()],
    ];
    if (Yii::$app->user->isGuest) {
        array_push($navItems,['label' => 'Sign In', 'url' => ['/auth/default/login']],['label' => 'Sign Up', 'url' => ['/auth/default/signup']]);
    } else {
        array_push($navItems,['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/auth/default/logout'],
                'linkOptions' => ['data-method' => 'post']]
        );
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $navItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Retain            <?= date('Y') ?></p>

        <p class="pull-right">Disk Free Space: <b><?= \app\helpers\AppHelper::getFreeSpace(); ?></b></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
