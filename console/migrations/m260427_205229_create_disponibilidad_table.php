<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%disponibilidad}}`.
 */
class m260427_205229_create_disponibilidad_table extends Migration
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
        $this->createTable('{{%disponibilidad}}', [
            'id' => $this->primaryKey(),
            'id_docente' => $this->integer()->notNull(),
            'dia' => $this->string(20)->notNull(),
            'hora_inicio' => $this->time()->notNull(),
            'hora_cierre' => $this->time()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-disp-docente', '{{%disponibilidad}}', 'id_docente', '{{%perfil_docente}}', 'id_usuario', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%disponibilidad}}');
    }
}
