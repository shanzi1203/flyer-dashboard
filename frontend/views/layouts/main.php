<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

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

    <style>
        body {
            margin: 0;
        }
        .sidebar {
            background-color: #6f42c1;
            min-height: 100vh;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #59339c;
            text-decoration: none;
        }
        .main-content {
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .navbar {
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Top Navbar -->
<nav class="navbar navbar-light bg-white border-bottom px-4 d-flex justify-content-between align-items-center">
    <div>
        <h5 class="mb-0">Flyer Archive</h5>
    </div>
    <div>
        <?php if (!Yii::$app->user->isGuest): ?>
            <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline']) ?>
                <span class="mr-2">Logout (<?= Html::encode(Yii::$app->user->identity->username) ?>)</span>
                <?= Html::submitButton('Logout', ['class' => 'btn btn-sm btn-outline-danger']) ?>
            <?= Html::endForm() ?>
        <?php endif; ?>
    </div>
</nav>

<!-- Sidebar + Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <a href="<?= Yii::$app->homeUrl ?>">Dashboard</a>
                <a href="<?= \yii\helpers\Url::to(['flyers/index']) ?>">Flyer Archive</a>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 ml-sm-auto main-content">
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
            <?= $content ?>
        </main>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
