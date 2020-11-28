<?php

require '../bootloader.php';

if (is_logged_in()) {
    header('Location: /index.php');
    exit();
}

$form = [
    'attr' => [
        'method' => 'POST',
    ],
    'fields' => [
        'email' => [
            'label' => 'EMAIL',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_email',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter your email',
                    'class' => 'input-field',
                ],
            ],
        ],
        'password' => [
            'label' => 'PASSWORD',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter password',
                    'class' => 'input-field',
                ],
            ],
        ],
    ],
    'buttons' => [
        'send' => [
            'title' => 'LOGIN',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn',
                ],
            ],
        ],
    ],
    'validators' => [
        'validate_login'
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $form_success = validate_form($form, $clean_inputs);

    if ($form_success) {
        $text = 'Welcome back!';
        $_SESSION = $clean_inputs;

        if (is_logged_in()) {
            header('Location: admin/add.php');
            exit();
        }
    } else {
        $text = 'Login failed';
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include(ROOT . '/core/templates/nav.php'); ?>
<main>
    <h2>Login</h2>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
    <p><?php if (isset($text)) print $text; ?></p>
</main>
</body>
</html>