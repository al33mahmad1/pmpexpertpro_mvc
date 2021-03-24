function checkboxChanged() {
    if($("#checkbox").prop('checked') == true) {
        $("#paypal_btn_div").show("slow");
    } else {
        $("#paypal_btn_div").hide("slow");
    }
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