<?php
    session_start();

    // Flash message helper
    // EXAMPLE - flash('register_success', 'You are now registered');
    // DISPLAY IN VIEW - echo flash('register_success');
    function flash($name = '', $message = '', $class = 'alert alert-success') {
        if(!empty($name)){
            if(!empty($message) && empty($_SESSION[$name])) {
            if(!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }

            if(!empty($_SESSION[$name. '_class'])){
                unset($_SESSION[$name. '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;
            } elseif(empty($message) && !empty($_SESSION[$name])){
            $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
            echo '<div class="'.$class.'  alert-dismissible fade show" id="msg-flash">'.$_SESSION[$name].'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name. '_class']);
            }
        }
    }

    function isLoggedIn() {

        $isSessionSet = (isset($_SESSION['PMP_USER_ID']))? true : false;
        if($isSessionSet) {
        if (isset($_SESSION['PMP_LAST_ACTIVITY']) && (time() - $_SESSION['PMP_LAST_ACTIVITY'] > TIMEOUT)) {
            return false;
        }
        $_SESSION['PMP_LAST_ACTIVITY'] = time();
        return true;
        }
        return $isSessionSet;

    }

    function isAdmin() {
        return ($_SESSION['PMP_USER_ROLE'] === 'admin');
    }

    function isBasicMembership() {
        return ($_SESSION['PMP_USER_MEMBERSHIP'] === 'basic');
    }
    
    // function isRestaurantAdmin() {
    //     return ($_SESSION['GF_USER_ROLE'] === 'admin');
    // }
    
    // function isEmployee() {
    //     return ($_SESSION['GF_USER_ROLE'] === 'employee');
    // }