<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
?>

<h2>Compare Flyers</h2>

<?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['compare']]); ?>
    <?= Html::hiddenInput('id', $flyer1->id) ?>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">Compare With:</label>
        <div class="col-sm-6">
            <?= Html::dropDownList('with', Yii::$app->request->get('with'), ArrayHelper::map($flyerOptions, 'id', 'title'), [
                'class' => 'form-control',
                'prompt' => 'Select flyer to compare',
                'onchange' => 'this.form.submit()'
            ]) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

<div class="row mt-4">
    <?php foreach ([$flyer1, $flyer2] as $flyer): ?>
        <?php if ($flyer): ?>
        <div class="col-md-6">
            <div class="card border">
                <div class="card-header bg-dark text-white text-center"><?= Html::encode($flyer->title) ?></div>
                <div class="card-body">
                    <p><strong>Status:</strong> <?= $flyer->statusText ?></p>
                    <p><strong>Date:</strong> <?= $flyer->start_date ?> - <?= $flyer->end_date ?></p>
                    <p><strong>Location(s):</strong> <?= implode(', ', ArrayHelper::getColumn($flyer->locations, 'name')) ?></p>
                    <p><strong>Products:</strong> <?= $flyer->productCount ?></p>
                    <p><strong>Pages:</strong> <?= $flyer->page_count ?></p>
                    <?php if ($flyer->image_path): ?>
                        <img src="<?= Yii::getAlias('@web') . $flyer->image_path ?>" class="img-fluid mt-2">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
