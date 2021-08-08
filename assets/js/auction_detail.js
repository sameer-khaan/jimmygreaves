var auction_data;
var max_bid_amount = 0;
var expire_flag=true;
get_auction_by_id();
get_biders();
function get_auction_by_id(){
    $.ajax({
          url:"api/ajax.php",
          data: { 
              request:'get_auction_by_id',
              id:id
             },
          async:false,
          type: 'post',
          success: function(re) 
          {
            var result = JSON.parse(re);
            if(result['status']=="200"){
              auction_data = result['data'];
              images = JSON.parse(result['data']['image']);
              full_images = result['data']['image_full'];
              var image_gallery_string = "";
              var model_image_gallery = "";
              var bottom_image_gallery = "";
              for(var i=0; i<images.length; i++){
                var n = i + 1;
                image_gallery_string+=`<li data-thumb="api/upload/auction/`+id+`/`+images[i]+`"> 
                                            <img class="img-thumbnail" style="width:300px" src="api/upload/auction/`+id+`/`+images[i]+`" onclick="openAuctionModal();currentSlide(`+n+`)" class="hover-shadow cursor" />
                                       </li>`;

                if(full_images.includes(images[i])) {
                  var img_url = 'api/upload/auction/'+id+'/fullsize/'+images[i];
                }
                else {
                  var img_url = 'api/upload/auction/'+id+'/'+images[i];
                }
                model_image_gallery+=`<div class="mySlides">
                                        <div class="numbertext">`+n+` / `+images.length+`</div>
                                        <img src="`+img_url+`">
                                      </div>`;

                bottom_image_gallery+=`<div class="column">
                                          <img class="demo_img cursor" src="api/upload/auction/`+id+`/`+images[i]+`" onclick="currentSlide(`+n+`)">
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
          }
    });     
}

function openAuctionModal() {
  $("#auction_slider_modal").modal('show');
  //document.getElementById("myModal").style.display = "block";
}

// function closeModal() {
//   document.getElementById("myModal").style.display = "none";
// }

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
  if(dots.length > 0) {
    dots[slideIndex-1].className += " active";
  }
  //captionText.innerHTML = dots[slideIndex-1].alt;
}

function get_biders(){
    $.ajax({
          url:"api/ajax.php",
          data: { 
              request:'get_biders',
              id:id
             },
          async:false,
          type: 'post',
          success: function(re) 
          {
            var result = JSON.parse(re);
            if(result['status']=="200"){
                $(".bid_count").html(result['data'].length+" bids");
                var string = "";
                for(var i=0; i<result['data'].length; i++){
                    string +=`<div>
                                <p id="bid_amount_modal">£`+result['data'][i]['bid_amount']+`</p>
                                <p id="bid_time">`+result['data'][i]['bid_time']+`</p>
                            </div>`;
                    if(max_bid_amount<result['data'][i]['bid_amount'])
                        max_bid_amount=result['data'][i]['bid_amount'];
                }

                $("#current_bids_div").html(string);
                $("#max_current_bid_amount").html(`£`+max_bid_amount+``);
                var placeholder_value = parseInt(max_bid_amount) + 1
                $("#input_bid_amount").attr('placeholder',`£`+placeholder_value+``);
                $("#bid_amount_desc").html('Enter £'+placeholder_value+' or more')
            }
            else{
                max_bid_amount = auction_data['init_price'];
                var placeholder_value = parseInt(auction_data['init_price']) + 1

                $(".bid_count").html("0 bids");
                $("#max_current_bid_amount").html(`£`+auction_data['init_price']+``);
                $("#input_bid_amount").attr('placeholder',`£`+placeholder_value+``);
                $("#bid_amount_desc").html('Enter £'+placeholder_value+' or more')
            }
          }
    });
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

$("#bid_status").click(function(){
    $("#bid_status_modal").modal('show');
});


$(".bid_button").click(function(){
    var bid_amount = $("#input_bid_amount").val();
    var err_msg = "";
    if(login_flag!="1")
      $("#signin_modal").modal('show');
    else{
      if(bid_amount<=max_bid_amount)
          err_msg = "Current bid amount is "+max_bid_amount+". Please input bigger amount than current bid amount.";
      else if(bid_amount=="" || bid_amount==0){
          err_msg = "Please input bid amount";
      }
      else if(!expire_flag){
          err_msg = "Time is already expired";
      }
      
      if(err_msg!="")
          swal("Error",err_msg,"error");
      else{
             $.ajax({
                url:"api/ajax.php",
                data: { 
                    request:'save_bid',
                    id:id,
                    user_id:user_id,
                    bid_amount:bid_amount,
                   },
                async:false,
                type: 'post',
                success: function(re) 
                {
                  var result = JSON.parse(re);
                  if(result['status']=="200"){

                    var data = {
                      service_id: YOUR_SERVICE_ID,
                      template_id: AUCTION_TEMP_ID,
                      user_id: YOUR_USER_ID,
                      template_params: result['data']
                    };
  
                    $.ajax('https://api.emailjs.com/api/v1.0/email/send', {
                      type: 'POST',
                      data: JSON.stringify(data),
                      contentType: 'application/json'
                    }).done(function() {
                        console.log('Your mail is sent!');
                        swal("Success","Successfully submit your bid","success");
                        get_auction_by_id();
                        get_biders();
                    }).fail(function(error) {
                        console.log('Oops... ' + JSON.stringify(error));
                        swal("Success","Successfully submit your bid","success");
                        get_auction_by_id();
                        get_biders();
                    });
                  }
                }
          });     
      }
    }
});