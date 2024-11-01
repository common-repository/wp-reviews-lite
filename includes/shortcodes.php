<?php
/*
* Shortcodes here.
*
*/

// Add reviews shortcode
function review_grid_shortcode($atts){
    ob_start();
    $atts = ( shortcode_atts( array (
        'count' => -1
    ), $atts ) );
 
    $options = array(
        'post_type' => 'review',
        'post_status' => 'publish',
        'posts_per_page' => $atts["count"]
    );
    $query = new WP_Query( $options );
    if ( $query->have_posts() ) {
	wp_enqueue_script('custom-isotope');
    wp_enqueue_script('custom-isotope-packery');
    wp_enqueue_script('review-grid-script'); ?>
    <div class="review-grid-item-wrapper review-grid-loading">
		<div class="review-grid-inner">
			<?php while( $query->have_posts() ) {
				$query->the_post();
		        $source = get_post_meta( get_the_ID(), 'review_source', true );
				$blurb = get_post_meta( get_the_ID(), 'review_blurb', true );
				$company = get_post_meta( get_the_ID(), 'review_company', true );
				$position = get_post_meta( get_the_ID(), 'review_position', true );
				$address = get_post_meta( get_the_ID(), 'review_address', true ); 
				if( !empty($source) ) {
					switch ($source) {
						case '1':
							$source = '<span class="facebook"><i class="fa fa-facebook-square"></i>Facebook</span>';
							break;
						case '2':
							$source = '<span class="tripadvisor"><i class="fa fa-tripadvisor"></i>Tripadvisor</span>';
							break;
						case '3':
							$source = '<span class="google"><i class="fa fa-google"></i>Google</span>';
							break;
					}
				}	
				?>
				<div class="review-grid-item">
					<div class="review-grid-item-inner">
						<h5 class="rev-blurb"><?php echo(!empty($blurb)) ? '<span class="rev-blurb">'.$blurb.'</span>' : ''; ?></h5>
						<span class="rev-ratings"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
						<p class="rev-content"><span class="rev-quote">&ldquo;</span><?php echo wp_trim_words( get_the_content(), 100, '...' ); ?></p>
						<?php the_post_thumbnail('review-thumb'); ?>
						<span class="rev-name"><?php the_title(); ?></span>
						<?php echo(!empty($position)) ? '<span class="rev-position">'.$position.'</span>' : ''; ?> 
						<?php echo(!empty($company)) ? '<span class="rev-company">'.$company.'</span>' : ''; ?>					
						<?php echo(!empty($address)) ? '<span class="rev-address">'.$address.'</span>' : ''; ?>
						<h5 class="rev-source"><?php echo(!empty($source)) ? '<span class="rev-source">'.$source.'</span>' : ''; ?></h5>
					</div>
				</div>
			<?php }
			wp_reset_postdata(); ?>
		</div>
    </div>
    <?php }
    $review = ob_get_clean();
    return $review;
}
add_shortcode( 'review_grid', 'review_grid_shortcode' );

// Add reviews by category shortcode
function review_grid_cat_shortcode($atts){
    ob_start();
    $atts = ( shortcode_atts( array (
        'count' => -1,
		'category' => ''
    ), $atts ) );
 
    $options = array(
        'post_type' => 'review',
        'post_status' => 'publish',
        'posts_per_page' => $atts["count"],
        'tax_query' => array(
            array(
                'taxonomy' => 'review_category',
                'field' => 'slug',
                'terms' => array( sanitize_title( $atts['category'] ) )
            ) 
		)
    );
    $query = new WP_Query( $options );
    if ( $query->have_posts() ) {
	wp_enqueue_script('custom-isotope');
    wp_enqueue_script('custom-isotope-packery');
    wp_enqueue_script('review-grid-script'); ?>
    <div class="review-grid-item-wrapper review-grid-loading">
		<div class="review-grid-inner">
			<?php while( $query->have_posts() ) {
				$query->the_post();
		                $source = get_post_meta( get_the_ID(), 'review_source', true );
				$blurb = get_post_meta( get_the_ID(), 'review_blurb', true );
				$company = get_post_meta( get_the_ID(), 'review_company', true );
				$position = get_post_meta( get_the_ID(), 'review_position', true );
				$address = get_post_meta( get_the_ID(), 'review_address', true ); 
				if( !empty($source) ) {
					switch ($source) {
						case '1':
							$source = '<span class="facebook"><i class="fa fa-facebook-square"></i>Facebook</span>';
							break;
						case '2':
							$source = '<span class="tripadvisor"><i class="fa fa-tripadvisor"></i>Tripadvisor</span>';
							break;
						case '3':
							$source = '<span class="google"><i class="fa fa-google"></i>Google</span>';
							break;
					}
				}	
				?>
				<div class="review-grid-item">
					<div class="review-grid-item-inner">
						<h5 class="rev-blurb"><?php echo(!empty($blurb)) ? '<span class="rev-blurb">'.$blurb.'</span>' : ''; ?></h5>
						<span class="rev-ratings"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
						<p class="rev-content"><span class="rev-quote">&ldquo;</span><?php echo wp_trim_words( get_the_content(), 100, '...' ); ?></p>
						<?php the_post_thumbnail('review-thumb'); ?>
						<span class="rev-name"><?php the_title(); ?></span>
						<?php echo(!empty($position)) ? '<span class="rev-position">'.$position.'</span>' : ''; ?> 
						<?php echo(!empty($company)) ? '<span class="rev-company">'.$company.'</span>' : ''; ?>					
						<?php echo(!empty($address)) ? '<span class="rev-address">'.$address.'</span>' : ''; ?>
						<h5 class="rev-source"><?php echo(!empty($source)) ? '<span class="rev-source">'.$source.'</span>' : ''; ?></h5>
					</div>
				</div>
			<?php }
			wp_reset_postdata(); ?>
		</div>
    </div>
    <?php }
    $review = ob_get_clean();
    return $review;
}
add_shortcode( 'review_grid_cat', 'review_grid_cat_shortcode' );

// Add Review slider shortcode
function review_slider_shortcode($atts){
    ob_start();
    $atts = ( shortcode_atts( array (
        'count' => -1
    ), $atts ) );
 
    $options = array(
        'post_type' => 'review',
        'post_status' => 'publish',
        'posts_per_page' => $atts["count"]
    );
    $query = new WP_Query( $options );
    if ( $query->have_posts() ) {
    wp_enqueue_script('custom-flexslider');
    wp_enqueue_script('review-script'); ?>
    <div class="review-slider-item-wrapper rs-loading">
        <ul class="slides">
        <?php while( $query->have_posts() ) {
            $query->the_post();
            $blurb = get_post_meta( get_the_ID(), 'review_blurb', true );
            $company = get_post_meta( get_the_ID(), 'review_company', true );
	    $position = get_post_meta( get_the_ID(), 'review_position', true );
            $address = get_post_meta( get_the_ID(), 'review_address', true );
		    $source = get_post_meta( get_the_ID(), 'review_source', true );
				if( !empty($source) ) {
					switch ($source) {
						case '1':
							$source = '<span class="facebook"><i class="fa fa-facebook-square"></i>Facebook</span>';
							break;
						case '2':
							$source = '<span class="tripadvisor"><i class="fa fa-tripadvisor"></i>Tripadvisor</span>';
							break;
						case '3':
							$source = '<span class="google"><i class="fa fa-google"></i>Google</span>';
							break;
					}
				}
			?>
            <li><div class="review-slider-details">
                <div class="review-slider-extra">		
					<h3 class="rev-blurb"><?php echo(!empty($blurb)) ? '<span>'.$blurb.'</span>' : ''; ?></h3>
					<span class="rev-ratings"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>				
					<div class="rev-content">
						<p><span class="rev-quote">&ldquo;</span><?php echo wp_trim_words( get_the_content(), 200, '...' ); ?><span class="rev-quote">&rdquo;</span></p>
					</div> 
					<?php the_post_thumbnail('review-thumb'); ?>
					<span class="rev-name"><?php the_title(); ?></span>
					<?php echo(!empty($position)) ? '<span class="rev-position">'.$position.'</span>' : ''; ?> 
					<?php echo(!empty($company)) ? '<span class="rev-company">'.$company.'</span>' : ''; ?>					
					<?php echo(!empty($address)) ? '<span class="rev-address">'.$address.'</span>' : ''; ?>
					<h5 class="rev-source"><?php echo(!empty($source)) ? '<span class="rev-source">'.$source.'</span>' : ''; ?></h5>					
                </div>
            </div></li>
        <?php }
        wp_reset_postdata(); ?>
        </ul>
    </div>
    <?php }
    $review = ob_get_clean();
    return $review;
}
add_shortcode( 'review_slider', 'review_slider_shortcode' );