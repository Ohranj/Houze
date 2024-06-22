<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class UpdateMilestoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'text' => ['required', 'string', 'max:125'],
            'complete' => ['required', 'boolean'],
            'completed' => ['sometimes', 'nullable', 'date']
        ];
    }

    /**
     *
     */
    public function passedValidation(): void
    {
        if ($this->complete && ! $this->completed) {
            $this->merge(['completed' => Carbon::now()->toDateString()]);
        }

        if ( ! $this->complete) {
            $this->merge(['completed' => null]);
        }
    }
}
