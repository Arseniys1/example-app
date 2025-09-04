<?php

namespace App\Http\Requests\Api;

class ApiRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge($this->commonRules(), [
            'dateTo' => ['required', 'date_format:Y-m-d H:i:s,Y-m-d']
        ]);
    }
}
