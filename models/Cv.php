<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cv".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $country
 * @property string|null $skills
 * @property string|null $languages
 * @property string|null $interests
 * @property string|null $about
 * @property string|null $github
 * @property string|null $linkedin
 * @property string|null $website
 *
 * @property Education[] $educations
 * @property WorkExperience[] $workExperiences
 */
class Cv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cv';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'phone', 'email', 'address', 'country'], 'required'],
            [['email'], 'email', 'message' => 'Email is not valid'],
            [['website'], 'url', 'message' => 'Address is not valid, example - http://www.example.com'],
            [['name', 'surname', 'phone', 'email', 'address', 'country', 'skills', 'languages', 'interests', 'github', 'linkedin', 'website'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'country' => 'Country',
            'skills' => 'Skills',
            'languages' => 'Languages',
            'interests' => 'Interests',
            'about' => 'About',
            'github' => 'Github user name',
            'linkedin' => 'Linkedin user name',
            'website' => 'Website',
        ];
    }

    public function getEducations()
    {
        return $this->hasMany(Education::class, ['cv_id' => 'id'])->all();
    }

    public function getWorkExperiences()
    {
        return $this->hasMany(WorkExperience::class, ['cv_id' => 'id'])->all();
    }
}
