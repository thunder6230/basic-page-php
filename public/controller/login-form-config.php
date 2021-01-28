<?php
//login email input config
$config = [
    [
        'div_class' => 'col-12',
        'name' => 'log_email',
        'type' => 'email',
        'id' => 'email',
        'required' => 'required',
        'label' => 'Email',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
            'placeholder' => 'name@domain.com',
            'value' => isset($_SESSION['login_email']) ? $_SESSION['login_email'] : '',
        ],
        'error_messages' => 
            ($msg != "") ? $msg : '',
        
    ],

// password input config

    [
        'div_class' => 'col-12',
        'name' => 'log_password',
        'type' => 'password',
        'id' => 'password',
        'required' => 'required',
        'label' => 'Password',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
        ]
    ]
]

?>