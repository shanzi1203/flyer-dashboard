<?php
use yii\helpers\Html;
?>
<h1><?= Html::encode($flyer->title) ?></h1>
<p><strong>Start:</strong> <?= $flyer->start_date ?></p>
<p><strong>End:</strong> <?= $flyer->end_date ?></p>
<p><strong>Status:</strong> <?= $flyer->statusText ?></p>
<p><strong>Locations:</strong> <?= implode(', ', \yii\helpers\ArrayHelper::getColumn($flyer->locations, 'name')) ?></p>
<p><strong>Products:</strong> <?= $flyer->productCount ?></p>
<?php if ($flyer->image_path): ?>
    <img src="<?= Yii::getAlias('@frontend/web') . $flyer->image_path ?>" style="width:300px;">
<?php endif; ?>
