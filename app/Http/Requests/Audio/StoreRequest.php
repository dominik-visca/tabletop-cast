<?php

namespace App\Http\Requests\Audio;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        // Set checkboxes
        $this->merge([
            'loop' => $this->has('loop'),
            'pausable' => $this->has('pausable'),
            'music' => $this->has('music'),
            'ambience' => $this->has('ambience'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'file' => 'required|file|mimetypes:audio/mpeg,audio/x-mpeg-3,audio/mpeg3,audio/mp3,audio/ogg,audio/mp4,audio/m4a,application/octet-stream,video/mp4|max:40960',
            'initial_volume' => 'required|numeric|between:0,1',
            'loop' => 'boolean',
            'pausable' => 'boolean',
            'music' => 'boolean',
            'ambience' => 'boolean',
            'slot' => 'required|integer|between:0,81'
        ];
    }
}
