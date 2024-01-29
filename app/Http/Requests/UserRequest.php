<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $forumId = $this->route('id');

        return [
            'username' => ['required', 'string', 'min:8', 'max:15'],
            'password' => ['required', 'string', 'min:8', 'max:15']
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "code" => 400,
            "status" => "Bad Request",
            "errors" => $validator->getMessageBag()
        ], 400));
    }
}
