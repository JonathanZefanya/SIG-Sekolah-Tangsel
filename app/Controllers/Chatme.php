<?php

namespace App\Controllers;

use App\Models\ChatConfigModel;

class Chatme extends BaseController
{
    public function index()
    {
        $config = (new ChatConfigModel())->first();

        if (!$config || !$config['is_enabled']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('chatme/index', ['api_key' => $config['gemini_api_key']]);
    }
}