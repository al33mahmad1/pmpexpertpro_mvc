import { AjaxCall } from "../modules/ajax/ajax.js";

(function() {

    function ValidateEmail(mail) {

        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
           return true;
        }
        return false;

    }
       
    function ValidatePassword(password) {

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
        }, 6000);

    }
    
    function requestHandler() {
        var email = document.querySelector("#email").value;
        var password = document.querySelector("#password").value;
        var urlroot = document.querySelector("#urlroot").value;
        
        if(ValidateEmail(email)) {
            // Made a post request to login controller
            if(ValidatePassword(password)) {
                $("#error-message").fadeOut("slow");
                // showErrorMessage("Made ajax call", "error-message");
                var d = {email: email, password: password}; 
                var ajax = new AjaxCall(urlroot +"/users/validate", "POST", d, "json");

                ajax.ajaxCall()
                .then((data) => {
                    console.log(data);
                    switch (data.status) {
                        case "invalid":
                            showErrorMessage("Invalid Email or Password!", "error-message");
                            break;
                        case "disabled":
                            showErrorMessage("Account disabled temporarily!", "error-message-disabled");
                            break;
                        case "accountDisabled":
                            showErrorMessage("Account disabled temporarily!", "error-message-disabled");
                            break;
                        default:
                            showErrorMessage("Login Success! Redirecting...", "error-message-success");
                            window.location.href = urlroot + "/pages/index/";
                            break;
                    }
                })
                .catch((err) => {
                    console.log(err);
                    showErrorMessage("Invalid Email or Password!", "error-message");
                });
    
            } else {
                showErrorMessage("Invalid Email or Password!", "error-message");
            }
        } else {
            showErrorMessage("Invalid Email or Password!", "error-message");
        }
    }

    
    document.addEventListener("DOMContentLoaded", function() {
    
        document.querySelector("#login").addEventListener("click", () => {
            requestHandler();
        });
    
        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                requestHandler();
            }
        });
    
    });
       
})();