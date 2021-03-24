$(document).ready(function(){
    var FUNDING_SOURCES = [
        paypal.FUNDING.PAYPAL
    ];

    // Render the PayPal button into #paypal-button-container
    FUNDING_SOURCES.forEach(function(fundingSource) {

        // Initialize the buttons
        var button = paypal.Buttons({
            fundingSource: fundingSource,
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '39'
                        }
                    }]
                });
            },
            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    var object = {
                        name: details.payer.name.given_name,
                        surname: details.payer.name.surname,
                        email: details.payer.email_address,
                        amount: details.purchase_units[0].amount.value,
                        membershipType: "basic",
                        secret: "PAY_WITH_PAYPAL",
                    };

                    ajaxCall($("#urlroot").val() +"/users/addClient/", "POST", {data: object}, "json")
                    .then((data) => {
                        console.log("Data: ", data);
                        if(data.status == "success") {
                            window.location.href = $("#urlroot").val() +"/users/login?q=paid"
                        } else {
                            alert("something unexpected happened!");
                        }
                    })
                    .catch((err) => {
                        alert("something unexpected happened!");
                        console.log("Error: ", err);
                    });
                });
            },
            onError: function (err) {
                window.location.href = $("#urlroot").val() + "/errors/paymentError";
            }
        });

        // Check if the button is eligible
        if (button.isEligible()) {
            // Render the standalone button for that funding source
            button.render('#paypal-button-container');
        }

    });

  });
