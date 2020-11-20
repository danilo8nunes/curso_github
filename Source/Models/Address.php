<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class AddressModel Active Record Pattern
 * @author Danilo Nunes de Andrade
 * @package Source\Models
 */
class Address extends Model
{
    private static $entity = "address";

    private static $safe = ["id", "created_at", "updated_at"];

    public static $required = [
        "id_people",
        "cep",
        "public_place",
        "neighborhood",
        "city",
        "uf",
    ];

    public function bootstrap(array $data)
    {
        $this->data = new \StdClass();
        
        foreach (self::$required as $key){
            $this->data->$key = !empty($data[$key]) ? $data[$key] : "";
        }

        $this->data->complement = !empty($data['complement']) ? $data['complement'] : "";
    }

    /**
     * @param string $terms
     * @param string $params
     * @param string $columns
     * @return null|Address
     */
    public function find(string $terms, string $params, string $columns = "*"): ?Address
    {
        $find = $this->read("SELECT {$columns} FROM " . self::$entity . " WHERE {$terms}", $params);
        if ($this->fail() || !$find->rowCount()) {
            return null;
        }
        return $find->fetchObject(__CLASS__);
    }

    /**
     * @param int $id
     * @param string $columns
     * @return null|Address
     */
    public function findById(int $id, string $columns = "*"): ?Address
    {
        return $this->find("id = :id", "id={$id}", $columns);
    }

    public function findByIdPeople(int $idPeople, string $columns = "*"): ?Address
    {
        return $this->find("id_people = :id_people", "id_people={$idPeople}", $columns);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $columns
     * @return array|null
     */
    public function all(int $limit = 30, int $offset = 0, string $columns = "*"): ?array
    {
        $all = $this->read("SELECT {$columns} FROM " . self::$entity . " LIMIT :limit OFFSET :offset",
            "limit={$limit}&offset={$offset}");

        if ($this->fail() || !$all->rowCount()) {
            return null;
        }
        return $all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

       /**
     * @return null|Address
     */
    public function save(): ?Address
    {
        if (!$this->required(static::$required)) {
            $this->message->bootstrap("Logradouro, bairro, cidade e estado são obrigatórios", "warning");
            return null;
        }

        /** People Update */
        if (!empty($this->id)) {
            $addressId = $this->id;

            $this->update(self::$entity, $this->safe(static::$safe), "id = :id", "id={$addressId}");
            if ($this->fail()) {
                $this->message->bootstrap("Erro ao atualizar, verifique os dados", "danger");
                return null;
            }
        }

        /** People Create */
        if (empty($this->id)) {
            $addressId = $this->create(self::$entity, $this->safe(static::$safe));
            if ($this->fail()) {
                $this->message->bootstrap("Erro ao cadastrar, verifique os dados", "danger");
                return null;
            }
        }

        $this->data = ($this->findById($addressId))->data();
        return $this;
    }

    /**
     * @return null|Address
     */
    public function destroy(): ?Address
    {
        if (!empty($this->id)) {
            $this->delete(self::$entity, "id = :id", "id={$this->id}");
        }

        if ($this->fail()) {
            $this->message->bootstrap("Não foi possível remover o usuário", "danger");
            return null;
        }

        $this->data = null;
        return $this;
    }
}
