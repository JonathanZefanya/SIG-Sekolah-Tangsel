<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateChatbotConfig extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'auto_increment' => true],
            'is_enabled'      => ['type' => 'BOOLEAN', 'default' => false],
            'gemini_api_key'  => ['type' => 'TEXT', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('chat_config');
    }

    public function down()
    {
        $this->forge->dropTable('chat_config');
    }
}
