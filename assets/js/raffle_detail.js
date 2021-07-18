var raffle_data;
var max_bid_amount = 0;
var total_price=0;
var price = 0;
var expire_flag=true;
get_auction_by_id();
function get_auction_by_id(){
    $.ajax({
          url:"api/ajax.php",
          data: { 
              request:'get_raffle_by_id',
              id:id
             },
          async:false,
          type: 'post',
          success: function(re) 
          {
            var result = JSON.parse(re);
            if(result['status']=="200"){
              raffle_data = result['data'];
              images = JSON.parse(result['data']['image']);
              var image_gallery_string = "";
              var model_image_gallery = "";
              var bottom_image_gallery = "";
              for(var i=0; i<images.length; i++){
                var n = i + 1;
                image_gallery_string+=`<li data-thumb="api/upload/raffle/`+id+`/`+images[i]+`"> 
                                            <img style="width:300px" src="api/upload/raffle/`+id+`/`+images[i]+`" onclick="openModal();currentSlide(`+n+`)" class="hover-shadow cursor" />
                                       </li>`;

                model_image_gallery+=`<div class="mySlides">
                                       <div class="numbertext">`+n+` / `+images.length+`</div>
                                       <img src="api/upload/raffle/`+id+`/`+images[i]+`">
                                     </div>`;

                bottom_image_gallery+=`<div class="column">
                                         <img class="demo_img cursor" src="api/upload/raffle/`+id+`/`+images[i]+`" onclick="currentSlide(`+n+`)">
                                       </div>`;
              }
              $("#terms_text").html(result['data']['terms']);
              $("#desc_text").html(result['data']['description']);
              $("#delivery_text").html(result['data']['delivery']);
              $("#image-gallery").html(image_gallery_string);
              $("#model-image-gallery").html(model_image_gallery);
              if(images.length > 1) {
                $("#bottom-image-gallery").html(bottom_image_gallery);
              }

              $("#price").html("£"+result['data']['price']);
              total_price = result['data']['price'];
              price = result['data']['price'];
              $("#total_price").html("£"+total_price);
              var end_date = new Date(result['data']['end_time']);
              var now   = new Date();
              var diff  = new Date(end_date - now);
              var days  = parseInt(diff/1000/60/60/24);
              var hours  = parseInt(diff/1000/60/60 - (days*24));
              
              var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
              var month = months[end_date.getMonth()];
              // var year = end_date.getFullYear();
              var day = end_date.getDate();
              var to  = day+" "+month;

                    var end_hour = end_date.getHours();
                    var end_min  = end_date.getMinutes();
                    var pm_am = end_hour>=12 ? 'PM' : 'AM';
                    var expir_date = days>0 ? days+"d"+" "+hours+"h left ( "+to+" "+end_hour+":"+end_min+" "+pm_am+ ")" : "Expired ( "+to+" "+end_hour+":"+end_min+" "+pm_am+ ")";

              expire_flag = days>0 ? true : false;

              $("#left_time").html(expir_date);
            }
            else{
            }
          }
    });     
}

function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo_img");
  //var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  //captionText.innerHTML = dots[slideIndex-1].alt;
}
    
$("#content-slider").lightSlider({
    loop:true,
    keyPress:true
});

$('#image-gallery').lightSlider({
    gallery:true,
    item:1,
    thumbItem:9,
    slideMargin: 0,
    speed:500,
    auto:true,
    loop:true,
    onSliderLoad: function() {
        $('#image-gallery').removeClass('cS-hidden');
    }  
});

$("#buy_button").click(function(){
    var err_msg = "";
    if(login_flag!="1")
        swal("Info","Please log in first","info");
});

$("#select_bid_amount").click(function(){
  var p_count = $(this).val();
  total_price = parseInt(p_count)*parseFloat(price);
  $("#total_price").html("£"+total_price);
});
var paypalActions;
paypal.Button.render({
        // Configure environment
        //env: 'production',
        env: 'sandbox',
        client: {
          sandbox: 'AUOIw9T0HlHoFXrskX2L8M6WWkbH_QhN2k3BtJRUlx0IBEen8S_mOVgdIJ5h2ml37Hc4GX2WTR9KDF0u',
          //production: 'ASAq7Q3AwES6JQ9Mc_Od5doolAQkzGxjyQ74oNA0LkBEbVz2eO38eLnNOF7iOMWWp6vsUcWjFGvsjTCJ'
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
            if(!expire_flag){
                //err_msg = "Time is already expired";
            }
            
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
            var value = parseFloat(total_price);
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
            var p_count = $("#select_bid_amount").val();

            $.ajax({
              url:"api/ajax.php",
              data: { 
                  request:'buy_raffle',
                  id:id,
                  user_id:user_id,
                  price:price,
                  buy_amount:p_count
                 },
              async:false,
              type: 'post',
              success: function(re)
              {
                var result = JSON.parse(re);
                if(result['status']=="200"){
  
                  var data = {
                    service_id: YOUR_SERVICE_ID,
                    template_id: RAFFLE_TEMP_ID,
                    user_id: YOUR_USER_ID,
                    template_params: result['data']
                  };
  
                  $.ajax('https://api.emailjs.com/api/v1.0/email/send', {
                    type: 'POST',
                    data: JSON.stringify(data),
                    contentType: 'application/json'
                  }).done(function() {
                    console.log('Your mail is sent!');
                    swal("Success","Successfully Bought","success");
                  }).fail(function(error) {
                    console.log('Oops... ' + JSON.stringify(error));
                    swal("Success","Successfully Bought","success");
                  });
                }
              }
            });
          });
        }
      }, '#paypal-button');