<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%asignacion}}`.
 */
class m260427_205246_create_asignacion_table extends Migration
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
        $this->createTable('{{%asignacion}}', [
            'id' => $this->primaryKey(),
            'id_docente' => $this->integer()->notNull(),
            'id_asignatura' => $this->integer()->notNull(),
            'periodo' => $this->string(50)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-asig-docente', '{{%asignacion}}', 'id_docente', '{{%perfil_docente}}', 'id_usuario', 'CASCADE');
        $this->addForeignKey('fk-asig-asignatura', '{{%asignacion}}', 'id_asignatura', '{{%asignatura}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%asignacion}}');
    }
}
