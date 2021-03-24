// import { AjaxCall } from "../modules/ajax/ajax.js";

// (function() {

//     var ids = {
//         delete_question_modal: "delete_question_modal",
//         delete_question_yes_btn: "delete_question_yes_btn",

//         table_main_row_: "table_main_row_",
//         table_expansion_row_: "table_expansion_row_",
//     };

//     var urlroot = "";

//     var classes = {
//         show_delete_question_modal_btn: "show_delete_question_modal_btn",
//     };

//     $(document).ready(function() {
//             console.log("exec");
//         const urlroot = $("#urlroot").val();
//         // setTimeout(function() {
       
//         //     document.querySelectorAll("." + classes.show_delete_question_modal_btn).forEach(element => {
//         //         console.log("exec");
//         //         element.addEventListener("click", () => {
//         //             const questionId = $(element).attr("data-question-id");
//         //             $("#"+ids.delete_question_yes_btn).attr("data-question-id", questionId);
//         //             $("#"+ids.delete_question_modal).modal("show");
//         //         });
//         //     });

//         // }, 5000);
        
//         // document.querySelector("#"+ids.delete_question_yes_btn).addEventListener("click", function() {

//         //     const questionId = $("#"+ids.delete_question_yes_btn).attr("data-question-id");
//         //     alert(questionId);
//         //     // var ajax = new AjaxCall(urlroot +"/questions/delete/", "POST", {questionId: questionId}, "json");
//         //     // ajax.ajaxCall()
//         //     ajaxCall(urlroot +"/questions/delete/", "POST", {questionId: questionId}, "json")
//         //     .then((data) => {
//         //         console.log("Data: ", data);
//         //         switch (data.status) {
//         //             case "logout":
//         //                 window.location.href = urlroot + "/users/logout";
//         //                 break;
//         //             case "notAdmin":
//         //                 window.location.href = urlroot + "/pages/home";
//         //                 break;
//         //             case "invalidQuestionId":
//         //                 hideModal();
//         //                 scrollToTopOfWindow();
//         //                 showErrorMessage("Something unexpected happened, please refresh the page and try again!", "error_message");
//         //                 break;
//         //             case "db_error":
//         //                 hideModal();
//         //                 scrollToTopOfWindow();
//         //                 showErrorMessage("Something unexpected happened, please refresh the page and try again!", "error_message");
//         //                 break;
//         //             case "success":
//         //                 hideModal();
//         //                 scrollToTopOfWindow();
//         //                 showErrorMessage("Question deleted successfully!", "success_message");
//         //                 $("#"+ids.table_main_row_+""+data.questionId).remove();
//         //                 $("#"+ids.table_expansion_row_+""+data.questionId).remove();
//         //                 break;
//         //             default:
//         //                 break;
//         //         }
//         //     })
//         //     .catch((err) => {
//         //         console.log("Error: ", err);
//         //         showErrorMessage("Something unexpected happened, please try again.", "error-message");
//         //     });

//         // });
//     });

//     function showErrorMessage(message, id) {
    
//         $("#" + id).html(message);
//         $("#" + id).fadeIn("slow");
//         setTimeout(function() {
//             $("#" + id).fadeOut("slow");
//         }, 6000);
//     }

//     function hideModal() {
//         $("#"+ids.delete_question_modal).modal("hide");
//     }

//     function ajaxCall(url, method, data, responseType="text", async = true) {
   
//         return new Promise((resolve, reject) => {
//                 $.ajax({
//                     url: url,
//                     method: method,
//                     data: data,
//                     async: async,
//                     dataType: responseType,
//                     success: function(data) {
//                         resolve(data);
//                     },
//                     error: function(err) {
//                         reject(err);
//                     }
//                     });
//             });
//         }
    

// })();

var ids = {
    delete_question_modal: "delete_question_modal",
    delete_question_yes_btn: "delete_question_yes_btn",

    table_main_row_: "table_main_row_",
    table_expansion_row_: "table_expansion_row_",
};

var urlroot = "";

var classes = {
    show_delete_question_modal_btn: "show_delete_question_modal_btn",
};

$(document).ready(function() {
    urlroot = $("#urlroot").val();
});

function showErrorMessage(message, id) {

    $("#" + id).html(message);
    $("#" + id).fadeIn("slow");
    setTimeout(function() {
        $("#" + id).fadeOut("slow");
    }, 6000);
}

function hideModal() {
    $("#"+ids.delete_question_modal).modal("hide");
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

function openModal(id) {
    const questionId =id;
    $("#delete_question_yes_btn").attr("data-question-id", questionId);
    $("#delete_question_modal").modal("show");
}

function editQuestion(id) {
    window.location.href = $("#urlroot").val() + "/questions/edit/" + id;
}

function deleteQuestion(id) {
    const questionId = $("#"+ids.delete_question_yes_btn).attr("data-question-id");
    // alert(questionId);
    // console.log(urlroot);
    // return;
    ajaxCall(urlroot +"/questions/delete/", "POST", {questionId: questionId}, "json")
    .then((data) => {
        // console.log("Data: ", data);
        switch (data.status) {
            case "logout":
                window.location.href = urlroot + "/users/logout";
                break;
            case "notAdmin":
                window.location.href = urlroot + "/pages/home";
                break;
            case "invalidQuestionId":
                hideModal();
                scrollToTopOfWindow();
                showErrorMessage("Something unexpected happened, please refresh the page and try again!", "error_message");
                break;
            case "db_error":
                hideModal();
                scrollToTopOfWindow();
                showErrorMessage("Something unexpected happened, please refresh the page and try again!", "error_message");
                break;
            case "success":
                hideModal();
                scrollToTopOfWindow();
                showErrorMessage("Question deleted successfully!", "success_message");
                $("#"+ids.table_main_row_+""+data.questionId).remove();
                $("#"+ids.table_expansion_row_+""+data.questionId).remove();
                break;
            default:
                break;
        }
    })
    .catch((err) => {
        hideModal();
        console.log("Error: ", err);
        showErrorMessage("Something unexpected happened, please try again.", "error_message");
    });

}