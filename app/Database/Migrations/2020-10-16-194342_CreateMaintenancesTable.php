<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMaintenancesTable extends Migration
{
	public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'folio' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'client' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'model' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'checkin' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => true
            ],
            'priority' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('maintenances');
    }

    public function down()
    {
        $this->forge->dropTable('maintenances');
    }
}
