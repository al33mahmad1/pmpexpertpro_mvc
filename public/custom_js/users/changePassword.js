import { AjaxCall } from "../modules/ajax/ajax.js";

(function() {

    var ids = {
        change_password_btn: "change_password_btn",
        current_password: "current_password",
        change_password: "change_password",
        change_password_confirm: "change_password_confirm",
    };

    var errorIds = {
        error_message: "error-message"
    };

    function validatePassword(password) {

        if (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,30}$/.test(password)) {
            return true;
        }
        return false;

    }

    function showErrorMessage(message, id) {
    
        $("#" + id).html(message);
        $("#" + id).fadeIn("slow");
        setTimeout(function() {
            $("#" + id).fadeOut("slow");
        }, 5000);

    }
    
    function requestHandler() {
        var inputs = {
            current_password : document.querySelector("#"+ids.current_password).value,
            change_password : document.querySelector("#"+ids.change_password).value,
            change_password_confirm : document.querySelector("#"+ids.change_password_confirm).value,
        };

        const urlroot = document.querySelector("#urlroot").value;
        
        console.log(inputs);
        if(validatePassword(inputs.change_password) && validatePassword(inputs.change_password_confirm)) {
            if(inputs.change_password === inputs.change_password_confirm) {
                $("#error-message").fadeOut("slow");
                var d = {current_password: inputs.current_password, new_password: inputs.change_password, confirm_password: inputs.change_password_confirm}; 
                var ajax = new AjaxCall(urlroot +"/users/changePassword", "POST", d, "json");

                ajax.ajaxCall()
                .then((data) => {
                    console.log(data);
                    switch (data.status) {
                        case "logout":
                            window.location.href = urlroot + "/users/logout";
                            break;
                        case "InvalidNewPassword":
                            showErrorMessage("Passwords mush be min 8 and max 30 char long, and must contain!", errorIds.error_message);
                            break;
                        case "passwordsMismatch":
                            showErrorMessage("Passwords must match!", errorIds.error_message);
                            break;
                        case "invalidCurrentPassword":
                            showErrorMessage("Please provide valid current password!", errorIds.error_message);
                            break;
                        case "errorWhileUpdating":
                            showErrorMessage("Something unexpected happened, please try to reload and try again!", errorIds.error_message);
                            break;
                        case "samePasswords":
                            showErrorMessage("Current Password and new passwords must be different!", errorIds.error_message);
                            break;
                        case "success":
                            window.location.href = urlroot + "/users/logout/";
                            break;
                        default:
                            showErrorMessage("Something unexpected happened, please try to reload and try again!", errorIds.error_message);
                            break;
                    }
                })
                .catch((err) => {
                    console.log(err);
                    showErrorMessage("Invalid Email or Password!", errorIds.error_message);
                });

            } else {
                showErrorMessage("Passwords must match!", errorIds.error_message);
            }
        } else {
            showErrorMessage("Passwords mush be min 8 and max 30 char long, and must contain!", errorIds.error_message);
        }
    }
    
    document.addEventListener("DOMContentLoaded", function() {
    
        document.querySelector("#"+ids.change_password_btn).addEventListener("click", () => {
            requestHandler();
        });
    
    });
       
})();