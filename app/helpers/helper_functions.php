<?php
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function getBool($val) {
        return filter_var($val, FILTER_VALIDATE_BOOLEAN);
    }

    function timeStampToFormattedDate($timeStamp) {
        return date_format(date_create($timeStamp), ' F j, Y');
    }

    function timeStampToFormattedDateWithTime($timeStamp) {
        return date_format(date_create($timeStamp), ' F j, Y \a\t H:i:s A');
    }

    function isValidPassword($password) {
        $specialChars = preg_match('@[^\w]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        return !(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 || strlen($password) > 30);
    }

    function diee($data) {
        echo "<pre>";
        die(print_r($data));
        echo "</pre>";
    }