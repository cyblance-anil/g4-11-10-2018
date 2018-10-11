<?php
/**
 * The main template file.
 *
 */

get_header(); ?>

	

<?php if(is_single()){ ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php global $post;
			//$teaser = get_post_meta( get_the_ID(), 'post_teaser', true );			
			$designation = get_post_meta( get_the_ID(), 'post_designation', true );
			$custom_url = get_post_meta( get_the_ID(), 'post_custom_url', true );
		?>
		<div  class="content_wrapper">
			<?php
            if (has_post_thumbnail()) { 
            	$largeImage = get_the_post_thumbnail_url(get_the_ID(),'large');
            }else{
				$largeImage = OF_DIRECTORY.'/images/no-image.jpg';
			} ?>
            <div class="Blog-Images" style="background-image:url('<?php echo $largeImage; ?>')">
                <div class="Blog_detail">
                    <div class="container">  
                        <h3><?php the_title(); ?></h3>                        
                    </div>
                </div>
            </div>
			<section class="blog_detail_page  shadow p50">
		        <div class="container">  
					<div class="col-lg-8 col-md-8 left-sidebar">
						<div class="OUR_FRANCHISEES_WRAPPER">
							<div class="col-lg-12">
								<div class="item">		                        
									<div class="blog_detail">
										<h3 class="authour"><?php echo  $post->post_excerpt; ?></h3>
										<?php the_content(); ?>
										<?php if($custom_url!=''){ ?>
											<a href="<?php echo $custom_url; ?>" class="red_color" target="_blank">Click here for full article.</a>
										<?php } ?>                                   
									</div>
								</div>
							</div>
						</div>
						<div class="custom-navigation">
							<a href="javascript:void(0);" onclick="window.history.back();">
								<span class="prev page-numbers"><i class="fa fa-angle-left"></i></span><h5>BACK</h5>
							</a>                       
						</div>
					</div>
					<div id="sidebar" class="col-lg-4 col-md-4 right-sidebar is_sidebar">
						<?php get_sidebar('blog'); ?>
					</div>
		        </div>
		    </section>
		</div>
	<?php endwhile; ?>

<?php }else{ ?>
    
	<div class="content_wrapper">    
		<div class="th-innerpagebanner  icon-blog-green" >
			<div class="th-pagetitle">
				<h1 class="mb50">Blog</h1>
				<!--<div class="green-arrow-bottm text-center">
					<a href="javascript:void(0)" onclick="navScroll('.our-blog');"><img src="<?=OF_DIRECTORY?>/images/down-arrow.png"></a>
				</div>-->
			</div>
		</div>	
		<section id="section_1" class="our-blog shadow p70 pb0">         
	        <div class="container"> 
				<div class="col-lg-8 col-md-8  left-sidebar">
					
							
					<div class="NEWS_WRAPPER pt40">
					
					<?php while ( have_posts() ) : the_post();
							global $post; ?>
							
								<div class="col-lg-6 col-md-6 mb20">
							
								<div class="item bg_gray">
									<div class="slider_img">
										<?php
										if (has_post_thumbnail()) { 
											$largeImage = get_the_post_thumbnail_url(get_the_ID(),'large');
											$image = OF_DIRECTORY.'/lib/timthumb.php?src='.$largeImage.'&w=652&h=368&zc=1'; ?>
											<img src="<?php echo $image; ?>" width="100%">
										<?php }else{ ?>
											<img src="<?php echo OF_DIRECTORY.'/lib/timthumb.php?src='.OF_DIRECTORY.'/images/placeholder.jpg&w=652&h=368&zc=1'; ?>" class="velocity-animating" width="100%">
										<?php } ?>
									</div>
									<div class="slider_detail">
										<h3>
										<?php $title = get_the_title();
										if(strlen($title) > 75){
											echo $title = substr($title, 0, 72).'...';
										}else{
											echo $title;
										} ?>
										</h3>
										<p>
											<?php //$content = get_the_content();
											$content = $post->post_excerpt;
											if(strlen($content) > 150){
												echo $content = substr($content, 0, 147).'...';
											}else{
												echo $content;
											}?>
										</p>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<div class="text-center"> 
												<button class="readmore black"> Read More</button>
											</div>
										</a>
									</div>
								</div>
							</div>
					<?php endwhile; ?>   
					</div>
					<div class="custom-navigation">
						<?php 
							$args = array(
								'prev_next'          => true,
								'prev_text'          => __('<i class="fa fa-angle-left"></i>'),
								'prev_text'          => __('<i class="fa fa-angle-left"></i>'),
								'next_text'          => __('<i class="fa fa-angle-right"></i>'),
								'type'               => 'plain',
								//'add_fragment'       => '',
								//'before_page_number' => '',
								//'after_page_number'  => ''
							);
						   echo paginate_links($args); ?>
					</div>
				</div>
				<div id="sidebar" class="col-lg-4 col-md-4 right-sidebar is_sidebar">
                    <?php get_sidebar('blog'); ?>
                </div>
			</div>
	    </section>
	</div>
	
<?php } ?>

<?php get_footer(); ?>
