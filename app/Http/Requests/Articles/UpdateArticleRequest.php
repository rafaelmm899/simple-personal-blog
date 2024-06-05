<?php

declare(strict_types=1);

namespace App\Http\Requests\Articles;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required|exists:categories,id',
            'tags' => 'array|exists:tags,id',
            'image' => 'nullable|mimes:jpg,png|max:2048',
        ];
    }
}
