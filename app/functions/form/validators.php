<?php

// //////////////////////////////
// [1] FORM VALIDATORS
// //////////////////////////////

/**
 * Check if login is successful
 *
 * @param array $filtered_input
 * @param array $form
 * @return bool
 */
function validate_login(array $filtered_input, array &$form): bool
{
    $fileDB = new FileDB(DB_FILE);
    $fileDB->load();

    if ($fileDB->getRowWhere('users', [
        'email' => $filtered_input['email'],
        'password' => $filtered_input['password']
    ])) {
        return true;
    }

    $form['error'] = 'Suvesti neteisingi duomenys';

    return false;
}

// //////////////////////////////
// [2] FIELD VALIDATORS
// //////////////////////////////

/**
 * Check if email is available for registration, i.e. if it is not already taken
 *
 * @param string $field_value
 * @param array $field
 * @return bool
 */
function validate_user_unique(string $field_value, array &$field): bool
{
    $fileDB = new FileDB(DB_FILE);
    $fileDB->load();

    if ($fileDB->getRowWhere('users', ['email' => $field_value])) {
        $field['error'] = 'Email is already taken';

        return false;
    }

    return true;
}

/**
 *
 * Checks if coordinates already exists.
 * @param $form_values
 * @param array $form
 * @return bool
 * if not - returns false and error
 */

function validate_coordinates_pixels($form_values, &$form): bool
{
    $data = new FileDB(DB_FILE);
    $data->load();
    $coordinates_exist = $data->getRowWhere('coordinates', [
        'x' => $form_values['x'],
        'y' => $form_values['y']]);
    if ($coordinates_exist) {
        $form['error'] = 'These coordinates already taken';
        return false;
    }
    return true;
}

/**
 * Checks if values have already been written in database.
 *
 * @param array $form_values
 * @param array $form
 * @param array $params
 * @return bool
 */
function validate_field_coordinates(array $form_values, array &$form, array $params): bool
{
    $fileDB = new FileDB(DB_FILE);

    $fileDB->load();

    if ($fileDB->getRowWhere('coordinates', [
        $params[0] => $form_values[$params[0]],
        $params[1] => $form_values[$params[1]],
    ])) {
        $form['error'] = 'These coordinates are already taken';

        return false;
    }

    return true;
}
