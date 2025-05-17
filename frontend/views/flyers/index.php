<?php

use common\models\Flyers;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;

$this->title = 'Flyers';
?>

<h2 class="mb-4">Flyer Archive</h2>

<div class="card p-4 mb-4 shadow-sm">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'options' => ['class' => 'row g-3 align-items-end']
    ]); ?>

    <div class="col-md-4">
        <?= $form->field($searchModel, 'title')->textInput([
            'placeholder' => 'Search by Title',
        ])->label('Title') ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($searchModel, 'start_date')->input('date')->label('Start Date') ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($searchModel, 'end_date')->input('date')->label('End Date') ?>
    </div>

    <div class="col-md-2 text-end">
        <div class="form-group d-grid gap-2">
            <?= Html::submitButton('Filter', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<div class="row">
    <?php foreach ($dataProvider->getModels() as $flyer): ?>
     <div class="col-md-3 mb-4">
    <!-- Card with image+badge wrapper -->
    <div class="card h-100 border shadow-sm">

        <div class="position-relative">
            <?php if ($flyer->status === Flyers::STATUS_EXPIRED): ?>
                <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px; z-index: 10;">Expired</span>
            <?php elseif ($flyer->status === Flyers::STATUS_ACTIVE): ?>
                <span class="badge badge-success position-absolute" style="top: 10px; right: 10px; z-index: 10;">Active</span>
            <?php endif; ?>

            <?php if ($flyer->image_path): ?>
                <img src="<?= Yii::getAlias('@web') . $flyer->image_path ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
            <?php else: ?>
                <div class="card-img-top bg-secondary text-white text-center d-flex align-items-center justify-content-center" style="height: 200px;">
                    <span>No Image</span>
                </div>
            <?php endif; ?>
        </div>

        <div class="card-header text-white text-center" style="background-color: #6f42c1;">
            <strong><?= Html::encode($flyer->title) ?></strong>
        </div>

        <div class="card-body small">
            <p class="mb-1"><strong>🗓</strong> <?= Html::encode($flyer->start_date) ?> - <?= Html::encode($flyer->end_date) ?></p>
            <p class="mb-1"><strong>📍</strong> <?= Html::encode(implode(', ', ArrayHelper::getColumn($flyer->locations, 'name'))) ?></p>
            <p class="mb-1"><strong>📦</strong> <?= Html::encode($flyer->productCount) ?> Products</p>
            <p class="mb-3"><strong>📄</strong> <?= Html::encode($flyer->page_count) ?> Pages</p>

            <div class="d-flex justify-content-between">
                <?= Html::a('View', ['view', 'id' => $flyer->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                <?= Html::a('Download', ['download', 'id' => $flyer->id], ['class' => 'btn btn-sm btn-outline-secondary']) ?>
                <?= Html::a('Compare', ['compare', 'id' => $flyer->id], ['class' => 'btn btn-sm btn-outline-info']) ?>
            </div>
        </div>
    </div>
</div>

    <?php endforeach; ?>
</div>

<!-- Count Summary -->
<p class="text-muted text-center">
    Showing <?= $dataProvider->pagination->offset + 1 ?> -
    <?= min($dataProvider->pagination->offset + $dataProvider->pagination->limit, $dataProvider->totalCount) ?> of
    <?= $dataProvider->totalCount ?> flyers
</p>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $dataProvider->pagination,
        'options' => ['class' => 'pagination'],
        'linkOptions' => ['class' => 'page-link'],
        'disabledPageCssClass' => 'disabled',
        'activePageCssClass' => 'active',
        'prevPageLabel' => '«',
        'nextPageLabel' => '»',
    ]) ?>
</div>
