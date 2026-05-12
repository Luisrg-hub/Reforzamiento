<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%evidencia}}`.
 */
class m260427_205341_create_evidencia_table extends Migration
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
        $this->createTable('{{%evidencia}}', [
            'id' => $this->primaryKey(),
            'id_sesion' => $this->integer()->notNull(),
            'nombre_archivo' => $this->string(255)->notNull(),
            'ruta' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-evidencia-sesion', '{{%evidencia}}', 'id_sesion', '{{%sesion}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%evidencia}}');
    }
}
