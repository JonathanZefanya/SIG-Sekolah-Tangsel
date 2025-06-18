<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatConfigModel extends Model
{
    protected $table = 'chat_config';
    protected $primaryKey = 'id';
    protected $allowedFields = ['is_enabled', 'gemini_api_key'];
}

