<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\Request;

class Auth extends BaseController
{
    public function index()
    {
        helper(['form','url']);

        if(! $this->validate([
            'user_username'=>[
                'rules'=>'required|min_length[3]|max_length[20]',
                'errors'=>[
                    'required'=>'Campo usuário e obrigatório',
                    'min_length'=>'Total de caracteres abaixo do permitido',
                    'max_length'=>'Total de caractere acima do permitido'
                ]
            ],
            'user_password'=>[
                'rules'=>'required|alpha_numeric_punct|min_length[3]|max_length[20]',
                'errors'=>[
                    'required'=>'Campo Senha obrigatório',
                    'min_length'=>'Total de caracteres abaixo do permitido',
                    'max_length'=>'Total de caractere acima do permitido'
                ]

            ]
        ]))
            return view('login',['validation'=>$this->validator->getErrors()]);

        $usermodel = new UserModel();
        $data = $this->request->getPost();

        if(!$getuser = $usermodel->where(['user_username'=>$data['user_username']])->first())
            return view('login',['validation'=>['Usuário ou senha incorreto!']]);
        
        if(!$getuser = $usermodel->where(['user_password'=>$data['user_password']])->first())
            return view('login',['validation'=>['Usuário ou senha incorreto!']]); 
            
        $newdatasession =[
            'usuario'=>$getuser['user_name'],
            'logged_in'=>true,
        ];
        $session = \Config\Services::session();
        $session->start();
        $session->set($newdatasession);

        return redirect()->to('/sis/home');

    }
}
