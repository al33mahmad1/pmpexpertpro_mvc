# Deployment Guide

* __Config File is needed to be updated.__
* __htaccess file inside public folder is also needed to be updated__

* $_SESSION['PMP_USER_ID'] = $user->id;
* $_SESSION['PMP_USER_NAME'] = $user->name;
* $_SESSION['PMP_USER_EMAIL'] = $user->email;
* $_SESSION['PMP_USER_ROLE'] = strtolower($user->roleType);
* $_SESSION['PMP_USER_MEMBERSHIP'] = strtolower($user->membership);
* $_SESSION['PMP_LAST_ACTIVITY'] = time();