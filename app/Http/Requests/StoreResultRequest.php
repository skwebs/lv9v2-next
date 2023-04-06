<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResultRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'admit_card_id'=>'required',
            'session'=>'required',
            'roll'=>'required',
            'class' => 'required|in:Play,Nursery,LKG,UKG,Std.1,Std.2,Std.3,Std.4,Std.5',
			'hindi' => 'required|numeric',
			'english' => 'required|numeric',
			'maths' => 'required|numeric',
			'drawing' => 'required|numeric',
			'total' => 'required|numeric',
			'full_marks' => 'required|numeric',
			'computer' => 'required_if:class,Std.1,Std.2,Std.3,Std.4,Std.5|numeric',
			'science' => 'required_if:class,Std.1,Std.2,Std.3,Std.4,Std.5|numeric',
			'science_oral' => 'required_if:class,Std.1,Std.2,Std.3,Std.4,Std.5|numeric',
			'sst' => 'required_if:class,Std.1,Std.2,Std.3,Std.4,Std.5|numeric',
			'sst_oral' => 'required_if:class,Std.1,Std.2,Std.3,Std.4,Std.5|numeric',
			'gk' => 'required_if:class,Std.1,Std.2,Std.3,Std.4,Std.5|numeric',
        ];
    }
}
