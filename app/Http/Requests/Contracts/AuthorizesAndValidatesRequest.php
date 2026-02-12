<?php

namespace App\Http\Requests\Contracts;

interface AuthorizesAndValidatesRequest
{
    public function authorize(): bool;

    /**
     * @return array<string, mixed>
     */
    public function rules(): array;
}
