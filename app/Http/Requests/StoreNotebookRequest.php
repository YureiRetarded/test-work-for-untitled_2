<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class StoreNotebookRequest extends FormRequest
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
            'fio'=>'string|required|max:255',
            'company'=>'string|max:255',
            'phone'=>'string|required|max:255',
            'email'=>'string|required|max:255',
            'birthday'=>'date',
            'photo'=>'file',
        ];
    }

}
