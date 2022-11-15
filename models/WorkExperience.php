<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_experience".
 *
 * @property int $id
 * @property int|null $cv_id
 * @property string|null $company_name
 * @property string|null $job_title
 * @property string|null $from_date
 * @property string|null $to_date
 * @property string|null $description
 * @property int|null $hours
 *
 * @property Cv $cv
 */
class WorkExperience extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_experience';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cv_id', 'hours'], 'integer'],
            [['from_date', 'to_date'], 'safe'],
            [['description'], 'string'],
            [['company_name', 'job_title'], 'string', 'max' => 255],
            [['cv_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cv::class, 'targetAttribute' => ['cv_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cv_id' => 'Cv ID',
            'company_name' => 'Company Name',
            'job_title' => 'Job Title',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'description' => 'Description',
            'hours' => 'Hours',
        ];
    }

    /**
     * Gets query for [[Cv]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCv()
    {
        return $this->hasOne(Cv::class, ['id' => 'cv_id']);
    }
}
