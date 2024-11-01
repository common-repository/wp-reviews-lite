<?php
/*
*  Add all custom meta boxes here.
*/

// disable direct access 
if ( ! defined( 'WPINC' ) ) die(';)');

function add_wprl_metabox_scripts() {
	wp_enqueue_style( 'custom-metabox-styles', plugins_url('/css/custom-metabox-styles.css', __FILE__) );
}
add_action( 'admin_enqueue_scripts', 'add_wprl_metabox_scripts', 999 );

// Reviews custom meta data
function add_wprl_box_review() {
	add_meta_box( 'wprl_box_review', __( 'Review Details', 'text_domain' ), 'review_inner_wprl_box', 'review', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'add_wprl_box_review', 0 );

function review_inner_wprl_box( $post ) {
	wp_nonce_field( 'review_inner_wprl_box', 'review_inner_wprl_box_nonce' );
	$review_source = get_post_meta( $post->ID, 'review_source', true );
	$review_blurb = get_post_meta( $post->ID, 'review_blurb', true );
	$review_company = get_post_meta( $post->ID, 'review_company', true );
	$review_position = get_post_meta( $post->ID, 'review_position', true );
	$review_address = get_post_meta( $post->ID, 'review_address', true ); ?>
	<div class="custom-meta-row cmr-leftalign">
		<label for="review_source">Review Source</label>
		<select id="review_source" name="review_source">
			<option value="">Select Source</option>
			<option value="1" <?php selected($review_source, 1); ?>>Facebook</option>
			<option value="2" <?php selected($review_source, 2); ?>>Tripadvisor</option>
			<option value="3" <?php selected($review_source, 3); ?>>Google</option>
		</select>
	</div>
	<div class="custom-meta-row cmr-leftalign">
	  <label for="review_blurb">Blurb</label>
	  <textarea id="review_blurb" name="review_blurb" rows="4"><?php echo $review_blurb; ?></textarea>
	</div>
	<div class="custom-meta-row cmr-leftalign">
	  <label for="review_company">Company</label>
	  <input type="text" id="review_company" name="review_company" value="<?php echo esc_attr( $review_company ); ?>" />
	</div>
	<div class="custom-meta-row cmr-leftalign">
	  <label for="review_position">Position</label>
	  <input type="text" id="review_position" name="review_position" value="<?php echo esc_attr( $review_position ); ?>" />
	</div>
	<div class="custom-meta-row cmr-leftalign">
	  <label for="review_address">Address</label>
	  <input type="text" id="review_address" name="review_address" value="<?php echo esc_attr( $review_address ); ?>" />
	</div>
<?php }

function review_save_data( $post_id ) {
	if ( ! isset( $_POST['review_inner_wprl_box_nonce'] ) )
	return $post_id;
	$nonce = $_POST['review_inner_wprl_box_nonce'];
	if ( ! wp_verify_nonce( $nonce, 'review_inner_wprl_box' ) )
	  return $post_id;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	  return $post_id;
	if ( ! current_user_can( 'edit_post', $post_id ) )
	  return $post_id;
	$source = sanitize_text_field( $_POST['review_source'] );
	$blurb = sanitize_text_field( $_POST['review_blurb'] );
	$company = sanitize_text_field( $_POST['review_company'] );
	$position = sanitize_text_field( $_POST['review_position'] );
	$address = sanitize_text_field( $_POST['review_address'] );
	update_post_meta( $post_id, 'review_source', $source );
	update_post_meta( $post_id, 'review_blurb', $blurb );
	update_post_meta( $post_id, 'review_company', $company );
	update_post_meta( $post_id, 'review_position', $position );
	update_post_meta( $post_id, 'review_address', $address );
}
add_action( 'save_post', 'review_save_data' );