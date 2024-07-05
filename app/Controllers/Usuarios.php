<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class Usuarios extends ResourceController{
    protected $modelName = 'App\Models\UsuariosModel';
    protected $format = 'json';

    //Todos los usuarios
    public function index(){
        return $this->respond($this->model->findAll());
    }

    //Crear Usuario
    public function create(){
        $form = $this->request->getJSON(true);
        if(!$id = $this->model->insert($form)){
            return $this-failValidationErrors($this->model->errors());
        }
        $note = $this->model->find($id);
        return $this->respondCreated(['message' => 'Usuario creado correctamente', $note]);
    }

}