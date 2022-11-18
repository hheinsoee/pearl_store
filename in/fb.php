<?php
  function fb_platform(){
    ?>
    <script>
       window.fbAsyncInit = function() {
      FB.init({
        appId      : '358979421551505',
        xfbml      : true,
        version    : 'v3.3'
      });
      FB.AppEvents.logPageView();
    };

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
    </script>

    
    <?php
  }
  function fb_like_share($target){
    ?>
      <div 
      class="fb-like p0010 middle"
      data-share="true"
      data-href="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']."/".$target;?>"
      data-layout="button_count" 
      data-size="small" 
      data-mobile-iframe="true"
      data-show-faces="true">
      </div>

    <?php
  }
  function fb_like($target){
    ?>
      <div 
      class="fb-like p0010"
      data-share="false"
      data-href="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']."/".$target;?>" 
      data-layout="button_count" 
      data-size="small" 
      data-mobile-iframe="true"
      data-show-faces="true">
      </div>
    <?php
  }
  function fb_share($target){
    ?>
      <div 
      class="fb-share-button"
      data-share="true"
      data-href="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']."/".$target;?>"  
      data-layout="button" 
      data-size="small" 
      data-mobile-iframe="true"
      data-show-faces="false">
      </div>
    <?php
  }
  function fb_comment($target){
    ?>
      <div class="fb-comments" 
      data-href="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST']."/".$target;?>" 
      data-width="100%" 
      data-numposts="4">
      </div>
    <?php
  }

  function fb_page(){
    ?><div class="fb-like" data-href="https://www.facebook.com/fornetmm" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
    <?php
  }
?>