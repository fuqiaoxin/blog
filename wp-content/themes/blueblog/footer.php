<!--<footer>-->
<div class="footer">

	<div class="footer_brick">
	<div class="footer_brick_box">

		<!--<footer brick 1>-->
		<div class="footer_brick_1">
				<!--<footer widget left>-->
				<div class="footerwidget">
				<ul>
				<?php if (!dynamic_sidebar('Footer Widget Left') ) : ?><?php endif; ?>
				</ul>
				</div>
				<!--</footer widget left>-->
		</div>
		<!--</footer brick 1>-->

		<!--<footer brick 2>-->
		<div class="footer_brick_2">
			<div class="footerwidget">
				<ul>
				<?php if (!dynamic_sidebar('Footer Widget Center') ) : ?><?php endif; ?>
				</ul>
			</div>
		
		</div>
		<!--</footer brick 2>-->

		<!--<footer brick 3>-->
		<div class="footer_brick_3">
				<!--<footer widget right>-->
				<div class="footerwidget">
				<ul>
				<?php if (!dynamic_sidebar('Footer Widget Right') ) : ?><?php endif; ?>
				</ul>
				</div>
				<!--<footer widget right>-->
		</div>
		<!--</footer brick 3>-->

	</div>
	</div>


	<div class="footerin">
		<div class="footerin_1">
		<span>
		<?php echo of_get_option('abouttext_textarea'); ?>	
		</span>
		</div>
	</div>
	
</div>
<!--</footer>-->

</div>
<!--</container>-->

<script>
jQuery(document).ready(function() { 
	jQuery("img.lazy").lazy(); 
	
	topMenuShow();
	
});

// 头部自定义用户登录菜单 add by fxh 2014 09.04
function topMenuShow(){

	jQuery("#login_info_btn #userinfoBtn").mouseover(function(){
			jQuery("#userinfoBtn").addClass('hover');
			jQuery("#userinfoBtn").children("ul").css({visibility:'visible',opacity:1});
			jQuery("#userinfoBtn").children("ul").animate({top:'37px'},10);
        });
	jQuery("#login_info_btn #userinfoBtn ul").mouseover(function(){
			jQuery("#userinfoBtn").addClass('hover');
			jQuery("#userinfoBtn").children("ul").css({visibility:'visible',opacity:1});
			jQuery("#userinfoBtn").children("ul").animate({top:'37px'},10);
        });	
		
	jQuery("#login_info_btn #userinfoBtn ul").mouseout(function(){
		jQuery("#userinfoBtn").removeClass('hover');
		jQuery("#userinfoBtn").children("ul").css({visibility:'hidden',opacity:0});
		jQuery("#userinfoBtn").children("ul").animate({top:'20px'},10);
		
	});
	
	
	jQuery(document).click(function(){
		if(jQuery("#userinfoBtn").hasClass('hover')){
			jQuery("#userinfoBtn").removeClass('hover');
			jQuery("#userinfoBtn").removeClass('hover');
			jQuery("#userinfoBtn").children("ul").css({visibility:'hidden',opacity:0});
			jQuery("#userinfoBtn").children("ul").animate({top:'20px'},10);	
		}

		
	});

}

</script>

<?php wp_footer(); ?>
</body>
</html>
