<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'alpha' => ':attribute may only contain letters.',
    'alpha_dash' => ':attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => ':attribute may only contain letters and numbers.',
    'between' => [
        'string' => ':attribute phải có ký tự từ :min đến :max.',
        'file' => ':attribute phải có kích thước từ :min đến :max KB.',
    ],
    'confirmed' => ':attribute chưa trùng khớp.',
    'digits' => ':attribute must be :digits digits.',
    'digits_between' => ':attribute must be between :min and :max digits.',
    'email' => 'Cần đúng định dạng email.',
    'file' => ':attribute phải là 1 file.',
    'max' => [
        'numeric' => ':attribute phải không quá :max ký tự.',
        'file' => 'The :attribute phải không quá :max KB.',
    ],
    'mimes' => ':attribute phải có định dạng là: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ':attribute phải có it nhất :min ký tự.',
        'file' => ':attribute phải ít nhất :min kb.',
        'string' => ':attribute phải ít nhất :min ký tự.',
    ],
    'numeric' => ':attribute phải là số.',
    'required' => 'Cần nhập đầy đủ :attribute.',
    'unique' => ':attribute đã tồn tại.',
];
