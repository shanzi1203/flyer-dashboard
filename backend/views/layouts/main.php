<?php

use backend\assets\DashboardAsset;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

DashboardAsset::register($this);
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

<body class="hold-transition sidebar-mini layout-fixed">
    <?php $this->beginBody() ?>

    <div class="wrapper">

        <?= $this->render('_navbar') ?>
        <?= $this->render('_sidebar') ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Page header -->
            <section class="content-header">
                <div class="container-fluid">
                    <?= Breadcrumbs::widget([
                        'links' => $this->params['breadcrumbs'] ?? [],
                        'options' => ['class' => 'breadcrumb float-sm-right'],
                        'itemTemplate' => "<li class=\"breadcrumb-item\">{link}</li>\n",
                        'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n",
                        'homeLink' => [
                            'label' => 'Home',
                            'url' => Yii::$app->homeUrl,
                        ],
                    ]) ?>

                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Flash messages (Bootstrap style) -->
                    <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
                        <div class="alert alert-<?= $type ?> alert-dismissible fade show" role="alert">
                            <?= $message ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endforeach; ?>

                    <?= $content ?>
                </div>
            </section>
        </div>

        <?= $this->render('_footer') ?>

    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>