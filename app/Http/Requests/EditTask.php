<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Task;
use Illuminate\Validation\Rule;

class EditTask extends CreateTask
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = parent::rules();

        $status_rule = Rule::in(array_keys(Task::STATUS));

        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => 'status',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();

        $status_label = array_map(function ($item) {
            return $item['label'];
        }, Task::STATUS);

        $status_label_implode = implode(', ', $status_label);

        return $messages + [
            'status.in' => 'Specify one of "' . $status_label_implode . '" for the status'
        ];
    }
}
