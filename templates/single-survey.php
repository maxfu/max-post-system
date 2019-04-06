
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<?php $destination_link = get_post_meta( get_the_ID(), 'destination_link', true ); ?>
	<?php header('Location: '. $destination_link ); ?>
	<?php exit(); ?>
<?php endwhile; ?>
<?php else: ?>
	<main role="main">
		<section class="mbr-section article content1 cid-qSSbnPkOyI">
			<div class="container">
				<div class="media-container-row">
					<div class="mbr-text col-9 col-md-9 mbr-fonts-style display-7">
						<h2><?php _e( 'Sorry, nothing to display.', 'max-post' ); ?></h2>
					</div>
				</div>
			</div>
		</section>
	</main>
<?php endif; ?>
