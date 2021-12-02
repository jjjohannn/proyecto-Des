<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class Telefono implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = trim($value);
        if (is_numeric($value)){
            if (strlen($value) != 8){
                $this->error_message = "El número telefono debe contener 8 digitos";
                return false;
            }else if (Str::startsWith($value, '0')){
                $this->error_message = "El número telefónico no debe empezar con un 0";
                return false;
            }else{
                return true;
            }
        }else{
            $this->error_message = "Ingrese un número telefónico válido";
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->error_message;
    }
}
