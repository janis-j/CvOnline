<?php

use app\models\Cv;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CvSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cvs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cv-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cv', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'surname',
            'phone',
            'email:email',
            //'address',
            //'country',
            //'skills',
            //'languages',
            //'interests',
            //'about:ntext',
            //'github',
            //'linkedin',
            //'website',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Cv $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
