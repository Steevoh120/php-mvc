<?php
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Models;

use App\Core\Application;
use App\Core\Log;

class Login extends BaseModel
{
    public string $email = '';
    public string $password = '';


    public function Login()
    {
        $user = (new User)->findOne(['email' => $this->email]);
        if(!$user){
            $this->addError('email', 'User with this Email Does not Exist');
            return false;
        }

        if(!password_verify($this->password, $user->password)){
            $this->addError('password', 'Password is Incorrect');
            return false;
        }

        return Application::$app->login($user);
    }

    public function rules(): array
    {
        return [
            'email' => [self::REQUIRED, self::EMAIL],
            'password' => [self::REQUIRED, [self::MIN, 'min' => 8]],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Email Address',
            'password' => 'Password'
        ];
    }


}