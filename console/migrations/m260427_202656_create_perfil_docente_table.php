<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%perfil_docente}}`.
 */
class m260427_202656_create_perfil_docente_table extends Migration
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
    $this->createTable('{{%perfil_docente}}', [
    'id_usuario' => $this->integer()->notNull(),
    'nombre' => $this->string(100)->notNull(),
    'apellido_paterno' => $this->string(100)->notNull(),
    'apellido_materno' => $this->string(100)->notNull(),
    'telefono' => $this->string(20),
    ], $tableOptions);

    $this->addPrimaryKey('pk-perfil_docente', '{{%perfil_docente}}', 'id_usuario');
    $this->addForeignKey('fk-docente-user', '{{%perfil_docente}}', 'id_usuario', '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%perfil_docente}}');
    }
}
