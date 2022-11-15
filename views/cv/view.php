<?php

use app\widgets\CvView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Cv $model */

$this->params['breadcrumbs'][] = ['label' => 'Cvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="cv-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    echo CvView::widget([
        'model' => $model,
        'attributes' => [
            'general-info' => [
                ['name'=>'',
                'surname'=>'',
                'about'=>'']
            ],
            'contacts' => [
                ['phone'=>'',
                'email'=>'',
                'website'=>'',
                'address'=>'',
                'country'=>'']
            ],
            'personal-statement' => [
                ['skills'=>'',
                'languages'=>'',
                'interests'=>'']
            ],
            'education' => [
                ['facility_name'=>'',
                'education'=>'',
                'start_date'=>'',
                'end_date'=>'',
                'description'=>'']
            ],
            'work-experience' => [
                ['company_name'=>'',
                'job_title'=>'',
                'from_date'=>'',
                'to_date'=>'',
                'description'=>'',
                'hours'=>'']
            ],
            'social' => [
                ['github'=>'',
                'linkedin'=>'']
            ]
        ]
    ]);
    ?>

</div>
