<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;


class Tareas extends ResourceController {
    protected $modelName = 'App\Models\TareasModel';
    protected $format = 'json';

    //Todas las tareas
    public function index(){
        return $this->respond($this->model->findAll());
    }

    //Crear Tarea
    public function create(){
        $form = $this->request->getJSON(true);
        if(!$id = $this->model->insert($form)){
            return $this->failValidationErrors($this->model->errors());
        }
        $note = $this->model->find($id);
        return $this->respondCreated(['mensaje' => 'Tarea creada correctamente', $note]);
    }

    //Actualizar tarea
    public function update($id = null){
        $form = $this->request->getJSON(true);

        if(empty($form)){
            return $this->failValidationErrors("Nada que actualizar");
        }

        if(!$this->model->find($id)){
            return $this->failNotFound();
        }

        if(!$this->model->update($id,$form)){
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondUpdated([
            'mensaje' => 'Registro actualizado con exito',
            'data' => $this->model->find($id)
        ]);
    }


    //Eliminar tarea
    public function delete($id = null){
        if(!$this->model->find($id)){
            return $this->failNotFound();
        }

        $this->model->where('id_tarea', $id)->delete();

        return $this->respondDeleted([
            'message' => "Tarea {$id} fue eliminado con exito."
        ]);
    }


}