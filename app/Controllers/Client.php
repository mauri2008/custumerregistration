<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use CodeIgniter\HTTP\RequestTrait;
use CodeIgniter\RESTful\ResourceController;

class Client extends ResourceController
{
    use RequestTrait;
    protected $clientmodel;

    public function __construct()
    {
        $this->clientmodel = new ClientModel();
    }

    public function store()
    {
        helper(['form','url']);

        if(! $this->validate([
            'client_name'=>[
                'rules'=>'required|min_length[3]|max_length[20]',
                'errors'=>[
                    'required'=>'Campo Nome do cliente e obrigatório',
                    'min_length'=>'Total de caracteres abaixo do permitido',
                    'max_length'=>'Total de caractere acima do permitido'
                ]
            ],
        ]))
        return $this->respond(['response'=>'error','menssage'=>implode('<br>', $this->validator->getErrors())], 404);
        
        $client_name = $this->request->getPost('client_name');
        
        $insertvalue = $this->clientmodel->insert(['client_name'=>$client_name]);

        return ($insertvalue)? $this->respond(['response'=>'success'],200) : $this->respond(['response'=>'error','menssage'=>'Erro não foi possivel salvar este este cliente'], 500); 
    }
}
