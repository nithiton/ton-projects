<?php

namespace App\Http\Requests\Clients;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'client_type' => ['required', 'string', 'max:255'],
            'redirect' => $this->client_type != 'client_credentials' ? ['required', 'url', 'max:500'] : ['string', 'nullable'],
            'scopes' => ['array'],
            'scopes.*' => ['string', 'max:191']
        ];
    }
}
