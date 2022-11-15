<?php

use app\models\Education;
use app\models\WorkExperience;
use yii\helpers\Html;


$this->title = 'Update Cv: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cv-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsEducation' => (empty($modelsEducation)) ? [new Education] : $modelsEducation,
        'modelsWorkExperience' => (empty($modelsWorkExperience)) ? [new WorkExperience] : $modelsWorkExperience,
    ]) ?>

</div>
