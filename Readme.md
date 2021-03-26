# Deployment Guide and Features

* __Config File is needed to be updated.__
* __htaccess file inside public folder is also needed to be updated__

* $_SESSION['PMP_USER_ID'] = $user->id;
* $_SESSION['PMP_USER_NAME'] = $user->name;
* $_SESSION['PMP_USER_EMAIL'] = $user->email;
* $_SESSION['PMP_USER_ROLE'] = strtolower($user->roleType);
* $_SESSION['PMP_USER_MEMBERSHIP'] = strtolower($user->membership);
* $_SESSION['PMP_LAST_ACTIVITY'] = time();
* $_SESSION['PMP_EXAM_StARTED']
* $_SESSION['PMP_EXAM_StARTED_ID']

## Features V 1.0.0

* Admin Panel for management
* Registration on Paypal Payments
* Signin for users and admin
* Four Types of memberships
  * Basic
  * Scrum
  * Agile Premium
  * Agile Scrum Premium
* Exams Module
  * Take Exams
  * Retake Exams
  * View Results & Reports
  * Add new Exam (Only Admin)
* Questions Module with CRUD
* Forgot Password
* Reset Password
