<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre'   => 'required|string|max:255',
            'contenu' => 'required|string|min:5|max:500',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * Messages personnalisés pour les erreurs.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'titre.required'   => 'Le titre est obligatoire.',
            'titre.max'        => 'Le titre ne doit pas dépasser 255 caractères.',

            'contenu.required' => 'Le contenu est obligatoire.',
            'contenu.min'      => 'Le contenu doit contenir au moins 5 caractères.',
            'contenu.max'      => 'Le contenu ne doit pas dépasser 500 caractères.',

            'image.image'      => 'Le fichier doit être une image.',
            'image.mimes'      => 'Formats acceptés : jpeg, png, jpg, gif, svg.',
            'image.max'        => 'L’image ne doit pas dépasser 2 Mo.',
        ];
    }
}
