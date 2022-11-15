<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\WorkExperienceSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="work-experience-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cv_id') ?>

    <?= $form->field($model, 'company_name') ?>

    <?= $form->field($model, 'job_title') ?>

    <?= $form->field($model, 'from_date') ?>

    <?php // echo $form->field($model, 'to_date') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'hours') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
