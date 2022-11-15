<?php

use yii\db\Migration;

class m221106_105711_create_work_experience_table extends Migration
{
    public function Up()
    {
        $this->createTable('{{%work_experience}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer(),
            'company_name' => $this->string(),
            'job_title' => $this->string(),
            'from_date' => $this->date(),
            'to_date' => $this->date(),
            'description' => $this->text(),
            'hours' => $this->integer()
        ]);

        $this->createIndex(
            'idx-work_experience-cv_id',
            'work_experience',
            'cv_id'
        );

        $this->addForeignKey(
            'fk-work_experience-cv_id',
            'work_experience',
            'cv_id',
            'cv',
            'id',
            'CASCADE'
        );
    }

    public function Down()
    {
        $this->dropTable('{{%work_experience}}');
    }
}
