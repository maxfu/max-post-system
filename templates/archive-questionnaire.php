<?php get_header(); ?>

<style type="text/css">
.cid-qUC8WLfjwn {
		background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/jumbotron.jpg");
}
</style>

<main role="main">

	<section class="mbr-section content5 cid-qUC8WLfjwn mbr-parallax-background" id="content5-1y">
		<div class="mbr-overlay" style="opacity: 0.4; background-color: rgb(35, 35, 35);"></div>
		<div class="container">
			<div class="media-container-row">
				<div class="title col-12">
					<h2 class="align-center mbr-bold mbr-white mbr-fonts-style display-1"><a href="<?php echo get_post_type_archive_link( 'questionnaire' ); ?>" title="<?php _e( 'Questionnaire', 'max-post' ); ?>"><?php _e( 'Questionnaire', 'max-post' ); ?></a></h2>
				</div>
			</div>
		</div>
	</section>

	<!-- section -->
	<section class="features11 cid-qSShVnZyJK" id="content4-p">
        <div class="container">
            <div class="media-container-row">
                <div class="mbr-text col-12 mbr-fonts-style display-7">
						<?php $args = array(
							'post_status' => 'publish',
							'post_type' => 'questionnaire',
							'meta_key' => 'event_date',
							'orderby' => 'meta_value_num',
							'order' => 'DESC',
						); ?>
						<?php $custom_query = new WP_Query( $args ); ?>
						<?php if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
							<!-- article -->
							<?php $event_date = get_post_meta( get_the_ID(), 'event_date', true ); ?>
							    <h2 class="mbr-title pt-2 mbr-fonts-style display-3"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<?php endwhile; wp_reset_postdata(); ?>
						<?php else: ?>
							<!-- article -->
							<article>
								<h2><?php _e( 'More questionnaire coming soon!', 'max-post' ); ?></h2>
							</article>
							<!-- /article -->
						<?php endif; ?>
			            <?php // get_template_part('pagination'); ?>
					</div>
				</div>
			</div>
		</section>
		<!-- /section -->
	</main>

	<?php get_footer(); ?>
