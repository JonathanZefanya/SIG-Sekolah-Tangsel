<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateChatHistory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'auto_increment' => true],
            'device_id' => ['type' => 'VARCHAR', 'constraint' => 100],
            'sender'    => ['type' => 'ENUM', 'constraint' => ['user', 'bot']],
            'message'   => ['type' => 'TEXT'],
            'created_at'=> ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('chat_history');
    }

    public function down()
    {
        $this->forge->dropTable('chat_history');
    }
}
