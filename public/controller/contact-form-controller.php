<?php
//contact form email input config




$config_contact = [
    // name input config

    [
        'div_class' => 'col-12',
        'name' => 'reply_name',
        'type' => 'text',
        'id' => 'reply_name',
        'required' => 'required',
        'label' => 'Full Name',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
            'value' => $user->getFullName()
        ]
    ],
    //Email input config
    [
        'div_class' => 'col-12',
        'name' => 'reply_email',
        'type' => 'email',
        'id' => 'reply_email',
        'required' => 'required',
        'label' => 'Email',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
            'placeholder' => 'name@domain.com',
            'value' => $user_data['email'] ,
        ],
        'error_messages' =>
        in_array($email_error_format, $errorArr) ?  $email_error_format : ''
    ],

    // subject input config
    [
        'div_class' => 'col-12',
        'name' => 'email_subject',
        'type' => 'text',
        'id' => 'email_subject',
        'required' => 'required',
        'label' => 'Subject',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control',
        ]
    ],

    // textarea input config
    [
        'div_class' => 'col-12',
        'name' => 'email_subject',
        'type' => 'textarea',
        'id' => 'password',
        'required' => 'required',
        'label' => 'Text',
        'label_class' => 'form-label',
        'tag_attributes' => [
            'class' => 'form-control centered',
            'rows' => 4
        ]
    ]
        ];
?>