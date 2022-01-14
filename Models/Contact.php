<?php
/*
 * Copyright (c) 2022.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Models;

class Contact extends BaseModel
{
    public string $email = '';
    public string $subject = '';
    public string $body = '';
    public string $male = '';

    public function rules(): array
    {
        return [
            'email' => [self::REQUIRED, self::EMAIL],
            'subject' => [self::REQUIRED],
            'body' => [self::REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Email Address',
            'subject' => 'Enter Subject',
            'body' => 'Body',
            'male' => 'Male',
            'female' => 'Female',
        ];
    }

    public function send()
    {
        return true;
    }

}