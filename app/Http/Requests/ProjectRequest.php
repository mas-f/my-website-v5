<?php

namespace App\Http\Requests;

use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() === true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var Project|null $project */
        $project = $this->route('project');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique(Project::class)->ignore($project?->id),
            ],
            'summary' => ['required', 'string', 'max:600'],
            'description' => ['required', 'string', 'max:20000'],
            'problem_statement' => ['nullable', 'string', 'max:10000'],
            'solution' => ['nullable', 'string', 'max:10000'],
            'category' => ['required', 'string', 'max:100'],
            'features' => ['nullable', 'string', 'max:5000'],
            'technologies' => ['nullable', 'string', 'max:5000'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'live_url' => ['nullable', 'url', 'max:2048'],
            'repository_url' => ['nullable', 'url', 'max:2048'],
            'status' => ['required', Rule::enum(ProjectStatus::class)],
            'is_featured' => ['sometimes', 'boolean'],
            'is_placeholder' => ['sometimes', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
            'gallery' => ['nullable', 'array', 'max:8'],
            'gallery.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul project wajib diisi.',
            'summary.required' => 'Ringkasan wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'category.required' => 'Kategori wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'sort_order.required' => 'Urutan wajib diisi.',
            'thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Thumbnail harus berformat JPG, PNG, atau WebP.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 4 MB.',
            'gallery.*.image' => 'Setiap file galeri harus berupa gambar.',
            'gallery.*.mimes' => 'Galeri harus berformat JPG, PNG, atau WebP.',
            'gallery.*.max' => 'Ukuran setiap gambar galeri maksimal 4 MB.',
        ];
    }
}
