(function() {

    var ids = {
        running_time: "running_time",
        running_time_top: "running_time_top",

        submit_test: "submit_test"
    };
    var totalMilleSeconds = 30 * 60 * 1000;

    document.addEventListener("DOMContentLoaded", function() {

        $("#"+ids.submit_test).on("click", () => {
            result = "success";
            $("input[type=radio]:checked").each(function() {
                console.log($(this).attr("name"), this.value);
              if(this.value == "No" && this.checked == true)
              {
                 result = "fail";
                 return false;
              }
            });
            // const assessmentId = $(element).attr("data-assessment-id");
            // const assessmentCategoryId = $(element).attr("data-assessment-category-id");
            // const examName = $(element).attr("data-exam-name");

            // $("#"+ids.first_time_test_button_start_btn).attr("data-assessment-id", assessmentId);
            // $("#"+ids.first_time_test_button_start_btn).attr("data-assessment-category-id", assessmentCategoryId);
            // $("#"+ids.first_time_take_test_heading).html(examName);
            // $("#"+ids.takeTestModal).modal("show");
        });

        // document.querySelectorAll(".retake_test").forEach(element => {
        //     element.addEventListener("click", () => {
        //         const assessmentId = $(element).attr("data-assessment-id");
        //         const assessmentTakenId = $(element).attr("data-assessment-t-id");
        //         const assessmentCategoryId = $(element).attr("data-assessment-category-id");
        //         const examName = $(element).attr("data-exam-name");

        //         $("#"+ids.second_time_show_report_button).attr("data-assessment-id", assessmentId);
        //         $("#"+ids.second_time_show_report_button).attr("data-assessment-t-id", assessmentTakenId);
        //         $("#"+ids.second_time_show_report_button).attr("data-assessment-category-id", assessmentCategoryId);
                
        //         $("#"+ids.second_time_test_button_start_btn).attr("data-assessment-id", assessmentId);
        //         $("#"+ids.second_time_test_button_start_btn).attr("data-assessment-t-id", assessmentTakenId);
        //         $("#"+ids.second_time_test_button_start_btn).attr("data-assessment-category-id", assessmentCategoryId);
        //         $("#"+ids.second_time_take_test_heading).html(examName);
        //         $("#"+ids.takeTestAgainModal).modal("show");
        //    });
        // });
        
        // document.querySelector("#first_time_test_button_start_btn").addEventListener("click", function() {

        //     const urlroot = document.querySelector("#urlroot").value;
        //     const assessmentId = $("#"+ids.first_time_test_button_start_btn).attr("data-assessment-id");
        //     const assessmentCategoryId = $("#"+ids.first_time_test_button_start_btn).attr("data-assessment-category-id");
        //     console.log(assessmentId);
        //     console.log(assessmentCategoryId);

        //     window.location.href = urlroot + "/assessments/take/"+assessmentId;
        //     // Make ajax call to change status of 
        //     // ajaxCall(urlroot +"/restaurants/updateRestaurantStatus/"+resId, "POST", {status: status}, "json", false)
        //     // .then((data) => {
        //     //     // console.log("Data: ", data);
        //     //     switch (data.message) {
        //     //         case "logout":
        //     //             window.location.href = urlroot + "/users/logout";
        //     //             break;
        //     //         case "error404":
        //     //             window.location.href = urlroot + "/errors/error404";
        //     //             break;
        //     //         case "notAdmin":
        //     //             window.location.href = urlroot + "/owners/index";
        //     //             break;
        //     //         case "db_error":
        //     //             window.location.href = urlroot + "/errors/error404";
        //     //             break;
        //     //         case "success":
        //     //             window.location.href = urlroot;
        //     //             break;
        //     //         default:
        //     //             break;
        //     //     }
        //     // })
        //     // .catch((err) => {
        //     //     console.log("Error: ", err);
        //     //     // showErrorMessage("Something unexpected happened, please try again.", "error-message");
        //     // });

        // });
    });

    // function ajaxCall(url, method, data, responseType="text", async = true) {
   
    //     return new Promise((resolve, reject) => {
    //         $.ajax({
    //             url: url,
    //             method: method,
    //             data: data,
    //             async: async,
    //             dataType: responseType,
    //             beforeSend: function(){
    //                 document.body.style.cursor = "wait";
    //             },
    //             success: function(data) {
    //                 // console.log("Ajax Success", data);
    //                 document.body.style.cursor = "default";
    //                 resolve(data);
    //             },
    //             error: function(err) {
    //                 // console.log("Ajax Error", err);
    //                 document.body.style.cursor = "default";
    //                 reject(err);
    //             }
    //         });
    //     });
        
    // }

    setInterval(function() {
        totalMilleSeconds = totalMilleSeconds - 1000;
        $("#"+ids.running_time).html(msToTime(totalMilleSeconds));
        $("#"+ids.running_time_top).html(msToTime(totalMilleSeconds));

    }, 1000);

    setTimeout(function() {
        alert("submit exam");
    }, totalMilleSeconds);

    function msToTime(duration) {
        var seconds = Math.floor((duration / 1000) % 60);
        var minutes = Math.floor((duration / (1000 * 60)) % 60);
        return minutes + "m : " + seconds + "s";
    }

})();