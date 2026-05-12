<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sesion}}`.
 */
class m260427_205301_create_sesion_table extends Migration
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
        $this->createTable('{{%sesion}}', [
            'id' => $this->primaryKey(),
            'id_asignacion' => $this->integer()->notNull(),
            'fecha' => $this->date()->notNull(),
            'hora_inicio' => $this->time()->notNull(),
            'duracion' => $this->integer()->notNull(), // Asumimos minutos
            'tema' => $this->string(255)->notNull(),
            'estado' => $this->integer()->defaultValue(1), // Ejemplo: 1=Programada, 2=Realizada, 3=Cancelada
        ], $tableOptions);

        $this->addForeignKey('fk-sesion-asignacion', '{{%sesion}}', 'id_asignacion', '{{%asignacion}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sesion}}');
    }
}
