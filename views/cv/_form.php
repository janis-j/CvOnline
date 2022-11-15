<?php

use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="cv-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, "country")->dropDownList(Yii::$app->params['country'], ['prompt' => '']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'skills')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'languages')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'github')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'interests')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, 'about')->textInput(['maxlength' => true]) ?>
    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper1',
        'widgetBody' => '.container-items',
        'widgetItem' => '.item1',
        'limit' => 20,
        'min' => 0,
        'insertButton' => '.add-item1',
        'deleteButton' => '.remove-item1',
        'model' => $modelsWorkExperience[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'company_name',
            'job_title',
            'from_date',
            'to_date',
            'description',
            'hours'
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-briefcase"></i> Work experience
            <button type="button" class="pull-right add-item1 btn btn-success btn-xs"><i class="fa fa-plus"></i> Add
                Work experience
            </button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items">
            <?php foreach ($modelsWorkExperience as $index => $modelWorkExperience): ?>
                <div class="item1 panel panel-default">
                    <div class="panel-heading">
                        <span class="panel-title-address">Work experience: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item1 btn btn-danger btn-xs"><i
                                    class="fa fa-minus"></i> Remove
                        </button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                        if (!$modelWorkExperience->isNewRecord) {
                            echo Html::activeHiddenInput($modelWorkExperience, "[{$index}]id");
                        }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelWorkExperience, "[{$index}]company_name")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelWorkExperience, "[{$index}]job_title")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelWorkExperience, "[{$index}]from_date")->input('date') ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelWorkExperience, "[{$index}]to_date")->input('date') ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelWorkExperience, "[{$index}]hours")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <?= $form->field($modelWorkExperience, "[{$index}]description")->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.item',
        'limit' => 20,
        'min' => 0,
        'insertButton' => '.add-item',
        'deleteButton' => '.remove-item',
        'model' => $modelsEducation[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'facility_name',
            'education',
            'start_date',
            'end_date',
            'description'
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Education
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add
                Education
            </button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items">
            <?php foreach ($modelsEducation as $index => $modelEducation): ?>
                <div class="item panel panel-default">
                    <div class="panel-heading">
                        <span class="panel-title-address">Education: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i
                                    class="fa fa-minus"></i> Remove
                        </button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                        if (!$modelEducation->isNewRecord) {
                            echo Html::activeHiddenInput($modelEducation, "[{$index}]id");
                        }
                        ?>
                        <?= $form->field($modelEducation, "[{$index}]facility_name")->textInput(['maxlength' => true]) ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelEducation, "[{$index}]education")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelEducation, "[{$index}]start_date")->input('date') ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelEducation, "[{$index}]end_date")->input('date') ?>
                            </div>
                        </div>
                        <?= $form->field($modelEducation, "[{$index}]description")->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton($modelEducation->isNewRecord || $modelWorkExperience->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
