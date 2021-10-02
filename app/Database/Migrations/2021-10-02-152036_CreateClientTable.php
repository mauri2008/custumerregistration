<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'client_id'=>[
                'type'=>'INT',
                'constraint'=>5,
                'unsigned' => true,
                'auto_increment'=>true,
            ],

            'client_name'=>[
                    'type'=>'VARCHAR',
                    'constraint'=>'120',              
            ]
            ]);
            $this->forge->addKey('client_id', true);
            $this->forge->createTable('clients');
    }

    public function down()
    {
        $this->forge->dropTable('clients');
    }
}
