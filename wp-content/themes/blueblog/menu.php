<!--MainMenu-->
<div id="navigasi_menu">
<div class="navigasi_menubar">
	<div class="navigasi_list">
		<div class="login_info" id="login_info_btn">
			
			<?php  
				//is_register();
				my_showlogin();
			?> 

		</div>
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		
	</div>
</div>
</div>
<!--//MainMenu-->

<div class="clear"></div>