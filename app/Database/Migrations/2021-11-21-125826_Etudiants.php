<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Etudiants extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'etudiant_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'etudiant_gender'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'etudiant_nameFirst'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'etudiant_nameLast'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'etudiant_email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'etudiant_phone' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at datetime',
            'updated_at datetime default current_timestamp on update current_timestamp', 
            'deleted_at datetime',
        ]);
        $this->forge->addKey('etudiant_id', true);
        $this->forge->createTable('etudiants');
    }

    public function down()
    {
        $this->forge->dropTable('etudiants');
    }
}
