<?php

namespace app\helpers;

class ErrorHelper
{

    /**
     * Prepare errors from array format to string
     * @param array $errors
     * @return string
     */
    public static function prepareErrors(array $errors = []): string
    {

        $errorsContainer = '';
        foreach ($errors as $field => $error) {
            $errorsContainer = $errorsContainer .' ' . $error[0];
        }

        return trim($errorsContainer);
    }
}