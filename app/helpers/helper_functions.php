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

    
    function sendEmailPHP($mail, $OTP) {
        $subject = "OTP For Password Reset";

        $message = "
        <html>
        <head>
        <title>OTP For Password Reset</title>
        </head>
        <body>
            <p>Password reset OTP: $OTP</p>
            <p>Ignore if you have not requested that.</p>
        </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From:support@pmpexpertpro.com' . "\r\n";

        try {
            return (mail($mail,$subject,$message,$headers));
        } catch (\Throwable $th) {
            return false;
        }
    }

    function generateOTP($length) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    function isValidatePassword($password) {
        $specialChars = preg_match('@[^\w]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
    
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8 || strlen($password) > 32)
            return false;
        return true;
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
        die(var_dump($data));
        echo "</pre>";
    }

    function containsId($id, $foo) {
        $found = current(array_filter($foo, function($item) use($id) {
            return isset($item['assessment_id']) && $id == $item['assessment_id']; 	
        }));
        if($found)
            return true;
        return false;
    }

    function senEmail($to, $password) {
        $subject = "Congratulations, You're all set!";
         
        $message = "Thank you for choosing PMPEXPERTPRO\r\nYour temporary password is: ".$password."\r\nAnd your email is: ".$to."\r\nPlease change your password in your dashboard.";
        $header = "From:support@pmpexpertpro.com \r\n";
     
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/plain\r\n";

        try {
            mail ($to,$subject,$message,$header);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    function startExam($id) {
		$_SESSION['PMP_EXAM_StARTED'] = true;
		$_SESSION['PMP_EXAM_STARTED_ID'] = $id;
    }

    function endExam() {
		$_SESSION['PMP_EXAM_StARTED'] = false;
		$_SESSION['PMP_EXAM_STARTED_ID'] = -1;
    }

    function isExamStarted() {
        return (isset($_SESSION['PMP_EXAM_StARTED']) && $_SESSION['PMP_EXAM_StARTED']);
    }