
<!-- <script src="<?php echo $jsPath?>slick.js"></script> -->
<!-- <script src="<?php echo $jsPath?>bootstrap.bundle.min.js"></script> -->
<script src="<?php echo $jsPath?>toastr.min.js"></script>
<script src="<?php echo $jsPath?>semantic.min.js"></script>
<?php if($script == "dash-buy-blood.js"){
      }elseif( $script == "vac.js"){}else{?>
            <script src="<?php echo $jsPath?>bootstrap.bundle.min.js"></script>
<?php } ?>
<script src="<?php echo $jsPath?>owl.carousel.min.js"></script>
<?php
  if($script == "history.js"){?>
      <script src="<?php echo $jsPath?>mixitup.min.js"></script>
      <script src="<?php echo $jsPath?>dash-navbar.js"></script>
  <?php }
  // use semantic ui 
  if($script == "history.js" || $script == "NewsStory_1.js" || $script == "dash-buy-blood.js" || $script == "NewsStory.js" || $script == "vac.js"){?>
      <script src="<?php echo $jsPath?>semantic.min.js"></script>
      <script src="<?php echo $jsPath?>dropdown.js"></script>
    <?php }
  // swiper liberary for bloodForm page
  if($script == "bloodForm.js" || $script == "donarQues.js"){?>
        <script src="<?php echo $jsPath?>swiper-bundle.min.js"></script>
  <?php }
  // dash navbar style for bloodForm page
  if($script == "bloodForm.js" || $script == "dash-buy-blood.js" || $script == "vac.js" || $script == "dash-donate-blood.js" || $script == "dash-favorites.js" || $script == "dash-make-post.js" || $script == "dash-profile.js" || $script == "userStory.js" || $script == "vaccine.js"){?>
        <script src="<?php echo $jsPath?>dash-navbar.js"></script>
  <?php } ?>
        <script src="<?php echo $jsPath?><?php echo $script?>"></script>
        <script src="<?php echo $jsPath?>loading_and_Navbar.js"></script>
        <script src="<?php echo $jsPath?>dropdown.js"></script>
</body>
</html>