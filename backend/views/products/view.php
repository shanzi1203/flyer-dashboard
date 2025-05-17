<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Products $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'price',
             [
                'label' => 'Categories',
                'value' => function ($model) {
                    return implode(', ', \yii\helpers\ArrayHelper::getColumn($model->categories, 'name'));
                },
            ],
            
        ],
    ]) ?>

</div>
