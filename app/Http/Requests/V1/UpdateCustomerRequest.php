<?php

namespace App\Http\Requests\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user()  ;
        return $user != null && $user->tokenCan('update') ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method() ;
        if($method == 'PUT'){
            return [
                'name' => ['required'] ,
                'type' => ['required' , Rule::in(['I' , 'B' , 'i' , 'b'])] , // type of email is Individual or Business
                'email' => ['required' , 'email'] ,
                'address' => ['required'] ,
                'city' => ['required'] ,
                'state' => ['required'] ,
                'postalCode' => ['required'] ,
            ];
        }else {
            return [
                'name' => ['sometimes', 'required'] ,
                'type' => ['sometimes', 'required' , Rule::in(['I' , 'B' , 'i' , 'b'])] , // type of email is Individual or Business
                'email' => ['sometimes', 'required' , 'email'] ,
                'address' => ['sometimes', 'required'] ,
                'city' => ['sometimes', 'required'] ,
                'state' => ['sometimes', 'required'] ,
                'postalCode' => ['sometimes', 'required'] ,
            ];
        }

    }
    /*
    In Laravel, the prepareForValidation method within a form request class is used to modify the request data
     before the validation rules are applied.
    This method takes the value of postalCode from the request and merges it into the request data with the key 'postal_code'
    */
    protected function prepareForValidation()
    {
        if($this->postalCode){
            $this->merge([
                'postal_code' => $this->postalCode
            ]);
        }

    }
}
