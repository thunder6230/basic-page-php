<?php

$config_update_profile = [
    [
        'div_class' => 'col-sm-6',
        'name' => 'fname',
        'type' => 'text',
        'id' => 'fname',
        'required' => 'required',
        'label' => 'First name',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
            'placeholder' => 'First name',
            'value' => $user_data['first_name'],
        ],
        'error_message' => [
            in_array($fname_error, $errorArr) ?  $fname_error : '',
            in_array($name_error, $errorArr) ?  $lname_error : '',
        ]
    ],

    // last name input config

    [
        'div_class' => 'col-sm-6',
        'name' => 'lname',
        'type' => 'text',
        'id' => 'lname',
        'required' => 'required',
        'label' => 'Last name',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
            'placeholder' => 'Last name',
            'value' => $user_data['last_name'],
        ],
        'error_message' => [
            in_array($lname_error, $errorArr) ?  $lname_error : '',
            in_array($name_error, $errorArr) ?  $lname_error : '',
        
        ]
    ],
    // username input config
    [
        'div_class' => 'col-12',
        'name' => 'username',
        'type' => 'text',
        'id' => 'username',
        'required' => 'required',
        'label' => 'Username',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
            'placeholder' => 'First name',
            'value' => $user_data['username'],
        ],
        'error_message' => in_array($username_error, $errorArr) ?  $username_error : ''
    ],
    // email input config

   [
        'div_class' => 'col-12',
        'name' => 'email',
        'type' => 'email',
        'id' => 'email',
        'required' => 'required',
        'label' => 'Email',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
            'placeholder' => 'name@domain.com',
            'value' => $user_data['email'],
        ],
        'error_message' => [
            in_array($email_error_taken, $errorArr) ?  $email_error_taken : '',
            in_array($email_error_format, $errorArr) ?  $email_error_format : '',
        ]
    ],

    // address input config

    [
        'div_class' => 'col-12',
        'name' => 'address',
        'type' => 'text',
        'id' => 'address',
        'required' => '',
        'label' => 'Address',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
            'placeholder' => '1234 Main St',
            'value' => $user_data['address'],
        ],
        'error_message' => [
            in_array($address_error, $errorArr) ?  $address_error : '',
        ]
        ],

    // country input config

    [
        'div_class' => 'col-md-4',
        'name' => 'country',
        'type' => 'select',
        'id' => 'country',
        'required' => '',
        'label' => 'Country',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-select',
            'value' => $user_data['address'],
        ],
        'error_message' => [
            in_array($address_error, $errorArr) ?  $address_error : '',
        ],
        'options' => ['Choose...'],
    ],

    // city input config

    [
        'div_class' => 'col-md-5',
        'name' => 'city',
        'type' => 'text',
        'id' => 'city',
        'required' => '',
        'label' => 'City',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
            'value' => $user_data['city'],
        ],
        'error_message' => [
            in_array($city_error, $errorArr) ?  $city_error : '',
        ]
    ],
    //Zip input config
    [
        'div_class' => 'col-md-3',
        'name' => 'zip',
        'type' => 'text',
        'id' => 'zip',
        'required' => '',
        'label' => 'Zip',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
            'value' => $user_data['zip'],
        ],
        'error_message' => [
            in_array($zip_error, $errorArr) ?  $zip_error : '',
        ]
    ],
        ];
    ?>