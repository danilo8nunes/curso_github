<?php

namespace Source\App\Controllers;

use Source\Models\People;
use Source\Core\Controller;
use Source\Core\Message;

class peopleController extends Controller
{   
    /** @var People */
    private $people;

    /** @var Message */
    private $message;

    public function __construct()
    {
        $this->people = new People();
        $this->message = new Message();
    }

    public function index()
    {
        $data = [
            "title" => "Contatos | Lista",
            "alert" => alert(),
            "result" => $this->people->all()
        ];
        $this->loadTemplate("people_cards", $data);
    }

    public function form()
    {
        if (!empty($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
            
            if($people = $this->people->findById($id)) {
                $data = [
                    "title" => "Contatos | Editar",
                    "alert" => alert(),
                    "subtitle" => "Atualize este contato",
                    "people" => $people,
                    "button" => "Atualizar",
                    "class" => "",
                    "action" => url() . "people/save"               
                ];
            } else {
                $this->message->bootstrap("Woops! Tente novamente", "danger");
                $_SESSION['alert'] = $this->message->render();
                header("location:" . url());
            }
        } else {
            $data = [
                "title" => "Contatos | Cadastrar",
                "alert" => alert(),
                "subtitle" => "Cadastre um contato",
                "button" => "Cadastrar",
                "class" => "d-none",
                "action" => url() . "people/save"
            ];
        }
        $this->loadTemplate("people_form", $data);
    }

    public function drop()
    {        
        if (!empty($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_SPECIAL_CHARS);
            
            if ($people = $this->people->findById($id)) {
                $name = $people->first_name;
            
            } else {
                $this->message->bootstrap("Contato informado não existe", "info");
                $_SESSION['alert'] = $this->message->render();
                header("location:" . url());
            }          

            if($people->destroy($id)) {
                $this->message->bootstrap("Contato #{$id}: {$name} excluído", "warning");
                $_SESSION['alert'] = $this->message->render();
                header("location:" . url());
                
            } else {
                $_SESSION['alert'] = $people->message()->render();
                header("location:" . url());
            }
        } else {   
            header("location:" . url());
        }
    }

    public function save()
    {
        $data = filter_input_array(INPUT_POST, $_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($data['id'])) {
            $this->people->bootstrap($data);
            if($this->people->save()) {
                $this->message->bootstrap("Contato adicionado com sucesso", "success");
                $_SESSION['alert'] = $this->message->render();
            
            } else {
                $_SESSION['alert'] = $this->people->message()->render();
            }
            header("location:" . url());
        } else {
            $people = $this->people->findById($data['id']);

            foreach (People::$required as $key) {
                $people->$key = !empty($data[$key]) ? $data[$key] : "";
            }

            if($people->save()) {
                $this->message->bootstrap("Contato Atualizado com sucesso", "success");
                $_SESSION['alert'] = $this->message->render();
                header("location:" . url());
            
            } else {
                $_SESSION['alert'] = $people->message()->render();
                header("location:" . url() . "people/form/&id={$people->id}");                
            }
        }
    }
}