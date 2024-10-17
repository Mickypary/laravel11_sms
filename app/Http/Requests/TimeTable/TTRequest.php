<?php

namespace App\Http\Requests\TimeTable;

use Illuminate\Foundation\Http\FormRequest;

class TTRequest extends FormRequest
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
    public function rules()
    {
        return [
            'exam_date' => 'sometimes|required|string|min:8',
            'day' => 'sometimes|required|string|min:6',
            'subject_id' => 'required|exists:subjects,id',
            'ttr_id' => 'required|exists:time_table_records,id',
            'ts_id' => 'required|exists:time_slots,id',
        ];
    }

    public function attributes()
    {
        return  [
            'subject_id' => 'Subject',
            'ttr_id' => 'TimeTable Record',
            'ts_id' => 'Time Slot',
        ];
    }
}
