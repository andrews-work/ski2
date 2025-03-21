<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        Log::info('ListingRequest: auth - ', ['user' => Auth::user()]);
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:new,used',
            'category_id' => 'required|exists:listing_categories,id',
            'usage_level' => 'nullable|in:one,two,three,four',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // change to 5mb later
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'description.required' => 'The description is required.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be at least 0.',
            'condition.required' => 'The condition is required.',
            'condition.in' => 'The selected condition is invalid.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category is invalid.',
            'usage_level.in' => 'The selected usage level is invalid.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Allowed image formats are: jpeg, png, jpg, gif.',
            'images.*.max' => 'Each image must be less than 2MB in size.',
        ];
    }
}
