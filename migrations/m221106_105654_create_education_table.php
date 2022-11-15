<?php

use yii\db\Migration;

class m221106_105654_create_education_table extends Migration
{

    public function Up()
    {
        $this->createTable('{{%education}}', [
            'id' => $this->primaryKey(),
            'cv_id' => $this->integer(),
            'facility_name' => $this->string(),
            'education' => $this->string(),
            'start_date' => $this->date(),
            'end_date' => $this->date(),
            'description' => $this->text()
        ]);

        $this->createIndex(
            'idx-education-cv_id',
            'education',
            'cv_id'
        );

        $this->addForeignKey(
            'fk-education-cv_id',
            'education',
            'cv_id',
            'cv',
            'id',
            'CASCADE'
        );
    }

    public function Down()
    {
        $this->dropTable('{{%education}}');
    }
}
