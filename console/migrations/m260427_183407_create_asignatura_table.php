<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%asignatura}}`.
 */
class m260427_183407_create_asignatura_table extends Migration
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
        $this->createTable('{{%asignatura}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(255)->notNull(),
        ], $tableOptions);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
{
    $this->dropTable('{{%asignatura}}');
}
}
