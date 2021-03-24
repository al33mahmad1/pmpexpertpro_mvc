import { AjaxCall } from "../modules/ajax/ajax.js";

(function() {

    var urlroot = "";
    var ids = {
        add_assessment_show_modal_btn: "add_assessment_show_modal_btn", 
        add_assessment_btn: "add_assessment_btn",

        add_assessment_modal: "add_assessment_modal",

        assessment_name: "assessment_name",
        assessment_category: "assessment_category",
        urlroot: "urlroot",
        success_message: "success_message"
    };

    var errorIds = {
        assessment_name_err: "assessment_name_err",
        assessment_category_err: "assessment_category_err",
        error_message: "error_message"
    };
    function requestHandler() {
        var assessmentName = $("#"+ids.assessment_name).val().trim();
        var assessmentCategory = $("#"+ids.assessment_category).val().trim();

        var assessmentNameErr = "";
        var assessmentCategoryErr = "";

        assessmentNameErr = validateAssessmentName(assessmentName);
        assessmentCategoryErr = validateAssessmentName(assessmentCategory);

        console.log(assessmentName);
        console.log(assessmentCategory);

        console.log(assessmentNameErr);
        console.log(assessmentCategoryErr);

        if(assessmentNameErr.length == 0 && assessmentCategoryErr.length == 0) {

            showLoading();
            var data = {assessmentName: assessmentName, assessmentCategory: assessmentCategory};
            var ajax = new AjaxCall(urlroot +"/assessments/add", "POST", data, "json");
            ajax.ajaxCall()
            .then((response) => {
                hideLoading();
                console.log(response);
                switch (response.status) {
                    case "logout":
                        window.location.href = urlroot + "/users/logout";
                        break;
                    case "notAdmin":
                        window.location.href = urlroot + "/pages/home";
                        break;
                    case "error":
                        $("#"+errorIds.assessment_name_err).text(response.assessmentNameErr);
                        $("#"+errorIds.assessment_category_err).text(response.assessmentCategoryErr);
                        break;
                    case "db_error":
                        hideModal();
                        showErrorMessage("Something unexpected happened, please refresh the page and try again!", errorIds.error_message);
                        break;
                    case "success":
                        showErrorMessage("New assessment created successfully!", ids.success_message);
                        break;
                    default:
                        break;
                }

            })
            .catch((error) => {
                console.log(error);
                hideLoading();
                hideModal();
                showErrorMessage("Something unexpected happened, please refresh the page and try again!", errorIds.error_message);
            });
        }
            
    }
   
    document.addEventListener("DOMContentLoaded", function() {
   
        urlroot = $("#"+ids.urlroot).val();

        document.querySelector("#"+ids.add_assessment_show_modal_btn).addEventListener("click", () => {
            clearModalInputs();
            getAndSetAssessmentCategories();
            $('#'+ids.add_assessment_modal).modal('show');
        });

        document.querySelector("#"+ids.add_assessment_btn).addEventListener("click", () => {
             requestHandler();
            // showLoading();

            // setTimeout(() =>{
            //     hideLoading();
            // }, 3000);
        });
        
        setTimeout(function() {
            $("#msg-flash").fadeOut("slow");
        }, 6000);

    });

    function validateAssessmentName(assessmentName) {
        console.log(assessmentName.length);
        if (assessmentName.length <= 0) {
            console.log("Show error");
            $("#"+errorIds.assessment_name_err).text("Valid assessment name required.");
            return "Minimum 8 characters or longer required.";
        }
        $("#"+ids.assessment_name_err).text("");
        return "";
    }

    function getAndSetAssessmentCategories() {
        return new Promise((resolve, reject) => {
            var ajax = new AjaxCall(urlroot +"/categories/fetchAll", "POST", {}, "json");
            ajax.ajaxCall()
            .then((response) => {
                switch (response.status) {
                    case 'logout':
                        window.location.href = urlroot + "/users/login";
                        break;
                    case 'notAdmin':
                        window.location.href = urlroot + "/pages/home";
                        break;
                    case 'success':
                        $.each(response.assessmentCategories, function(key, value) {   
                            $('#'+ids.assessment_category)
                            .append($("<option></option>")
                            .attr("value", value.assessment_category_id)
                            .text(value.assessment_category_name.capitalize())); 
                       });
                        break;
                    default:
                        break;
                }
            })
            .catch((error) => {
                console.log(error);
                showErrorMessage("Invalid Email or Password!", "error-message");
            });

        });
    }

    function clearModalInputs() {
        document.querySelector("#"+ids.assessment_name).value = "";
        document.querySelector("#"+errorIds.assessment_name_err).innerHTML = "";
        document.querySelector("#"+errorIds.assessment_category_err).innerHTML = "";
    }

    function showLoading() {
        $("#"+ids.add_assessment_btn).prop("disabled", true);
        $("#add-restaurant-btn").addClass("disabled");

        $("#add_res_show_hide_text").removeClass("show");
        $("#add_res_show_hide_text").addClass("hide");

        $("#loading_show_hide_text").removeClass("hide");
        $("#loading_show_hide_text").addClass("show");
    }

    function hideLoading() {
        $("#"+ids.add_assessment_btn).prop("disabled", false);
        $("#add-restaurant-btn").removeClass("disabled");

        $("#add_res_show_hide_text").removeClass("hide");
        $("#add_res_show_hide_text").addClass("show");

        $("#loading_show_hide_text").removeClass("show");
        $("#loading_show_hide_text").addClass("hide");
    }

    function hideModal() {
        clearModalInputs();
        $('#'+ids.add_assessment_modal).modal('hide');
    }

    function showErrorMessage(message, id) {
        $("#" + id).html(message);
        $("#" + id).fadeIn("slow");
        setTimeout(function() {
            $("#" + id).fadeOut("slow");
        }, 6000);
    }

})();