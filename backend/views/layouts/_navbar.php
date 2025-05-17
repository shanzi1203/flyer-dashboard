<?php
use yii\helpers\Html;
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <?= Html::a('Home', ['/site/index'], ['class' => 'nav-link']) ?>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <?= Html::beginForm(['/site/logout'], 'post')
          . Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn nav-link'])
          . Html::endForm() ?>
    </li>
  </ul>
</nav>
