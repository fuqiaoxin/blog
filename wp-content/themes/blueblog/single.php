<?php get_header(); ?>
<!--<nav>-->
<div class="menu_normal"><?php get_template_part( 'menu' ); ?></div>
<!--</nav>-->

<!--<nav 2>-->
<div class="menu2"><?php get_template_part( 'menu2' ); ?></div>
<!--</nav 2>-->

<!--<content>-->
<div class="content">

<!--<post>-->
<div class="post_content_all">
    <div class="postin">

	<!--<postinfull>-->
	<div class="postinfull">
	
	<!--<loop>-->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h2><?php the_title(); ?></h2>
		<div class="datepost">
		<div class="datepostin">

			<div class="single_date_item_1">
			By <?php the_author(); ?>
			</div>

			<div class="single_date_item_2">
			In <?php $category = get_the_category(); echo $category[0]->cat_name; ?>
			</div>

			<div class="single_date_item_3">
			<?php the_time('Y年m月d日') ?> 
			</div>

			<div class="single_date_item_4">
			<?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> 
			</div>

			<div class="single_date_item_5">
			<?php if(function_exists('bac_PostViews')) { echo bac_PostViews(get_the_ID()); } ?>
			</div>

		</div>
		</div>

	<!--<post content>-->
	<div id="post-<?php the_ID(); ?>" class="post_text">
		<?php the_content(); 
		
			if(function_exists('display_copyright')){
				echo display_copyright();
			}
		?>
		<?php wp_link_pages(); ?>
	<?php endwhile; else: ?>
		<p>Sorry, no posts matched your criteria.</p>
	<?php endif; ?>
	<!--</loop>-->
	</div>
	<!--</post content>-->

	<!--<edit post>-->
	<?php edit_post_link('编辑', '<p class="edit_layer">', '</p>'); ?>
	<!--</edit post>-->

	<?php if( get_the_tags() ) { ?>
	<!--<tags>-->
	<div class="post_tags">
		<?php the_tags('<span>Tagged:</span><ul><li>','</li><li>','</li>','</ul>'); ?> 
	</div>
	<!--</tags>-->
	<?php } ?>

	<!--<share post>-->
	<div class="share_post">
		<div class="share_post_pad">
			<!-- JiaThis Button BEGIN -->
			<!-- 
			<div class="jiathis_style">
				<span class="jiathis_txt">分享到：</span>
				<a class="jiathis_button_qzone">QQ空间</a>
				<a class="jiathis_button_tsina">新浪微博</a>
				<a class="jiathis_button_tqq">腾讯微博</a>
				<a class="jiathis_button_weixin">微信</a>
				<a class="jiathis_button_tieba">百度贴吧</a>
				<a class="jiathis_button_renren">人人网</a>
				<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank">更多</a>
				<a class="jiathis_counter_style"></a>
			</div>
			<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
			-->
			<!-- JiaThis Button END -->
			<div class="bdsharebuttonbox" data-tag="share_1">
				<!-- 此处添加展示按钮 -->
				<a class="bds_mshare" data-cmd="mshare"></a>
				<a class="bds_qzone" data-cmd="qzone" href="#"></a>
				<a class="bds_tsina" data-cmd="tsina"></a>
				<a class="bds_baidu" data-cmd="baidu"></a>
				<a class="bds_renren" data-cmd="renren"></a>
				<a class="bds_tqq" data-cmd="tqq"></a>
				<a class="bds_bdxc" data-cmd="bdxc"></a>
				<a class="bds_kaixin001" data-cmd="kaixin001"></a>
				<a class="bds_tqf" data-cmd="tqf"></a>
				<a class="bds_tieba" data-cmd="tieba"></a>
				<a class="bds_douban" data-cmd="douban"></a>
				<a class="bds_tieba" data-cmd="tieba"></a>
				<a class="bds_taobao" data-cmd="taobao"></a>
				<a class="bds_more" data-cmd="more">更多</a>
				<a class="bds_count" data-cmd="count"></a>
			</div>
			
		</div>
		
		<?php 
			// add by fxh 2014 09.05
			// 处理分享的内容摘要，去除html标签，取内容的120个字符长度
			$share_con=trim(mb_strimwidth(my_DeleteHtml(apply_filters('the_content', $post->post_content)), 0, 120,"…")); 
			//echo $share_con;
			
			// 获取当前文章的图片，先查找该篇博文是否有设置封面图片，如果没有就查找博文的第一张图片
			if(has_post_thumbnail()) {	
				$bdImgUrl="'".get_the_post_thumbnail(get_the_ID(),300)."'";
				//echo $bdImgUrl;
				
				$src_preg='/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i';
				$preg_arr=preg_match($src_preg,$bdImgUrl,$match);	//正则表达式语句
				
				$bdPic=$match[1];
				//var_dump($bdPic);
			} else {
				$bdPic=catch_that_image('253');
			}
			
			
			//echo '图片地址:'.$bdPic;
	
		?>
		<script>
			window._bd_share_config = {
				//此处添加分享具体设置
				common : {
					//此处放置通用设置
					bdText : '<?php the_title(); ?>',	
					bdDesc : '<?php echo $share_con;?>',	
					bdUrl : '<?php the_permalink();?>', 	
					bdPic : '<?php echo $bdPic;?>',		
					bdSign:'on',
					bdMini:3,
					bdMiniList:['qzone','tsina','baidu','renren','tqq','bdxc','kaixin001','tqf','tieba'],
					onBeforeClick:function(cmd,config){
						console.log('点击分享'+cmd);
						
						console.log('点击分享2');
						console.log(config);
					},
					onAfterClick:function(cmd){
						console.log('点击分享后的'+cmd);
					}
					
				},
				share : [
					//此处放置分享按钮设置
					{
						"tag" : "share_1",
						"bdSize" : 32
						
					}
				],
				/*slide : [
					//此处放置浮窗分享设置
					{	   
						bdImg : 1,
						bdPos : "right",
						bdTop : 200
					}
				],*/
				image : [
					//此处放置图片分享设置
				],
				selectShare : [
					//此处放置划词分享设置
				]
				
			}

			//以下为js加载部分
			with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
		</script>
	</div>
	<!--</share post>-->

		<?php if( get_the_author_meta('description') ) { ?>
		<!--<author>-->
		<div class="author_post">
			<div class="author_post_item">
				<div class="author_post_name">
				<h4>About "<?php the_author_posts_link(); ?>" Has <?php the_author_posts(); ?> Posts</h4>
				</div>

				<div class="author_post_pic">
				<?php echo get_avatar( get_the_author_meta('ID'), 56 ); ?>
				</div>

				<div class="author_post_desc">
				<?php the_author_meta('description'); ?>
				</div>
			</div>
		</div>
		<!--</author>-->
		<?php } ?>


		<!--<related>-->
		<div class="recent_post_category">

		<h3>推荐文章</h3>

		<?php $cats = array(); foreach( get_the_category() as $cat ) { $cats[] = $cat->term_id; }; $recent = new WP_Query( array('category__in' => $cats, 'posts_per_page' => 4 )); while($recent->have_posts()) : $recent->the_post();?>

			<div class="rpc_posts">
				<div class="rpc_postimage">
				<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('img150'); ?>
						<div class="tm_bricknews_1_images_icon"></div>
					</a>
				<?php } else { 
						if(catch_that_image()){
				?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<img src="<?php echo catch_that_image('150'); ?>" />
							<div class="tm_bricknews_1_images_icon"></div>
						</a>
				<?php } else{?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<img src="<?php echo get_template_directory_uri(); ?>/images/nophoto.png" />
								<div class="tm_bricknews_1_images_icon"></div>
							</a>
				<?php	}
				}
				?>

				</div>

				<div class="rpc_postinfo">
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
				<h4><?php $tit = the_title('','',FALSE); echo substr($tit, 0, 70); if (strlen($tit) > 70) echo " ..."; ?></h4>
				</a>
				</div>
			</div>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>

		</div>
		<!--</related>-->

			<?php if ( of_get_option('enable_defaultcomment_checkbox', true ) ) { ?>
			<!--<default comments>-->
			<?php comments_template( '', true ); ?>
			<!--</default comments>-->
			<?php } ?>

			<?php if ( of_get_option('enable_facebookcomment_checkbox', true ) ) { ?>
			<!--<facebook comments>-->
			<div id="facebook_comments">
			<div id="facebook_comments_box"><h3>facebook comments:</h3></div>

			<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="10" mobile="false"></div>

			</div>
			<!--</facebook comments>-->
			<?php } ?>

	</div>
	<!--</postinfull>-->

    </div>
</div>
<!--</post>-->

<?php get_template_part( 'sidebar' ); ?>

</div>
<!--</content>-->
<div class="mytest">
<?php 
	/*if(is_single())  {
		//$content = $content . get_option('display_copyright_text');
		$post_data = get_post($post->ID, ARRAY_A);
		echo $slug = $post_data['post_name'];// 获取当前文章详情页的名称 是url编码的
	}*/
?>
</div>

<?php get_footer(); ?>