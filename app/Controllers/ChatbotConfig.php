<?php

namespace App\Controllers;

use App\Models\ChatConfigModel;

class ChatbotConfig extends BaseController
{
    public function index()
    {
        $model = new ChatConfigModel();
        helper(['form']);
        $config = $model->first();
        return view('auth/chatbot/config', ['config' => $config]);
    }

    public function update()
    {
        $model = new ChatConfigModel();
        $model->update(1, [
            'is_enabled' => $this->request->getPost('is_enabled') ? 1 : 0,
            'gemini_api_key' => $this->request->getPost('gemini_api_key')
        ]);
        session()->setFlashdata('success', 'Pengaturan berhasil disimpan!');
        return redirect()->back();
    }
}
