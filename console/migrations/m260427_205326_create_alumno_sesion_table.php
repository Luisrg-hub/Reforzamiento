<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%alumno_sesion}}`.
 */
class m260427_205326_create_alumno_sesion_table extends Migration
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
        $this->createTable('{{%alumno_sesion}}', [
            'id_sesion' => $this->integer()->notNull(),
            'id_alumno' => $this->integer()->notNull(),
        ], $tableOptions);

        // Llave primaria compuesta
        $this->addPrimaryKey('pk-alumno_sesion', '{{%alumno_sesion}}', ['id_sesion', 'id_alumno']);

        // Llaves foráneas
        $this->addForeignKey('fk-as-sesion', '{{%alumno_sesion}}', 'id_sesion', '{{%sesion}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-as-alumno', '{{%alumno_sesion}}', 'id_alumno', '{{%perfil_alumno}}', 'id_usuario', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%alumno_sesion}}');
    }
}
