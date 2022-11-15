<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CvSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cv-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'skills') ?>

    <?php // echo $form->field($model, 'languages') ?>

    <?php // echo $form->field($model, 'interests') ?>

    <?php // echo $form->field($model, 'about') ?>

    <?php // echo $form->field($model, 'github') ?>

    <?php // echo $form->field($model, 'linkedin') ?>

    <?php // echo $form->field($model, 'website') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
