<?php

require '../../bootloader.php';

if (!is_logged_in()) {
    header('Location: /login.php');
    exit();
}

$form = [
    'attr' => [
        'method' => 'POST'
    ],
    'fields' => [
        'x' => [
            'label' => 'X coordinates',
            'type' => 'number',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_range' => [
                    'min' => 0,
                    'max' => 490
                ]
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Add coordinate',
                    'class' => 'input-field'
                ]
            ]
        ],
        'y' => [
            'label' => 'Y coordinates',
            'type' => 'number',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_range' => [
                    'min' => 0,
                    'max' => 490
                ]
            ],
            'extra' => [
                'attr' => [
                    'placeholder' => 'Add coordinate',
                    'class' => 'input-field'
                ]
            ]
        ],
        'color' => [
            'label' => 'Choose a color',
            'type' => 'select',
            'options' => [
                'black' => 'Black',
                'red' => 'Red',
                'green' => 'Green',
                'blue' => 'Blue'
            ],
            'validators' => [
                'validate_select',
                'validate_field_not_empty'
            ],
            'value' => 'red'
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Add poopie',
            'type' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn'
                ],
            ],
        ],
    ],
    'validators' => [
        'validate_field_coordinates' => [
            'x',
            'y'
        ],
    ]
];

$clean_inputs = get_clean_input($form);

if ($clean_inputs) {
    $success = validate_form($form, $clean_inputs);

    if ($success) {
        $fileDB = new FileDB(DB_FILE);

        $fileDB->load();
        $fileDB->insertRow('coordinates', $clean_inputs + ['email' => $_SESSION['email']]);
        $fileDB->save();

        $text = 'Looks good.';
    } else {
        $p = 'Fill all fields.';
    }
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php include(ROOT . '/core/templates/nav.php'); ?>
<main>
    <h2>ADD ITEM</h2>
    <?php require ROOT . '/core/templates/form.tpl.php'; ?>
    <p><?php if (isset($text)) print $text; ?></p>
</main>
</body>
</html>

