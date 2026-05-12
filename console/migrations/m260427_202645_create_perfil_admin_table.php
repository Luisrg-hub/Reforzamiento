<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%perfil_admin}}`.
 */
class m260427_202645_create_perfil_admin_table extends Migration
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
    $this->createTable('{{%perfil_admin}}', [
    'id_usuario' => $this->integer()->notNull(),
    'nombre' => $this->string(100)->notNull(),
    'apellido_paterno' => $this->string(100)->notNull(),
    'apellido_materno' => $this->string(100)->notNull(),
    ], $tableOptions);

    $this->addPrimaryKey('pk-perfil_admin', '{{%perfil_admin}}', 'id_usuario');
    $this->addForeignKey('fk-admin-user', '{{%perfil_admin}}', 'id_usuario', '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%perfil_admin}}');
    }
}
