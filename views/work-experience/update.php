<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\WorkExperience $model */

$this->title = 'Update Work Experience: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Work Experiences', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="work-experience-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
