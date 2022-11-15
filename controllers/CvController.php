<?php

namespace app\controllers;

use yii\web\Response;
use Yii;
use app\models\Cv;
use app\models\CvSearch;
use app\models\Education;
use app\models\Model;
use app\models\WorkExperience;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

class CvController extends Controller
{

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new CvSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    public function actionCreate()
    {
        $model = new Cv;
        $modelsEducation = [new Education];
        $modelsWorkExperience = [new WorkExperience];


        if ($model->load($this->request->post())) {
            $modelsEducation = (Model::createMultiple(Education::classname()));
            $modelsWorkExperience = (Model::createMultiple(WorkExperience::classname()));

            Model::loadMultiple($modelsEducation, Yii::$app->request->post());
            Model::loadMultiple($modelsWorkExperience, Yii::$app->request->post());

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsEducation),
                    ActiveForm::validateMultiple($modelsWorkExperience),
                    ActiveForm::validate($model)
                );
            }

            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsWorkExperience) && $valid;
            $valid = Model::validateMultiple($modelsEducation) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsEducation as $modelEducation) {
                            $modelEducation->cv_id = $model->id;
                            if (!($flag = $modelEducation->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        foreach ($modelsWorkExperience as $modelWorkExperience) {
                            $modelWorkExperience->cv_id = $model->id;
                            if (!($flag = $modelWorkExperience->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success','Successfully saved!');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelsEducation' => (empty($modelsEducation)) ? [new Education] : $modelsEducation,
            'modelsWorkExperience' => (empty($modelsWorkExperience)) ? [new WorkExperience] : $modelsWorkExperience,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsEducation = $model->getEducations();
        $modelsWorkExperience = $model->getWorkExperiences();

        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map([$modelsEducation, $modelsWorkExperience], 'id', 'id');
            $modelsEducation = Model::createMultiple(Education::classname(), $modelsEducation);
            $modelsWorkExperience = Model::createMultiple(WorkExperience::classname(), $modelsWorkExperience);
            Model::loadMultiple($modelsEducation, Yii::$app->request->post());
            Model::loadMultiple($modelsWorkExperience, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map([$modelsEducation, $modelsWorkExperience], 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsEducation),
                    ActiveForm::validateMultiple($modelsWorkExperience),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsEducation) && $valid;
            $valid = Model::validateMultiple($modelsWorkExperience) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            Education::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsEducation as $modelEducation) {
                            $modelEducation->cv_id = $model->id;
                            if (!($flag = $modelEducation->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        foreach ($modelsWorkExperience as $modelWorkExperience) {
                            $modelWorkExperience->cv_id = $model->id;
                            if (!($flag = $modelWorkExperience->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Successfully saved!');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsEducation' => (empty($modelsEducation)) ? [new WorkExperience] : $modelsEducation,
            'modelsWorkExperience' => (empty($modelsWorkExperience)) ? [new WorkExperience] : $modelsWorkExperience,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Cv::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
