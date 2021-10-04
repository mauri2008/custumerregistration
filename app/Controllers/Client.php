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

    // função resposavel inserir e editar regitros na base e dados 
    public function store()
    {
        helper(['form','url']);

        // Validando Nome do cliente
        // Caso não atenda dos requisitos é retornado uma messagem de erro com código 404 
        if(! $this->validate([
            'client_name'=>[
                'rules'=>'trim|required|min_length[3]|max_length[120]',
                'errors'=>[
                    'required'=>'Campo Nome do cliente e obrigatório',
                    'min_length'=>'Total de caracteres abaixo do permitido',
                    'max_length'=>'Total de caractere acima do permitido'
                ]
            ],
        ]))
        return $this->respond(['response'=>'error','menssage'=>implode('<br>', $this->validator->getErrors())], 404);
        
        // Após validado o nome é atribuido os valor as variaveis client_id e client_name 
        // para assim dar um save no banco de dados

        $client_name = $this->request->getPost('client_name');
        $client_id = $this->request->getPost('client_id');
        
        $insertvalue = $this->clientmodel->save(['client_id'=>$client_id,'client_name'=>$client_name]);

        // apos inserir é verificado se ocorreu tudo bem com a operação 
        // caso sim retorna success com codigo 200 
        // caso não  retorna error com codigo 500 - erro interno

        return ($insertvalue)? $this->respond(['response'=>'success'],200) : $this->respond(['response'=>'error','menssage'=>'Erro não foi possivel salvar este este cliente'], 500); 
    }

    public function destroy()
    {
        helper(['form', 'url']);

        // Instanciando class Validation
        $validation = \Config\Services::validation();

        // atribuindo valo client_id  para ser validado 
        $client_id = $this->request->getGet('client_id');

        if(!$validation->check($client_id,'trim|required|integer|is_not_unique[clients.client_id]'))
            return $this->respond(['response'=>'error','message'=>implode('<br>',$validation->getErrors())], 404);

        
        if(! $this->clientmodel->delete(['client_id'=>$client_id]))
            return $this->respond(['response'=>'error','message'=>'Ocorreu um erro interno ! tente novamente'],500);
        
        return $this->respond(['response'=>'success']);
    }


}
