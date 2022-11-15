<?php

use app\models\Education;
use app\models\WorkExperience;
use yii\helpers\Html;

$this->title = 'Create Cv';
$this->params['breadcrumbs'][] = ['label' => 'Cvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cv-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsEducation' => (empty($modelsEducation)) ? [new Education] : $modelsEducation,
        'modelsWorkExperience' => (empty($modelsWorkExperience)) ? [new WorkExperience] : $modelsWorkExperience,
    ]) ?>

</div>
