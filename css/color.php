<?php 
header("Content-type: text/css; charset=utf-8");

$baseColor = '#'.htmlspecialchars($_GET['cl']);
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; 
}

// $baseBackgroundColor = 'rgba('.implode(",", hex2rgb(htmlspecialchars_decode($baseColor))).', 0.85)';
// $videoBackgroundColor = 'rgba('.implode(",", hex2rgb(htmlspecialchars_decode($baseColor))).', 0.61)';
?>
::selection {background: <?php echo htmlspecialchars_decode($baseColor);?>; color:#292929; }
::-moz-selection {background: <?php echo htmlspecialchars_decode($baseColor);?>; color:#292929;}
.pagination span,.button  , nav  a span , .arrow-nav a , .home-separator span , .about-button , .custom-skillbar ,   .services-holder li:hover , .serv-overlay , #options li.actcat, #options li:hover , .folio-overlay span, .popup-modal-dismiss  , #contact-form input[type="submit"] , #jprePercentage , .scroll-btn:after , .color-separator , .twitter-holder .customNavigation a , .testimonials-holder .customNavigation a , .clients-holder, .subscriptionForm input#submitButton , .contact-tooltip  , .scroll-nav a  , .about-image .customNavigation a ,.box-details h3:after , .social-list li a:before , #project-page-button a , .tagcloud a , .pagination a , .media-holder .customNavigation a, .form-submit .button:hover{
   background:<?php echo htmlspecialchars_decode($baseColor);?>;
}
.form-submit .button:hover {border-color:<?php echo htmlspecialchars_decode($baseColor);?>;}
::-webkit-scrollbar-thumb , -moz-scrollbar {
   background:<?php echo htmlspecialchars_decode($baseColor);?>;
}
.services-holder li  i , .contact-info li i  , .policy-box  a  , .policy-box  i , .error_message , .twitts li a , .num , .resume-head h4 , .rep-testimonials-slider a , .twitter-holder h4 a , .subscribe-holder h4 , #contact-form input[type=text]:focus, #contact-form input[type=email]:focus, #contact-form textarea:focus, input[type=email]:focus , .rep-contact-social  ul li a:hover , .side-site div i  ,  #success_page p , .post-meta li h6, .post-meta li a , .search-submit , .share-options ul li a:hover{
   color:<?php echo htmlspecialchars_decode($baseColor);?>;
}  
.page-title h2 span {
   border-bottom:4px solid <?php echo htmlspecialchars_decode($baseColor);?>;
}
#project-slider .owl-next{
   background:<?php echo htmlspecialchars_decode($baseColor);?> url(../images/sr.png) no-repeat center;
}
#project-slider .owl-prev {
   background: <?php echo htmlspecialchars_decode($baseColor);?> url(../images/sl.png) no-repeat center;
}
.contact-tooltip:after {
   border-top-color: <?php echo htmlspecialchars_decode($baseColor);?>;
}