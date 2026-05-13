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

        // 1. Creamos la tabla con las nuevas columnas incluidas
        $this->createTable('{{%asignatura}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(255)->notNull(),
            'id_carrera' => $this->integer(), // Añadido desde tu SQL
            'estado' => $this->tinyInteger(1)->defaultValue(1), // 1 = Activa, 0 = Inactiva
        ], $tableOptions);

        // 2. Añadimos la restricción de llave foránea (Foreign Key)
        // Parámetros: nombre_restriccion, tabla_actual, columna_local, tabla_destino, columna_destino
        $this->addForeignKey(
            'fk_asignatura_carrera',
            '{{%asignatura}}',
            'id_carrera',
            '{{%carrera}}', // Asegúrate de que tu tabla de carreras se llame exactamente así
            'id',
            'CASCADE', // Si se borra la carrera, se borran sus asignaturas (opcional, puedes cambiarlo a 'RESTRICT')
            'CASCADE'  // Si se actualiza el id de la carrera, se actualiza aquí
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Es una buena práctica eliminar primero la llave foránea antes de eliminar la tabla
        $this->dropForeignKey(
            'fk_asignatura_carrera',
            '{{%asignatura}}'
        );

        $this->dropTable('{{%asignatura}}');
    }
}