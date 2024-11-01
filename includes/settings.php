<?php
/*
* Shortcodes here.
*
*/

// Settings
function wprl_review_register_options_page() {
  add_options_page('WP Reviews Settings', 'WP Reviews', 'manage_options', 'wp-reviews-lite', 'my_setting_section_callback_function', 'wprl_review_options_page');
}
add_action('admin_menu', 'wprl_review_register_options_page');

function my_setting_section_callback_function() {
    ?>
    <h1> <?php esc_html_e( 'Welcome to WP Reviews Plugin', 'wp-reviews-lite' ); ?> </h1>
    <br>
    <H2>How to use</h2>
    <p><strong>Display all client reviews with count functionality</strong></p>
    <ul>
        <li>* [review_grid]</li>
        <li>* [review_grid count="9"]</li>
    </ul>
    <p><strong>Display client reviews filtered by Category with count functionality</strong></p>
    <ul>
        <li>* [review_grid_cat category="test"]</li>
        <li>* [review_grid_cat category="test" count="9"]</li>
    </ul>
    <p><strong>Display client slider reviews with count functionality</strong></p>
    <ul>
        <li>* [review_slider]</li>
        <li>* [review_slider count="10"]</li>
    </ul>
    
    <br>
    <H2>Contact Information</h2>
    <span><strong>Email:</strong> <a href="mailto:abnercalapiz@gmail.com">abnercalapiz@gmail.com</a></span>
    
    <br><br>
    <H2>Willing to accept donations for this plugin improvements!</h2>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick" />
    <input type="hidden" name="hosted_button_id" value="G8PDBD4PCT9U4" />
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
    <img alt="" border="0" src="https://www.paypal.com/en_PH/i/scr/pixel.gif" width="1" height="1" />
    </form>
  
    <?php
}