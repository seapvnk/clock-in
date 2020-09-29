<?php

class User extends  Model
{
    protected static $table = 'users';
    protected static $columns = [
        'id',
        'name',
        'password',
        'email',
        'start_date',
        'end_date',
        'is_admin',
    ];

    public static function getActiveUsersCount()
    {
        return static::count(['raw' => 'end_date IS NULL']);
    } 

    public function update()
    {
        $this->validate();
        $this->is_admin = $this->is_admin ? 1 : 0;
        
        if(!$this->end_date) $this->end_date = null;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        
        return parent::update();
    }

    public function insert()
    {
        $this->validate();
        $this->is_admin = $this->is_admin ? 1 : 0;
        if(!$this->end_date) $this->end_date = null;

        return parent::insert();
    }

    private function validate()
    {
        $errors = [];


        // Generic validation
        $requiredFields = [
            'name' => 'Nome',
            'email' => 'E-mail',
            'password' => 'Senha',
            'confirm_password' => 'Confirmar senha',
            'start_date' => 'Data de admissão'
        ];

        foreach ($requiredFields as $field => $formField) {
            if (!$this->$field) {
                $errors[$field] = "$formField é um campo obrigatório.";
            }
        }

        // Confirm password validation
        if ($this->password !== $this->confirm_password) {
            $errors['confirm_password'] = 'As senhas não coincidem.';
        }

        // E-mail validation
        if ($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'E-mail inválido.';
        }

        // Start date validation
        if ($this->start_date && !DateTime::createFromFormat('Y-m-d', $this->start_date)) {
            $errors['start_date'] = 'A data de admissão deve seguir o padrão dd/mm/aaaa.';
        }

        // End date validation
        if ($this->end_date && !DateTime::createFromFormat('Y-m-d', $this->end_date)) {
            $errors['end_date'] = 'A data de desligamento deve seguir o padrão dd/mm/aaaa.';
        }

        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}