(function() {

    var ids = {
        running_time: "running_time",
        running_time_top: "running_time_top",

        submit_test: "submit_test",
        totalQuestions: "totalQuestions",
        hiddenAssessmentId: "hiddenAssessmentId",
        urlroot: "urlroot"
    };

   
    var totalMilleSeconds = 30 * 60 * 1000;

    function submitForm() {
        var questions = [];
        var tempArray = [];
        var totalQuestions = parseInt($("#"+ids.totalQuestions).val());
        var assessmentId = parseInt($("#"+ids.hiddenAssessmentId).val());
        var currentId = 0;
        var urlroot = $("#"+ids.urlroot).val();
        $("input[type=radio]").each(function() {
            let name = $(this).attr("name");
            if(!tempArray.includes(name)) {
                tempArray.push("Include name: ", name);
                currentId = questions.push({id:  $(this).attr("name"), answer: 'none'});
            }
            if(this.checked == true)
                questions[--currentId].answer = $(this).val();
        });
     ajaxCall(urlroot +"/assessments/storeResults/", "POST", {assessmentId: assessmentId, questions: questions, totalQuestions: totalQuestions}, "json", false)
            .then((data) => {
                console.log("Data: ", data);
                switch (data.status) {
                    case "logout":
                        window.location.href = urlroot + "/users/logout";
                        break;
                    case "noMembership":
                        window.location.href = urlroot + "/page/home";
                        break;
                    case "notHaveAccessToThisAssessment":
                        window.location.href = urlroot + "/assessments/list";
                        break;
                    case "somethingUnexpectedHappened":
                        window.location.href = urlroot + "/assessments/list/";
                        break;
                    case "success":
                        window.location.href = urlroot + "/assessments/results/" + data.assessmentId;
                        break;
                    default:
                        window.location.href = urlroot + "/assessments/list/";
                        break;
                }
            })
            .catch((err) => {
                console.log("Error: ", err);
                // showErrorMessage("Something unexpected happened, please try again.", "error-message");
            });
    }

    document.addEventListener("DOMContentLoaded", function() {

        $("#"+ids.submit_test).on("click", () => {
            submitForm();
        });

    });

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

    setInterval(function() {
        totalMilleSeconds = totalMilleSeconds - 1000;
        $("#"+ids.running_time).html(msToTime(totalMilleSeconds));
        $("#"+ids.running_time_top).html(msToTime(totalMilleSeconds));
    }, 1000);

    setTimeout(function() {
        submitForm();
    }, totalMilleSeconds);

    function msToTime(duration) {
        var seconds = Math.floor((duration / 1000) % 60);
        var minutes = Math.floor((duration / (1000 * 60)) % 60);
        return minutes + "m : " + seconds + "s";
    }

})();