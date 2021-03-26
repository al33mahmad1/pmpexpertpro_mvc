import { AjaxCall } from "../modules/ajax/ajax.js";

(function() {

    var ids = {
        edit_question_btn: "edit_question_btn", 
        assessment_id: "assessment_id",
        section_id: "section_id",
        question_statement: "question_statement",
        option_a: "option_a",
        option_b: "option_b",
        option_c: "option_c",
        option_d: "option_d",
        correct_option: "correct_option",
        question_reasoning: "question_reasoning",

        question_id: "question_id"
    };

    var urlroot = "";

    var errorIds = {
        assessment_id_err: "assessment_id_err",
        category_id_err: "category_id_err",
        question_statement_err: "question_statement_err",
        option_a_err: "option_a_err",
        option_b_err: "option_b_err",
        option_c_err: "option_c_err",
        option_d_err: "option_d_err",
        option_d_err: "option_d_err",
        correct_option_err: "correct_option_err",
        question_reasoning_err: "question_reasoning_err",

        error_message: "error_message",
        success_message: "success_message",
    };
    document.addEventListener("DOMContentLoaded", function() {
        urlroot = $("#urlroot").val();
        document.querySelector("#"+ids.edit_question_btn).addEventListener("click", () => {
             requestHandler();
        });
        
         setTimeout(function() {
             $("#msg-flash").fadeOut("slow");
         }, 6000);
     
     });

   
    
    function requestHandler() {
       
        var inputs = {
            assessment_id : $("#"+ids.assessment_id).val().trim(),
            section_id : $("#"+ids.section_id).val().trim(),
            question_statement: $("#"+ids.question_statement).val().trim(),
            option_a : $("#"+ids.option_a).val().trim(),
            option_b : $("#"+ids.option_b).val().trim(),
            option_c : $("#"+ids.option_c).val().trim(),
            option_d : $("#"+ids.option_d).val().trim(),
            correct_option : $("#"+ids.correct_option).val().trim(),
            question_reasoning : $("#"+ids.question_reasoning).val().trim(),
            
            question_id: $("#"+ids.question_id).val().trim(),
        };
    
        var errors = {
            assessment_id_err: (inputs.assessment_id.length <= 0)? "Invalid exam selected!" : "",
            section_id_err: (inputs.section_id.length <= 0)? "Invalid category select!" : "",
            question_statement_err: (inputs.question_statement.length <= 0)? "Question statement is required!" : "",
            option_a_err: (inputs.option_a.length <= 0)? "Options A Required!" : "",
            option_b_err: (inputs.option_b.length <= 0)? "Options B Required!" : "",
            option_c_err: (inputs.option_c.length <= 0)? "Options C Required!" : "",
            option_d_err: (inputs.option_d.length <= 0)? "Options D Required!" : "",
            correct_option_err: (inputs.correct_option.length <= 0)? "Correct Options is Required!" : "",
            question_reasoning_err: (inputs.question_reasoning.length <= 0)? "A valid reasoning statement for question is required!" : ""
        };

        // console.log(inputs);
        // console.log(errors);
        // return;

        if(errors.assessment_id_err.length == 0 && errors.section_id_err.length == 0 && errors.question_statement_err.length == 0 && errors.option_a_err.length == 0 && errors.option_b_err.length == 0 && errors.option_c_err.length == 0 && errors.option_d_err.length == 0 && errors.correct_option_err.length == 0 && errors.question_reasoning_err.length == 0) {

            var ajax = new AjaxCall(urlroot +"/questions/editQuestion", "POST", inputs, "json");
            ajax.ajaxCall()
            .then((response) => {
                console.log("Data: ", response);

                switch (response.status) {
                    case "logout":
                        window.location.href = urlroot + "/users/logout";
                        break;
                    case "notAdmin":
                        window.location.href = urlroot + "/pages/home";
                        break;
                    case "invalidQuestionId":
                        window.location.href = urlroot + "/questions/list";
                        break;
                    case "error":
                        $("#"+errorIds.assessment_id_err).text(response.assessmentIdErr);
                        $("#"+errorIds.section_id_err).text(response.sectionIdErr);
                        $("#"+errorIds.question_statement_err).text(response.questionStatementErr);
                        $("#"+errorIds.option_a_err).text(response.optionAErr);
                        $("#"+errorIds.option_b_err).text(response.optionBErr);
                        $("#"+errorIds.option_c_err).text(response.optionCErr);
                        $("#"+errorIds.option_d_err).text(response.optionDErr);
                        $("#"+errorIds.correct_option_err).text(response.correctOptionErr);
                        $("#"+errorIds.question_reasoning_err).text(response.questionReasoningErr);
                        break;
                    case "db_error":
                        scrollToTopOfWindow();
                        showErrorMessage("Something unexpected happened, please refresh the page and try again!", errorIds.error_message);
                        break;
                    case "success":
                        window.location.href = urlroot + "/questions/list";
                        // showErrorMessage("Question updated successfully!", errorIds.success_message);
                        break;
                    default:
                        break;
                }
            })
            .catch((err) => {
                console.log("Error: ", err);
                scrollToTopOfWindow();
                showErrorMessage("Something unexpected happened, please refresh the page and try again!", errorIds.error_message);
            });
        } else {
            showInputError(errorIds.assessment_id_err, errors.assessment_id_err);
            showInputError(errorIds.section_id_err, errors.section_id_err);
            showInputError(errorIds.question_statement_err, errors.question_statement_err);
            showInputError(errorIds.option_a_err, errors.option_a_err);
            showInputError(errorIds.option_b_err, errors.option_b_err);
            showInputError(errorIds.option_c_err, errors.option_c_err);
            showInputError(errorIds.option_d_err, errors.option_d_err);
            showInputError(errorIds.correct_option_err, errors.correct_option_err);
            showInputError(errorIds.question_reasoning_err, errors.question_reasoning_err);
        }
    }

    function showInputError(id, msg) {
        $("#"+id).text(msg);
    }

    function showErrorMessage(message, id) {
    
        $("#" + id).html(message);
        $("#" + id).fadeIn("slow");
        setTimeout(function() {
            $("#" + id).fadeOut("slow");
        }, 6000);
    }

}());