<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Flyers $model */

$this->title = 'Update Flyers: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Flyers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="flyers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
