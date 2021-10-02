<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'=>[
                'type'=>'INT',
                'constraint'=>5,
                'unsigned' => true,
                'auto_increment'=>true,
            ],

            'user_name'=>[
                    'type'=>'VARCHAR',
                    'constraint'=>'120',              
            ],
            'user_username'=>[
                    'type'=>'VARCHAR',
                    'constraint'=>'120',              
            ],
            'user_password'=>[
                    'type'=>'TEXT',            
            ]
            ]);
            $this->forge->addKey('user_id', true);
            $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
