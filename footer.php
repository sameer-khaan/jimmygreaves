<footer class="py-4 px-5" id="footer" style="margin-top: auto">
    <div class="container row">
        <div class="col-md-8">
            <img src="assets/img/logo1.png" style="width:155px" />
            <div class="social_div" style="display:flex; margin-top:10px; justify-content: center; width:155px">
                <div style="width:36px; height:36px; border-radius:36px; background-color:#586370; margin-right:15px; margin-left:10px "></div>
                <div style="width:36px; height:36px; border-radius:36px; background-color:#586370; margin-right:15px "></div>
                <div style="width:36px; height:36px; border-radius:36px; background-color:#586370; margin-right:15px "></div>
        </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <li>
                        <a href="<?php echo $site_url?>auction.php">Auction</a>
                    </li>
                    <li>
                        <a href="<?php echo $site_url?>raffle.php">Raffle</a>
                    </li>
                    <li>
                        <a href="<?php echo $site_url?>donate.php">Donate</a>
                    </li>
                </div>
                <div class="col-md-6">
                    <li>
                        <a href="<?php echo $site_url?>about.php">About</a>
                    </li>
                    <li>
                        <a href="<?php echo $site_url?>contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="#">Terms & conditions</a>
                    </li>
                </div>
            </div>
        </div>

        <div style="display:flex; width: 100%; margin-top:20px" class="footer_bottom">
            <p style="font-size:14px; color:white">Registered Charity No. 123456</p>
            <p style="margin-left: auto; color:white; font-size: 14px; margin-right: 30px">website by ewds</p>
        </div>


    </div>
</footer>

<!-- Bootstrap core JS-->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.js"></script>

<!-- Core theme JS-->
<script  crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0&appId=721002358593144&autoLogAppEvents=1" nonce="0EjHQr20"></script>

<script src="assets/js/scripts.js"></script>

<script type="text/javascript">
    window.onload = function () { 
        $('header.masthead').addClass('bg-image');
        $('div.mastheader').addClass('bg-image');
    }

    var login_flag = '<?php echo $login_flag?>';
    var user_name = '<?php echo $user_name?>';
    var user_id = '<?php echo $user_id?>';
    var user_email = '<?php echo $email?>';
    
    $(function() {
      $('a#arrow_bottom').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 500, 'linear');
      });
    });
</script>