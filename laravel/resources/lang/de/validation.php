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

    "accepted"         => "Вы должны принять :attribute.",
    "active_url"       => "Поле :attribute недействительный URL.",
    "after"            => "Поле :attribute должно быть датой после :date.",
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    "alpha"            => "Поле :attribute может содержать только буквы.",
    "alpha_dash"       => "Поле :attribute может содержать только буквы, цифры и дефис.",
    "alpha_num"        => "Поле :attribute может содержать только буквы и цифры.",
    "array"            => "Поле :attribute должно быть массивом.",
    "before"           => "Поле :attribute должно быть датой перед :date.",
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    "between"          => [
        "numeric" => "Поле :attribute должно быть между :min и :max.",
        "file"    => "Размер :attribute должен быть от :min до :max Килобайт.",
        "string"  => "Длина :attribute должна быть от :min до :max символов.",
        "array"   => "Поле :attribute должно содержать :min - :max элементов."
    ],
    'boolean' => 'The :attribute field must be true or false.',
    "confirmed"        => "Поле :attribute не совпадает с подтверждением.",
    "date"             => "Поле :attribute не является датой.",
    'date_equals' => 'The :attribute must be a date equal to :date.',
    "date_format"      => "Поле :attribute не соответствует формату :format.",
    "different"        => "Поля :attribute и :other должны различаться.",
    "digits"           => "Длина цифрового поля :attribute должна быть :digits.",
    "digits_between"   => "Длина цифрового поля :attribute должна быть между :min и :max.",
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    "email"            => "Поле :attribute имеет ошибочный формат.",
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    "exists"           => "Выбранное значение для :attribute уже существует.",
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    "image"            => "Поле :attribute должно быть изображением.",
    "in"               => "Выбранное значение для :attribute ошибочно.",
    'in_array' => 'The :attribute field does not exist in :other.',
    "integer"          => "Поле :attribute должно быть целым числом.",
    "ip"               => "Поле :attribute должно быть действительным IP-адресом.",
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    "max"              => [
        "numeric" => "Поле :attribute должно быть не больше :max.",
        "file"    => "Поле :attribute должно быть не больше :max Килобайт.",
        "string"  => "Поле :attribute должно быть не длиннее :max символов.",
        "array"   => "Поле :attribute должно содержать не более :max элементов."
    ],
    "mimes"            => "Поле :attribute должно быть файлом одного из типов: :values.",
    "mimetypes"            => "Поле :attribute должно быть файлом одного из типов: :values.",
    "min"              => [
        "numeric" => "Поле :attribute должно быть не менее :min.",
        "file"    => "Поле :attribute должно быть не менее :min Килобайт.",
        "string"  => "Поле :attribute должно быть не короче :min символов.",
        "array"   => "Поле :attribute должно содержать не менее :min элементов."
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value',
    "not_in"           => "Выбранное значение для :attribute ошибочно.",
    'not_regex' => 'The :attribute format is invalid.',
    "numeric"          => "Поле :attribute должно быть числом.",
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    "regex"            => "Поле :attribute имеет ошибочный формат.",
    "required"         => "Поле :attribute обязательно для заполнения.",
    "required_if"      => "Поле :attribute обязательно для заполнения, когда :other равно :value.",
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    "required_with"    => "Поле :attribute обязательно для заполнения, когда :values указано.",
    'required_with_all' => 'The :attribute field is required when :values are present.',
    "required_without" => "Поле :attribute обязательно для заполнения, когда :values не указано.",
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    "same"             => "Значение :attribute должно совпадать с :other.",
    "size"             => [
        "numeric" => "Поле :attribute должно быть :size.",
        "file"    => "Поле :attribute должно быть :size Килобайт.",
        "string"  => "Поле :attribute должно быть длиной :size символов.",
        "array"   => "Количество элементов в поле :attribute должно быть :size."
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    "unique"           => "Такое значение поля :attribute уже существует.",
    'uploaded' => 'The :attribute failed to upload.',
    "url"              => "Поле :attribute имеет ошибочный формат.",
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'email' => [
            'required' => 'Поле <b>Email</b> обязательно для заполнения.',
            'email' => 'Поле <b>Email</b> имеет ошибочный формат.',
        ],
        'desc' => [
            'required' => 'Поле <b>Параметр</b> обязательно для заполнения.',
        ],
        'code' => [
            'required' => 'Поле <b>Код параметра</b> обязательно для заполнения',
        ],
        'password' => [
            'required' => 'Поле <b>Пароль</b> обязательно для заполнения.',
        ],
        'password' => [
            'min' => 'Поле <b>Пароль</b> должно быть больше :min символов.',
        ],
        'url' => [
            'required' => 'Поле <b>URL</b> обязательно для заполнения.',
        ],
        'name' => [
            'required' => 'Поле <b>Имя</b> обязательно для заполнения.',
        ],
        'surname' => [
            'required' => 'Поле <b>Фамилия</b> обязательно для заполнения.',
        ],
        'filename' => [
            'required' => '<b>Краткое название файла</b> обязательно для заполнения.',
        ],
        'filepath' => [
            'required' => 'Поле <b>Файл</b> обязательно для заполнения.',
            'mimetypes' => 'Формат файла поля <b>Файл</b> не предусмотрен',
            'max' => '<b>Файл</b> слишком большой по размеру',
        ],
        'filepreview' => [
            'required' => 'Поле <b>Превью документа</b> обязательно для заполнения.',
            'mimetypes' => 'Формат файла поля <b>Превью документа</b> не предусмотрен',
            'max' => '<b>Превью документа</b> слишком большое по размеру',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
