<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\WorkExperience $model */

$this->title = 'Create Work Experience';
$this->params['breadcrumbs'][] = ['label' => 'Work Experiences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-experience-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
