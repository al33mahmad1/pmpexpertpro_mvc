export class AjaxCall {

    constructor(url, method, data, responseType="text") {
        this.url = url;
        this.method = method;
        this.data = data;
        this.responseType = responseType;
    }

    ajaxCall() {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: this.method,
                url: this.url,
                data: this.data,
                dataType: this.responseType,
                success: function(data) {
                    resolve(data);
                },
                error: function(err) {
                    reject(err);
                }
            });
        });
    }

}