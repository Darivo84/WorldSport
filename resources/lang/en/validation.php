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

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'filled'               => 'The :attribute field is required.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'url'                  => 'The :attribute format is invalid.',

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
        'page_id' => [
            'required' => 'Please select at least one category.',
        ],
        'cover_img' => [
            'dimensions' => 'The cover Image is not 1000 by 260 pixels.',
        ],
        'events_img' => [
            'dimensions' => 'The events image is not 960 pixels by 430 pixels',
        ],
        'events_img_mobi' => [
            'dimensions' => 'The events image for mobile is not 500 pixels wide',
        ],
        'footer_img' => [
            'dimensions' => 'The footer image is not 1000 pixels by 415 pixels',
        ],
        'image' => [
            'dimensions' => 'The image is not 740 pixels by 400 pixels',
        ],
        'banner' => [
            'dimensions' => 'The banner image is not 1000 pixels by 260 pixels',
        ],
        'brand_image' => [
            'dimensions' => 'The brand image is not 300 pixels by 300 pixels',
        ],
        'info_image' => [
            'dimensions' => 'The information image is not 960 pixels by 430 pixels',
        ],
        'info_image_mobi' => [
            'dimensions' => 'The information mobile image is not 500 pixels wide',
        ],
        'cs_image' => [
            'dimensions' => 'The case study image is not 1000 by 667 pixels',
        ],
        'cover_image' => [
            'dimensions' => 'The case study image is not 1000 by 260 pixels',
        ],

        /*
    'cover_image' => [
        'required' => 'The Cover Image must be a file of type: jpg, jpeg, tif, png, gif. Or the image is to large',
    ],
    'brand_image' => [
        'required' => 'The Brand Image must be a file of type: jpg, jpeg, tif, png, gif. Or the image is to large',
    ],
    'info_image' => [
        'required' => 'The Info Image must be a file of type: jpg, jpeg, tif, png, gif. Or the image is to large',
    ],
    'events_img' => [
        'required' => 'The Events Image must be a file of type: jpg, jpeg, tif, png, gif. Or the image is to large',
    ],
    'footer_img' => [
        'required' => 'The Footer Image must be a file of type: jpg, jpeg, tif, png, gif. Or the image is to large',
    ],
    'image' => [
        'required' => 'The Cover Image must be a file of type: jpg, jpeg, tif, png, gif. Or the image is to large',
    ],*/
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'cover_img' => 'cover image',
        'events_img' => 'events image',
        'footer_img' => 'footer image',
        'kilobytes' => 'mb',
        '2000' => '2',
    ],

];
