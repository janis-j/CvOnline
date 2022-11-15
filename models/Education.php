<?php

namespace app\models;

use yii\db\ActiveRecord;

class Education extends ActiveRecord
{
    public static function tableName()
    {
        return 'education';
    }

    public function rules()
    {
        return [
            [['cv_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['description'], 'string'],
            [['facility_name', 'education'], 'string', 'max' => 255],
            [['cv_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cv::class, 'targetAttribute' => ['cv_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cv_id' => 'Cv ID',
            'facility_name' => 'Facility Name',
            'education' => 'Education',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'description' => 'Description',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Cv::class, ['id' => 'cv_id']);
    }
}
