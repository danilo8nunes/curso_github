<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class PeopleModel Active Record Pattern
 * @author Danilo Nunes de Andrade
 * @package Source\Models
 */
class People extends Model
{
    private static $entity = "people";

    private static $safe = ["id", "crated_at", "update_at"];

    public static $required = [
        "first_name",
        "last_name",
        "phone_number",
        "email",
    ];

    public function bootstrap(array $data)
    {
        $this->data = new \StdClass();
        
        foreach (self::$required as $key){
            $this->data->$key = !empty($data[$key]) ? $data[$key] : "";
        }
    }

    /**
     * @param string $terms
     * @param string $params
     * @param string $columns
     * @return null|People
     */
    public function find(string $terms, string $params, string $columns = "*"): ?People
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
     * @return null|People
     */
    public function findById(int $id, string $columns = "*"): ?People
    {
        return $this->find("id = :id", "id={$id}", $columns);
    }

    /**
     * @param string $email
     * @param string $columns
     * @return null|People
     */
    public function findByEmail($email, string $columns = "*"): ?People
    {
        return $this->find("email = :email", "email={$email}", $columns);
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
     * @return null|People
     */
    public function save(): ?People
    {
        if (!$this->required(static::$required)) {
            $this->message->bootstrap("Nome, sobrenome, telefone e e-mail são obrigatórios", "warning");
            return null;
        }

        if (!is_email($this->email)) {
            $this->message->bootstrap("O e-mail informado não tem um formato válido", "warning");
            return null;
        }

        /** People Update */
        if (!empty($this->id)) {
            $PeopleId = $this->id;

            if ($this->find("email = :e AND id != :i", "e={$this->email}&i={$PeopleId}")) {
                $this->message->bootstrap("O e-mail informado já está cadastrado", "warning");
                return null;
            }

            $this->update(self::$entity, $this->safe(static::$safe), "id = :id", "id={$PeopleId}");
            if ($this->fail()) {
                $this->message->bootstrap("Erro ao atualizar, verifique os dados", "danger");
                return null;
            }
        }

        /** People Create */
        if (empty($this->id)) {
            if ($this->findByEmail($this->email)) {
                $this->message->bootstrap("O e-mail informado já está cadastrado", "warning");
                return null;
            }

            $PeopleId = $this->create(self::$entity, $this->safe(static::$safe));
            if ($this->fail()) {
                $this->message->bootstrap("Erro ao cadastrar, verifique os dados", "danger");
                return null;
            }
        }

        $this->data = ($this->findById($PeopleId))->data();
        return $this;
    }

    /**
     * @return null|People
     */
    public function destroy(): ?People
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
