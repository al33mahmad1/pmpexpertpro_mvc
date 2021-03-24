(function() {

    document.addEventListener("DOMContentLoaded", function() {

        var ids = {
            first_time_test_button_start_btn: "first_time_test_button_start_btn", 
            first_time_take_test_heading: "first_time_take_test_heading",

            second_time_test_button_start_btn: "second_time_test_button_start_btn",
            second_time_show_report_button: "second_time_show_report_button",
            second_time_take_test_heading: "second_time_take_test_heading",

            taken_date: "taken_date",

            takeTestModal: "takeTestModal",
            takeTestAgainModal: "takeTestAgainModal"
        };
   
        document.querySelectorAll(".give_test_first_time").forEach(element => {
            element.addEventListener("click", () => {
                const assessmentId = $(element).attr("data-assessment-id");
                const assessmentCategoryId = $(element).attr("data-assessment-category-id");
                const examName = $(element).attr("data-exam-name");

                $("#"+ids.first_time_test_button_start_btn).attr("data-assessment-id", assessmentId);
                $("#"+ids.first_time_test_button_start_btn).attr("data-assessment-category-id", assessmentCategoryId);
                $("#"+ids.first_time_take_test_heading).html(examName);
                $("#"+ids.takeTestModal).modal("show");
           });
        });

        document.querySelectorAll(".retake_test").forEach(element => {
            element.addEventListener("click", () => {
                $("#"+ids.takeTestAgainModal).modal("show");
                const urlroot = $("#urlroot").val();
                const assessmentId = $(element).attr("data-assessment-id");
                const assessmentTakenId = $(element).attr("data-assessment-t-id");
                console.log(assessmentId);
               
                const takenDate = $(element).attr("data-date-taken");
                const assessmentCategoryId = $(element).attr("data-assessment-category-id");
                const examName = $(element).attr("data-exam-name");

                $("#"+ids.second_time_show_report_button).attr("data-assessment-id", assessmentId);
                $("#"+ids.second_time_show_report_button).attr("data-assessment-t-id", assessmentTakenId);
                $("#"+ids.second_time_show_report_button).attr("data-assessment-category-id", assessmentCategoryId);
                
                $("#"+ids.second_time_show_report_button).attr("href", urlroot + "/assessments/results/"+assessmentId);

                $("#"+ids.second_time_test_button_start_btn).attr("data-assessment-id", assessmentId);
                $("#"+ids.taken_date).text(takenDate);
                $("#"+ids.second_time_test_button_start_btn).attr("data-assessment-t-id", assessmentTakenId);
                $("#"+ids.second_time_test_button_start_btn).attr("data-assessment-category-id", assessmentCategoryId);
                $("#"+ids.second_time_take_test_heading).html(examName);
           });
        });

        document.querySelector("#first_time_test_button_start_btn").addEventListener("click", function() {

            const urlroot = document.querySelector("#urlroot").value;
            const assessmentId = $("#"+ids.first_time_test_button_start_btn).attr("data-assessment-id");
            const assessmentCategoryId = $("#"+ids.first_time_test_button_start_btn).attr("data-assessment-category-id");
            window.location.href = urlroot + "/assessments/take/"+assessmentId;
            
        });
        
        document.querySelector("#second_time_test_button_start_btn").addEventListener("click", function() {

            const urlroot = document.querySelector("#urlroot").value;
            const assessmentId = $("#"+ids.second_time_test_button_start_btn).attr("data-assessment-id");
            console.log(assessmentId);
            window.location.href = urlroot + "/assessments/take/"+assessmentId;
            
        });

    });

})();