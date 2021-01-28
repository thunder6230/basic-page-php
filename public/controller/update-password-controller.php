<?php 
    
    // password input config
    $config_update_password = [
    [
        'div_class' => 'col-12',
        'name' => 'oldpass',
        'type' => 'password',
        'id' => 'oldpass',
        'required' => 'required',
        'label' => 'Current Password',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
        ],
        'error_message' => [
            in_array($password_error_current_error, $errorArr) ?  $password_error_current_error : '',
        ]
    ],

    // confirm password input config

    [
        'div_class' => 'col-12',
        'name' => 'newpass',
        'type' => 'password',
        'id' => 'newpass',
        'required' => 'required',
        'label' => 'New Password',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
        ],
    ],    
    [
        'div_class' => 'col-12',
        'name' => 'newpass2',
        'type' => 'password',
        'id' => 'newpass2',
        'required' => 'required',
        'label' => 'Confirm New Password',
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