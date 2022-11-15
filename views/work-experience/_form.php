<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\WorkExperience $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="work-experience-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cv_id')->textInput() ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'from_date')->textInput() ?>

    <?= $form->field($model, 'to_date')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hours')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
