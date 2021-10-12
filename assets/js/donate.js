$(".select_method_button").click(function(){
	$(".select_method_button").removeClass('selected');
	$(this).addClass("selected");
	var id = $(this).attr('id');
	if(id=="monthly")
		$("#donate_method_text").html("Set up a monthly donation of:");
	else{
		$("#donate_method_text").html("Make a one off donation of:");

	}
})
$(".amount_select_btn").click(function(){
	$(".amount_select_btn").removeClass('selected');
	var value = $(this).attr('id');
	$("#input_donation_amount").val(parseInt(value));
	$(this).addClass("selected");
	donate_value = parseInt(value);
});
paypal.Button.render({
        // Configure environment
        env: 'production',
        //env: 'sandbox',
        client: {
          //sandbox: 'AUOIw9T0HlHoFXrskX2L8M6WWkbH_QhN2k3BtJRUlx0IBEen8S_mOVgdIJ5h2ml37Hc4GX2WTR9KDF0u',
          //production: 'ASAq7Q3AwES6JQ9Mc_Od5doolAQkzGxjyQ74oNA0LkBEbVz2eO38eLnNOF7iOMWWp6vsUcWjFGvsjTCJ'
          production: 'ARiEn-rP-QtqFV7bROZWlrinq2AEjkoNkOVB7EIpJ183yxM_nqPdOE5zCNeIa0rlw-F8MrRi1DeBsjFz'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
          size: 'responsive',
          color: 'blue',
          shape: 'rect',
          label:'paypal',
           tagline: false
        },

        validate: function(actions) {
          console.log("validate called");
          actions.disable(); // Allow for validation in onClick()
          paypalActions = actions; // Save for later enable()/disable() calls
        },
        onClick: function(data,actions){
           var err_msg = "";
            if(login_flag!="1"){
              $("#signin_modal").modal('show');
            }
            else{
              if (err_msg!=""){
                swal("Info",err_msg,"info");
              }
              else{
                paypalActions.enable();
              }
            }
        },
        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
            var value = parseFloat(donate_value);
             return actions.payment.create({
              transactions: [{
                amount: {
                  total: value,
                  currency: 'GBP',
                }
              }]
            });
         
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
          return actions.payment.execute().then(function() {

            $.ajax({
              url:"api/ajax.php",
              data: { 
                  request:'buy_donate',
                  user_id:user_id,
                  price:donate_value,
                 },
              async:false,
              type: 'post',
              success: function(re)
              {
                console.log(re);
                var result = JSON.parse(re);
                if(result['status']=="200"){

                  var data = {
                    service_id: YOUR_SERVICE_ID,
                    template_id: DONATION_TEMP_ID,
                    user_id: YOUR_USER_ID,
                    template_params: result['data']
                  };
  
                  $.ajax('https://api.emailjs.com/api/v1.0/email/send', {
                    type: 'POST',
                    data: JSON.stringify(data),
                    contentType: 'application/json'
                  }).done(function() {
                    console.log('Your mail is sent!');
                    swal("Success","Successfully Donated","success");
                  }).fail(function(error) {
                    console.log('Oops... ' + JSON.stringify(error));
                    swal("Success","Successfully Donated","success");
                  });
                }
              }
            });
          });
        }
      }, '#paypal-button');


