<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carrera_asignatura}}`.
 */
class m260427_183641_create_carrera_asignatura_table extends Migration
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
        $this->createTable('{{%carrera_asignatura}}', [
            'id_carrera' => $this->integer(),
            'id_asignatura' => $this->integer(),
        ], $tableOptions);

        // Llaves primarias compuestas
        $this->addPrimaryKey('pk-carrera_asignatura', '{{%carrera_asignatura}}', ['id_carrera', 'id_asignatura']);

        // Llaves foráneas
        $this->addForeignKey('fk-ca-carrera', '{{%carrera_asignatura}}', 'id_carrera', '{{%carrera}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-ca-asignatura', '{{%carrera_asignatura}}', 'id_asignatura', '{{%asignatura}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%carrera_asignatura}}');
    }
}
