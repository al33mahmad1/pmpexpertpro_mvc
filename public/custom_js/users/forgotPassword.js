(function() {

    var ids = {
        continue_btn: "continue_btn",
        password_continue_btn: "password_continue_btn",
        email: "email",
        email_err: "email_err",
        password: "password",
        confirm_password: "confirm_password",
        password_div: "password_div",
        email_div: "email_div",
        OTP_Model: "OTP_Model",
        submit_otp_btn: "submit_otp_btn",
        otp_code_1: "otp_code_1",
        otp_code_2: "otp_code_2",
        otp_code_3: "otp_code_3",
        otp_code_4: "otp_code_4",
        otp_err: "otp_err"
    };
    
    var urlroot= "";

    document.addEventListener("DOMContentLoaded", function() {

        var data = {
            email: "",
            otp: "",
            password: "",
            confirm_password: ""
        }

        urlroot = $("#urlroot").val();

        $("#"+ids.continue_btn).click(function(event) {

            event.preventDefault();
            data.email = $("#"+ids.email).val();
            console.log(data);
            if(ValidateEmail(data.email)) {
                ajaxCall(urlroot +"/users/validateIsUserAvailable/", "POST", {email: data.email}, "json")
                .then((data) => {
                    console.log("Data: ", data);
                    switch (data.status) {
                        case "invalidEmail":
                            showErrorMessage("Invalid email address, please enter valid one!", ids.email_err);
                            break;
                        case "success":
                            $("#"+ids.email_div).hide("slow");
                            $("#"+ids.password_div).show("slow");
                            break;
                    
                        default:
                            showErrorMessage("Invalid email address, please enter valid one!", ids.email_err);
                            break;
                    }
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });

            } else
                showErrorMessage("Invalid email address, please enter valid one!", ids.email_err);
        });

        $("#"+ids.password_continue_btn).click(function(event) {

            event.preventDefault();
            data.password = $("#"+ids.password).val();
            data.confirm_password = $("#"+ids.confirm_password).val();
            console.log(data);
            // 01: Validate Passwords is of Admin
            if(ValidatePassword(data.password)) {

                if(data.password === data.confirm_password) {
                    // Validate from server
                    ajaxCall(urlroot +"/users/validatePasswordAndSendOTP/", "POST", {email: data.email, password: data.password, confirm_password: data.confirm_password}, "json")
                    .then((data) => {
                        console.log("Data: ", data);
                        switch (data.status) {
                            case "invalid":
                                showErrorMessage("Invalid new password, please enter valid one!", ids.email_err);
                                break;
                            case "invalidMismatch":
                                showErrorMessage("Invalid confirm password, passwords must match!", ids.email_err);
                                break;
                            case "invalidEmail":
                                $("#"+ids.email_div).show("slow");
                                $("#"+ids.password_div).hide("slow");
                                showErrorMessage("Invalid email address, please enter valid one!", ids.email_err);
                                break;
                            case "DBException":
                                showErrorMessage("Something unexpected happened on server side, Please try again!", ids.email_err);
                                break;
                            case "errorWhileSendingEmail":
                                showErrorMessage("We are facing error while sending you OTP! Sorry! please try again.", ids.email_err);
                                break;
                            case "success":
                                console.log("success, OTP sent");
                                $("#"+ids.OTP_Model).modal("show");
                                break;
                        }
                    })
                    .catch((err) => {
                        console.log("Error: ", err);
                    });

                } else {
                    showErrorMessage("Passwords must match, add upper case lowercase and special characters min 8 and max 32 length!", ids.email_err);
                }
                
            } else
                showErrorMessage("Invalid new password, add upper case lowercase and special characters min 8 and max 32 length!", ids.email_err);

        });

        // OTP SUBMIT
        $("#"+ids.submit_otp_btn).click(function(event) {

            event.preventDefault();
            var temp = '';
            temp = $("#"+ids.otp_code_1).val().trim();
            temp += $("#"+ids.otp_code_2).val().trim();
            temp += $("#"+ids.otp_code_3).val().trim();
            temp += $("#"+ids.otp_code_4).val().trim();
            data.otp = temp;
            if(data.otp.length === 4 || data.otp.length === "4") {

                // Validate from server
                ajaxCall(urlroot +"/users/changePasswordWithOTP/", "POST", {email: data.email, password: data.password, confirm_password: data.confirm_password, OTP: data.otp}, "json")
                .then((data) => {
                    console.log("Data: ", data);
                    switch (data.status) {
                        case "invalid":
                            $("#"+ids.OTP_Model).modal("hide");
                            showErrorMessage("Invalid new password, please enter valid one!", ids.email_err);
                            break;
                        case "invalidMismatch":
                            $("#"+ids.OTP_Model).modal("hide");
                            showErrorMessage("Invalid confirm password, passwords must match!", ids.email_err);
                            break;
                        case "invalidEmail":
                            $("#"+ids.OTP_Model).modal("hide");
                            $("#"+ids.email_div).show("slow");
                            $("#"+ids.password_div).hide("slow");
                            showErrorMessage("Invalid email address, please enter valid one!", ids.email_err);
                            break;
                        case "otpInvalid":
                            showErrorMessage("Invalid OPT, please provide 4 digit code send to you on email!", ids.otp_err);
                            break;
                        case "passwordResetNotRequested":
                            showErrorMessage("No password reset requested!", ids.otp_err);
                            break;
                        case "OTPMismatch":
                            showErrorMessage("Invalid OPT, please provide 4 digit code send to you on email!", ids.otp_err);
                            break;
                        case "OTPTimeOut":
                            $("#"+ids.OTP_Model).modal("hide");
                            $("#"+ids.email_div).show("slow");
                            $("#"+ids.password_div).hide("slow");
                            showErrorMessage("OTP Expired, please try again!", ids.email_err);
                            break;
                        case "DBException":
                            showErrorMessage("Something unexpected happened on server side, Please try again!", ids.otp_err);
                            break;
                        case "success":
                            console.log("success, OTP sent");
                            $("#"+ids.OTP_Model).modal("hide");
                            window.location.href = urlroot + "/users/login?q=pwdChanged";
                            break;
                    }
                })
                .catch((err) => {
                    console.log("Error: ", err);
                });

            } else
                showErrorMessage("Invalid OTP Provided!", ids.otp_err);
        });
    });
    

    function ValidateEmail(email) {
        return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email));
    }

    function ValidatePassword(password) {
        return (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,30}$/.test(password));
    }
    
    function ajaxCall(url, method, data, responseType="text") {
    
        return new Promise((resolve, reject) => {
            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: responseType,
                success: function(data) {
                    resolve(data);
                },
                error: function(err) {
                    reject(err);
                }
            });
        });
        
    }

    function showErrorMessage(message, id) {
        $("#" + id).html(message);
        $("#" + id).fadeIn("slow");
        setTimeout(function() {
            $("#" + id).fadeOut("slow");
        }, 6000);
    }

}());