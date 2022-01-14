<?php
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Models;

class User extends \App\Core\User
{
    CONST STATUS_INACTIVE = 0;
    CONST STATUS_ACTIVE = 1;
    CONST STATUS_DELETED = 2;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $confirmpassword = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function save(): bool
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::REQUIRED],
            'lastname' => [self::REQUIRED],
            'email' => [self::REQUIRED, self::EMAIL, [self::UNIQUE, 'class' =>self::class]],
            'password' => [self::REQUIRED, [self::MIN, 'min' => 8], [self::MAX, 'max' => 12]],
            'confirmpassword' => [self::REQUIRED, [self::MATCH, 'match' => 'password']],
        ];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'confirmpassword' => 'Confirm Password'
        ];
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status'];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function DisplayName(): string
    {
        return $this->firstname. " ".$this->lastname;
    }
}
