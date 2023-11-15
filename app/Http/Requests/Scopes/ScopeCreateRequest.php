<?php

namespace App\Http\Requests\Scopes;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ScopeCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'alpha_dash:ascii', 'unique:oauth_scopes,id','max:255'],
            'description' => ['required', 'string', 'max:500'],
        ];
    }
}
