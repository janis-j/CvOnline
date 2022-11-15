<?php

use yii\db\Migration;

class m221106_105640_create_cv_table extends Migration
{

    public function Up()
    {
        $this->createTable('{{%cv}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'country' => $this->string()->notNull(),
            'skills' => $this->string(),
            'languages' => $this->string(),
            'interests' => $this->string(),
            'about' => $this->text(),
            'github' => $this->string(),
            'linkedin' => $this->string(),
            'website' => $this->string()
        ]);
    }

    public function Down()
    {
        $this->dropTable('{{%cv}}');
    }
}
