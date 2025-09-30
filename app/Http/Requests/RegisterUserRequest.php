<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_id' => 'nullable|integer',
            'type_id' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            'city_id' => 'nullable|integer',
            'first_name' => 'nullable|string|max:191',
            'middle_name' => 'nullable|string|max:191',
            'last_name' => 'nullable|string|max:191',
            'email' => 'required|email|max:191|unique:users',
            'phone' => 'nullable|string|max:191|unique:users',
            'password' => 'required|string|max:191',
            'dob' => 'nullable|string|max:191',
            'gender' => 'nullable|string|in:male,female,other',
            'display_photo' => 'nullable|image|mimes:jpeg,png,jpg',
            'facebook_url' => 'nullable|string|max:191',
            'twitter_url' => 'nullable|string|max:191',
            'address_1' => 'nullable|string|max:191',
            'address_2' => 'nullable|string|max:191',
            'zip' => 'nullable|string|max:191',
            'last_year_member' => 'nullable|in:true,false',
            'district_name' => 'nullable|string|max:191',
            'district_number' => 'nullable|string|max:191'
        ];
    }
}
