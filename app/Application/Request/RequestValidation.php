<?php

namespace App\Application\Request;

use App\Application\Messages\Error;
use App\Application\Config\Config;
use App\Models\User;
use http\Params;

trait RequestValidation
{
    private array $errors = [];

    protected function validate(array $data, array $rules, array $warnings): array|bool
    {
        foreach ($rules as $key=>$rule) {
            foreach ($rule as $item) {
                switch ($item) {
                    case 'required':
                        if (empty($data[$key]) || (is_array($data[$key]) && empty($data[$key]['tmp_name']))) {
                            $arr = [
                                'message' => $warnings[$key . '.' . $item],
                                'key' => $key,
                                'rule' => 'required',
                                'default' => 'Required field'
                            ];
                            $this->setMessage($arr);
                        }
                        break;
                    case 'unique':
                        $user = new User();
                        if (!empty($user->find($key, $data[$key]))) {
                            $arr = [
                                'message' => $warnings[$key . '.' . $item],
                                'key' => $key,
                                'rule' => 'unique',
                                'default' => 'Already exists'
                            ];
                            $this->setMessage($arr);
                        }
                        break;
                    case 'email':
                        if (!filter_var($data[$key], FILTER_VALIDATE_EMAIL)) {
                            $arr = [
                                'message' => $warnings[$key . '.' . $item],
                                'key' => $key,
                                'rule' => 'email',
                                'default' => 'Field does not match the email address format'
                            ];
                            $this->setMessage($arr);
                        }
                        break;
                    case 'confirm':
                        $confirmFieldName = Config::get('validation.password.confirm');
                        if (!empty($data[$confirmFieldName])) {
                            if ($data[$key] !== $data[$confirmFieldName]) {
                                $arr = [
                                    'message' => $warnings[$key . '.' . $item],
                                    'key' => $key,
                                    'rule' => 'confirm',
                                    'default' => 'Passwords don`t match'
                                ];
                                $this->setMessage($arr);
                            }
                        }
                        break;
                    case str_starts_with($item, 'regex:'):
                        $regex = substr($item, 6);
                        if (!preg_match($regex, $data[$key])) {
                            $arr = [
                                'message' => $warnings[$key . '.' . substr($item, 0, 5)],
                                'key' => $key,
                                'rule' => 'regex',
                                'default' => 'Field does not match the required format'
                            ];
                            $this->setMessage($arr);
                        }
                        break;
                    case str_starts_with($item, 'min:'):
                        $min = substr($item, 4);
                        if (strlen($data[$key]) < $min) {
                            $arr = [
                                'message' => $warnings[$key . '.' . substr($item, 0, 3)],
                                'key' => $key,
                                'rule' => 'min',
                                'default' => 'Field must contain at least ' . $min . ' characters'
                            ];
                            $this->setMessage($arr);
                        }
                        break;
                    case str_starts_with($item, 'max:'):
                        $max = substr($item, 4);
                        if (strlen($data[$key]) > $max) {
                            $arr = [
                                'message' => $warnings[$key . '.' . substr($item, 0, 3)],
                                'key' => $key,
                                'rule' => 'max',
                                'default' => 'Field must contain no more than ' . $max . ' characters'
                            ];
                            $this->setMessage($arr);
                        }
                        break;
                }
            }
        }
        Error::store($this->errors);
        return $this->errors;
    }

    public function validationStatus(): bool
    {
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setMessage(array $data): void
    {
        $message = $data['message'];
        $key = $data['key'];
        $default = $data['default'];
        $rule = $data['rule'];
        if (!empty($message)) {
            $this->errors[$key][$rule] = $message;
        } else {
            $this->errors[$key][$rule] = $default;
        }
    }
}