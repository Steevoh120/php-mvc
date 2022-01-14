<?php
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Models;

use App\Core\Application;
use App\Core\Log;

abstract class BaseModel
{
    public const REQUIRED = 'required';
    public const EMAIL = 'email';
    public const INT = 'number';
    public const MIN = 'min';
    public const MAX = 'max';
    public const URI = 'url';
    public const UNIQUE = 'unique';
    public const MATCH = 'match';

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;
    public array $errors = [];
    public function labels(): array
    {
        return [];
    }

    public function getLabel($attribute){
        return $this->labels()[$attribute] ?? $attribute;

    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::REQUIRED && !$value) {
                    $this->addErrorForRule($attribute, self::REQUIRED);
                }
                if ($ruleName === self::EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorForRule($attribute, self::EMAIL);
                }
                if ($ruleName === self::MIN && strlen($value) < $rule['min']) {
                    $this->addErrorForRule($attribute, self::MIN, $rule);
                }
                if ($ruleName === self::MAX && strlen($value) > $rule['max']) {
                    $this->addErrorForRule($attribute, self::MAX, $rule);
                }
                if ($ruleName === self::MATCH && $value !== $this->{$rule['match']}) {
                    $rule['match'] = $this->getLabel($rule['match']);
                    $this->addErrorForRule($attribute, self::MATCH, $rule);
                }
                if ($ruleName === self::UNIQUE){
                    $className= $rule['class'];
                    $uniqueattribute= $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $stmt = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueattribute = :Attr");
                    $stmt ->bindValue(":Attr", $value);
                    $stmt ->execute();
                    $record = $stmt->fetchObject();
                    if($record){
                        $this->addErrorForRule($attribute, self::UNIQUE, ['field' => $this->labels()[$attribute]]);
                    }
                }
            }
        }
        return (empty($this->errors));
    }

    private function addErrorForRule(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::REQUIRED => 'This field is required',
            self::EMAIL => 'This field must be a valid email address',
            self::INT => 'This filed should contain Numbers Only',
            self::MIN => 'Minimum Length for this field is {min}',
            self::MAX => 'Minimum Length for this field is {max}',
            self::URI => 'This field must be a valid URL',
            self::UNIQUE => 'A Record with this {field} Already Exists',
            self::MATCH => 'This field must be the same as {match}',
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}
