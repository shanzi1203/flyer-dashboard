<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/** @var common\models\Flyers $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Flyers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="flyer-view">
    <h2><?= Html::encode($model->title) ?></h2>

    <div class="card mb-4">
        <?php if ($model->image_path): ?>
            <img src="<?= Yii::getAlias('@web') . $model->image_path ?>" class="card-img-top" style="height:300px; object-fit:cover;" alt="Flyer Image">
        <?php endif; ?>

        <div class="card-body">
            <p><strong>Status:</strong> <?= Html::encode($model->statusText) ?></p>
            <p><strong>Duration:</strong> <?= Html::encode($model->start_date) ?> - <?= Html::encode($model->end_date) ?></p>
            <p><strong>Location:</strong> <?= Html::encode(implode(', ', ArrayHelper::getColumn($model->locations, 'name'))) ?></p>
            <p><strong>Product Count:</strong> <?= $model->productCount ?></p>
            <p><strong>Pages:</strong> <?=1 ?></p>

            <div class="btn-group mt-3">
                <?= Html::a('Download', ['download', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
                <?= Html::a('Compare', ['compare', 'id' => $model->id], ['class' => 'btn btn-outline-info']) ?>
                <?= Html::a('Back', ['index'], ['class' => 'btn btn-outline-dark']) ?>
            </div>
        </div>
    </div>

   
</div>
