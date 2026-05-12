<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%perfil_alumno}}`.
 */
class m260427_202704_create_perfil_alumno_table extends Migration
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
    $this->createTable('{{%perfil_alumno}}', [
    'id_usuario' => $this->integer()->notNull(),
    'matricula' => $this->string(20)->unique()->notNull(),
    'nombre' => $this->string(100)->notNull(),
    'apellido_paterno' => $this->string(100)->notNull(),
    'apellido_materno' => $this->string(100)->notNull(),
    'id_carrera' => $this->integer()->notNull(),
    ], $tableOptions);

    $this->addPrimaryKey('pk-perfil_alumno', '{{%perfil_alumno}}', 'id_usuario');
    $this->addForeignKey('fk-alumno-user', '{{%perfil_alumno}}', 'id_usuario', '{{%user}}', 'id', 'CASCADE');
    $this->addForeignKey('fk-alumno-carrera', '{{%perfil_alumno}}', 'id_carrera', '{{%carrera}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%perfil_alumno}}');
    }
}
