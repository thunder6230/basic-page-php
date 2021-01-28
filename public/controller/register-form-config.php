<?php 
    //first name config

    $config_register = [
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
            'value' => isset($_SESSION['fname']) ? $_SESSION['fname'] : '',
        ],
        'error_message' => in_array($fname_error, $errorArr) ?  '$fname_error' : ''
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
            'value' => isset($_SESSION['lname']) ? $_SESSION['lname'] : '',
        ],
        'error_message' => in_array($lname_error, $errorArr) ?  '$lname_error' : ''
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
            'value' => isset($_SESSION['email']) ? $_SESSION['email'] : '',
        ],
    ],

    // confirm email input config

    [
        'div_class' => 'col-12',
        'name' => 'email2',
        'type' => 'email',
        'id' => 'email2',
        'required' => 'required',
        'label' => 'Confirm Email',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
            'placeholder' => 'name@domain.com',
            'value' => isset($_SESSION['email2']) ? $_SESSION['email2'] : '',
        ],
        'error_message' => [
            in_array($email_error_taken, $errorArr) ?  $email_error_taken : '',
            in_array($email_error_format, $errorArr) ?  $email_error_format : '',
            in_array($email_error_match, $errorArr) ?  $email_error_match : '',
        ]
        ],

    // password input config

    [
        'div_class' => 'col-12',
        'name' => 'password',
        'type' => 'password',
        'id' => 'password',
        'required' => 'required',
        'label' => 'Password',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
        ]
        ],

        // confirm password input config

        [
        'div_class' => 'col-12',
        'name' => 'password2',
        'type' => 'password',
        'id' => 'password2',
        'required' => 'required',
        'label' => 'Password',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
        ],
        'error_message' => [
            in_array($password_error_match, $errorArr) ?  $password_error_match : '',
            in_array($password_error_format, $errorArr) ?  $password_error_format : '',
            in_array($password_error_length, $errorArr) ?  $password_error_length : '',
        ]
        ]
        ];
?>