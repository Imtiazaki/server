<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ForumRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $forumId = $this->route('id');

        return [
            'user_id' => ['string', 'max:50'],
            'title' => ['required', 'string', 'max:50'],
            'body' => ['required', 'string', 'max:120'],
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
