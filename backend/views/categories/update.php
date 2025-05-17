<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Categories $model */

$this->title = 'Update Categories: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categories-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
