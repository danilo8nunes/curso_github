<?php

namespace Source\App\Controllers;

use Source\Core\Controller;
use Source\Models\Address;
use Source\Models\People;
use Source\Core\Message;

class addressController extends Controller
{
    /** @var Address */
    private $address;

    /** @var Message */
    private $message;

    /** @var People */
    private $people;

    public function __construct() 
    {
        $this->address = new Address();
        $this->people = new People();
        $this->message = new Message();
    }

    public function index()
    {
        $this->form();
    }

    public function form()
    {
        if (!empty($_GET['id'])) {
            $idPeople = filter_var($_GET['id'], FILTER_VALIDATE_INT);
            
            if (!$people = $this->people->findById($idPeople)) {
                $this->message->bootstrap("Woops! Algo deu errado tente novamente", "danger");
                $_SESSION['alert'] = $this->message->render();
                header("location:" . url());                
            
            } else {
            /** create new address */
                if($address = $this->address->findByIdPeople($idPeople)) {
                    $data = [
                        "title" => "Contatos | Cadastrar Endereço",
                        "alert" => alert(),
                        "subtitle" => "Endereço de {$people->first_name} {$people->last_name}",
                        "action" => url() . "address/save",
                        "address" => $address,
                        "class" => "d-none",
                        "button" => "Cadastrar"
                    ];
        
                /** update new address */
                } else {
                    $data = [
                        "title" => "Contatos | Cadastrar Endereço",
                        "alert" => alert(),
                        "subtitle" => "Endereço de {$people->first_name} {$people->last_name}",
                        "action" => url() . "address/save",
                        "class" => "d-none",
                        "idPeople" => $idPeople,
                        "button" => "Cadastrar"
                    ];
                }
                
                $this->loadTemplate("form_address", $data);
            }
        } else {
            header("location:" . url());
        }
    }

    public function view() 
    {
        if (!empty($_GET['id'])) {
            $idPeople = filter_var($_GET['id'], FILTER_VALIDATE_INT);
            $address = $this->address->findByIdPeople($idPeople);
                $data = [
                    "cep" => $address->cep ?? "",
                    "logradouro" => $address->public_place ?? "",
                    "complemento" => $address->complement ?? "",
                    "bairro" => $address->neighborhood ?? "",
                    "cidade" => $address->city ?? "",
                    "estado" => $address->uf ?? ""
                ];
            echo json_encode($data);
        }
    }
    
    public function save() 
    {
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);       
        
        /** create address */
        if (empty($data['id'])) {
            $this->address->bootstrap($data);
            if($this->address->save()) {
                $this->message->bootstrap("Endereço cadastrado com sucesso", "success");
                $_SESSION['alert'] = $this->message->render();
            } else {
                $_SESSION['alert'] = $this->address->message->render();
            }

        /** update address */
        } else {
            $address = $this->address->findByIdPeople($data['id_people']);

            foreach (Address::$required as $key) {
                $address->$key = $data[$key] ?? "";
            }
            $address->complement = $data['complement'] ?? "";

            if($address->save()) {
                $this->message->bootstrap("Endereço atualizado com sucesso", "success");
                $_SESSION['alert'] = $this->message->render();
                header("location:" . url());
            
            } else {
                $_SESSION['alert'] = $address->message->render();
                header("location:" . url() . "address/edit/&id={$data['id_people']}");                
            }
        }
        header("location:" . url());
    }
}