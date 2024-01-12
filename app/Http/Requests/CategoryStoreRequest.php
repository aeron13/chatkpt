<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use App\Models\Category;

class CategoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha_dash:ascii'],
            'color' => ['required', 'hex_color'],
            'parent_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        if (! Category::where('id', $value)->exists() ) {
                            $fail('The selected parent category does not exist.');
                        }
                    }
                }
             ] 

        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'message' => 'The data is not valid. Try again',
            'errors' => $validator->errors(),
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
