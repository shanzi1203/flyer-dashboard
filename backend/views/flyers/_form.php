<?php

use common\models\Flyers;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Locations;
use common\models\Products;

/** @var yii\web\View $this */
/** @var common\models\Flyers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="flyers-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_date')->input('date') ?>

    <?= $form->field($model, 'end_date')->input('date') ?>

    <?= $form->field($model, 'uploadFile')->fileInput() ?>

    <?= $form->field($model, 'locationIds')->dropDownList(
        ArrayHelper::map(Locations::find()->all(), 'id', 'name'),
        [
            'multiple' => true,
            'size' => 6, 
            'class' => 'form-control',
        ]
    ) ?>


    <?= $form->field($model, 'productIds')->dropDownList(
        ArrayHelper::map(Products::find()->all(), 'id', 'name'),
        [
            'multiple' => true,
            'size' => 6,
            'class' => 'form-control',
        ]
    ) ?>


    <?= $form->field($model, 'status')->dropDownList(Flyers::getStatusList()) ?>

    <?= $form->field($model, 'page_count')->textInput(['type' => 'number', 'min' => 1]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>