<?php

use common\models\Flyers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var backend\models\FlyersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Flyers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flyers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Create Flyer', [
            'data-url' => Url::to(['create']),
            'class' => 'btn btn-success modalButton',
        ]) ?>


        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',
                'start_date',
                'end_date',

                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return $model->statusText;
                    },
                    'format' => 'html',
                    'contentOptions' => ['class' => 'text-center'],
                ],

                'page_count',
                [
                    'label' => 'Locations',
                    'value' => function ($model) {
                        return implode(', ', \yii\helpers\ArrayHelper::getColumn($model->locations, 'name'));
                    },
                ],
                [
                    'label' => 'Products',
                    'value' => function ($model) {
                        return count($model->products);
                    },
                ],
                [
                    'attribute' => 'image_path',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->image_path
                            ? Html::a('Download', $model->imageUrl, ['target' => '_blank', 'download' => true])
                            : 'N/A';
                    },
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url) {
                            return Html::a('<i class="fas fa-eye"></i>', '#', [
                                'class' => 'btn btn-sm btn-outline-primary modalButton',
                                'data-url' => $url,
                                'title' => 'View',
                            ]);
                        },
                        'update' => function ($url) {
                            return Html::a('<i class="fas fa-edit"></i>', '#', [
                                'class' => 'btn btn-sm btn-outline-success modalButton',
                                'data-url' => $url,
                                'title' => 'Update',
                            ]);
                        },
                        'delete' => function ($url) {
                            return Html::a('<i class="fas fa-trash"></i>', $url, [
                                'class' => 'btn btn-sm btn-outline-danger',
                                'data-confirm' => 'Are you sure?',
                                'data-method' => 'post',
                                'title' => 'Delete',
                            ]);
                        },
                    ],
                ],

            ],
        ]); ?>


</div>
<!-- Modal -->
<div class="modal fade" id="flyerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Flyer</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="flyerModalContent">
                <!-- AJAX content loads here -->
            </div>
        </div>
    </div>
</div>



<?php
$script = <<<JS
$(document).on('click', '.modalButton', function (e) {
    e.preventDefault();
    var url = $(this).data('url') || $(this).attr('value');
    if (!url) return;

    $('#flyerModalContent').html('<p class="text-center p-3">Loading...</p>');
    $('#flyerModal').modal('show');

    // Load modal form and reinitialize Select2
    $.get(url, function(response) {
        $('#flyerModalContent').html(response);

        // Re-initialize all Select2s inside the modal
        $('#flyerModal .select2').select2({
            dropdownParent: $('#flyerModal')
        });
    });
});
JS;
$this->registerJs($script);



?>