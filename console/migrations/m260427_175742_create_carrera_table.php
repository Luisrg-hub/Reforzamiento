<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carrera}}`.
 */
class m260427_175742_create_carrera_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%carrera}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(255)->notNull(),
        ], $tableOptions);
    }
    public function safeDown()
    {
        $this->dropTable('{{%carrera}}');
    }

    /**
     * {@inheritdoc}
     */   
}
