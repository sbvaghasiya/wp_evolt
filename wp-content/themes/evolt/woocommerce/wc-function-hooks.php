<?php

/* Remove result count & product ordering & item product category..... */
function evolt_cwoocommerce_remove_function() {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 0 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5, 0 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10, 0 );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10, 0 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10, 0 );
	remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

	remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_sharing', 50 );
}
add_action( 'init', 'evolt_cwoocommerce_remove_function' );

/* Product Category */
add_action( 'woocommerce_before_shop_loop', 'evolt_woocommerce_nav_top', 2 );
function evolt_woocommerce_nav_top() {
	$shop_layout = (isset($_GET['shop-layout'])) ? trim($_GET['shop-layout']) : evolt_get_option( 'shop_layout', 'grid' );
	?>
	<div class="woocommerce-topbar">
		<div class="woocommerce-result-count">
			<?php woocommerce_result_count(); ?>
		</div>
		<div class="woocommerce-archive-layout">
			<?php if($shop_layout == 'grid') { ?>
				<span class="archive-layout layout-grid active"></span>
				<span class="archive-layout layout-list"></span>
			<?php } else { ?>
				<span class="archive-layout layout-grid"></span>
				<span class="archive-layout layout-list active"></span>
			<?php } ?>
		</div>
		<div class="woocommerce-topbar-ordering">
			<?php woocommerce_catalog_ordering(); ?>
		</div>
	</div>
<?php }

add_filter( 'woocommerce_after_shop_loop_item', 'evolt_woocommerce_product' );
function evolt_woocommerce_product() {
	global $product;
	$line_color = get_post_meta($product->get_id(), 'line_color', true);
	$quantity_products = evolt_get_option( 'quantity_products' );
	?>
	<div class="woocommerce-product-inner" <?php if(!empty($line_color['rgba'])) : ?>style="border-color: <?php echo esc_attr($line_color['rgba']); ?>"<?php endif; ?>>
		<div class="woocommerce-product-header">
			<a class="woocommerce-product-details" href="<?php the_permalink(); ?>">
				<?php woocommerce_template_loop_product_thumbnail(); ?>
			</a>
			<?php if (class_exists('WPCleverWoosc')) { ?>
					<div class="woocommerce-compare">
				    	<?php echo do_shortcode('[woosc id="'.esc_attr( $product->get_id() ).'"]'); ?>
					</div>
				<?php } ?>
			<div class="woocommerce-product-meta">
				
				<?php if (class_exists('WPCleverWoosw')) { ?>
					<div class="woocommerce-wishlist tool_tip" data-tooltip="Add to Wishlist">
				    	<?php echo do_shortcode('[woosw id="'.esc_attr( $product->get_id() ).'"]'); ?>
					</div>
				<?php } ?>
				<?php if (class_exists('WPCleverWoosq')) { ?>
					<div class="woocommerce-quick-view">
						<?php echo do_shortcode('[woosq id="'.esc_attr( $product->get_id() ).'"]'); ?>
					</div>
				<?php } ?>
				<?php if ( ! $product->managing_stock() && ! $product->is_in_stock() ) { ?>
				<?php } else { ?>
					<div class="woocommerce-add-to-cart tool_tip" data-tooltip="Add to Cart">
						<?php woocommerce_template_loop_add_to_cart(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="woocommerce-product-content">
			<h4 class="woocommerce-product--title">
				<a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
			</h4>
			<?php woocommerce_template_loop_price(); ?>
			<div class="woocommerce-product--rating">
				<?php woocommerce_template_loop_rating(); ?>
			</div>
			<div class="woocommerce-product--excerpt" style="display: none;">
				<?php woocommerce_template_single_excerpt(); ?>
			</div>
			<?php /* if ( ! $product->managing_stock() && ! $product->is_in_stock() ) { ?>
			<?php } else { ?>
				<div class="woocommerce-add-to-cart">
			    	<?php woocommerce_template_loop_add_to_cart(); ?>
				</div>
			<?php } */ ?>
			<?php 
				if ( $quantity_products && ! $product->is_sold_individually() && 'variable' != $product->get_type() && $product->is_purchasable() ) {
					woocommerce_quantity_input( array( 'min_value' => 1, 'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity() ) );
				}
			?>
		</div>
	</div>
<?php }


/* Add the custom Tabs Specification */
function evolt_custom_product_tab_specification( $tabs ) {
	$product_specification = evolt_get_page_option( 'product_specification' );
	if(!empty($product_specification)) {
		$tabs['tab-product-feature'] = array(
			'title'    => esc_html__( 'Product Specification', 'evolt' ),
			'callback' => 'evolt_custom_tab_content_specification',
			'priority' => 10,
		);
		return $tabs;
	} else {
		return $tabs;
	}
}
add_filter( 'woocommerce_product_tabs', 'evolt_custom_product_tab_specification' );

/* Function that displays output for the Tab Specification. */
function evolt_custom_tab_content_specification( $slug, $tab ) { 
	$product_specification = evolt_get_page_option( 'product_specification' );
	$result = count($product_specification); ?>
	<div class="tab-content-wrap">
		<?php if (!empty($product_specification)) : ?>
			<div class="tab-product-feature-list">
				<?php for($i=0; $i<$result; $i+=2) { ?>
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-12">
                        	<?php echo isset($product_specification[$i])?esc_html( $product_specification[$i] ):''; ?>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-12">
                        	<?php echo isset($product_specification[$i+1])?esc_html( $product_specification[$i+1] ):''; ?>
                        </div>
                    </div>
                    <div class="line-gap"></div>
				<?php } ?>
			</div>
		<?php endif; ?>
	</div>
<?php }

/* Removes the "shop" title on the main shop page */
function evolt_hide_page_title()
{
    return false;
}
add_filter('woocommerce_show_page_title', 'evolt_hide_page_title');

/* Show product per page */
function evolt_loop_shop_per_page(){
	$product_per_page = evolt_get_option( 'product_per_page', '12' );

	if(isset($_REQUEST['loop_shop_per_page']) && !empty($_REQUEST['loop_shop_per_page'])) {
		return $_REQUEST['loop_shop_per_page'];
	} else {
		return $product_per_page;
	}
}
add_filter( 'loop_shop_per_page', 'evolt_loop_shop_per_page' );

/**
 * Modify image width theme support.
 */
add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
    $size['width'] = 250;
    $size['height'] = 285;
    $size['crop'] = 1;
    return $size;
});

/* Product Single: Summary */
add_action( 'woocommerce_before_single_product_summary', 'evolt_woocommerce_single_summer_start', 0 );
function evolt_woocommerce_single_summer_start() { ?>
	<?php echo '<div class="woocommerce-summary-wrap row">'; ?>
<?php }
add_action( 'woocommerce_after_single_product_summary', 'evolt_woocommerce_single_summer_end', 5 );
function evolt_woocommerce_single_summer_end() { ?>
	<?php echo '</div></div>'; ?>
<?php }


add_action( 'woocommerce_single_product_summary', 'evolt_woocommerce_sg_product_title', 5 );
function evolt_woocommerce_sg_product_title() { 
	global $product; 
	$product_title = evolt_get_option( 'product_title', false ); 
	if($product_title ) : ?>
		<div class="woocommerce-sg-product-title">
			<?php woocommerce_template_single_title(); ?>
		</div>
<?php endif; }

add_action( 'woocommerce_single_product_summary', 'evolt_woocommerce_sg_product_price', 10 );
function evolt_woocommerce_sg_product_price() { ?>
	<div class="woocommerce-sg-product-price">
		<?php woocommerce_template_single_price(); ?>
	</div>
<?php }

add_action( 'woocommerce_single_product_summary', 'evolt_woocommerce_sg_product_rating', 15 );
function evolt_woocommerce_sg_product_rating() { global $product; ?>
	<div class="woocommerce-sg-product-rating d-flex justify-content-between align-items-center">
		<?php woocommerce_template_single_rating(); ?>
		<p class="mb-0 product-stock"> 
			<span class="product-stock-label">Available :</span>
			<span class="product-stock-in">In Stock</span>
		</p>
	</div>
<?php }


add_action( 'woocommerce_single_product_summary', 'evolt_woocommerce_sg_product_excerpt', 20 );
function evolt_woocommerce_sg_product_excerpt() { ?>
	<div class="woocommerce-sg-product-excerpt">
		<?php woocommerce_template_single_excerpt(); ?>
	</div>
<?php }

add_action( 'woocommerce_after_add_to_cart_button', 'evolt_woocommerce_sg_product_button', 30 );
function evolt_woocommerce_sg_product_button() { 
	global $product;
	?>
	<div class="woocommerce-sg-product-button">
		<?php if (class_exists('WPCleverWoosc')) { ?>
			<div class="woocommerce-compare">
		    	<?php echo do_shortcode('[woosc id="'.esc_attr( $product->get_id() ).'"]'); ?>
			</div>
		<?php } ?>
		<?php if (class_exists('WPCleverWoosw')) { ?>
			<div class="woocommerce-wishlist">
		    	<?php echo do_shortcode('[woosw id="'.esc_attr( $product->get_id() ).'"]'); ?>
			</div>
		<?php } ?>
	</div>
<?php }

add_action( 'woocommerce_single_product_summary', 'evolt_woocommerce_sg_social_share', 40 );
function evolt_woocommerce_sg_social_share() { 
	$product_social_share = evolt_get_option( 'product_social_share', false );
	if($product_social_share) : ?>
		<div class="woocommerce-social-share">
			<label><?php echo esc_html__('Share:', 'evolt'); ?></label>
			<a class="lin-social" title="<?php echo esc_attr__('LinkedIn', 'evolt'); ?>" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>%20"><i class="caseicon-linkedin"></i></a>
			<a class="fb-social" title="<?php echo esc_attr__('Facebook', 'evolt'); ?>" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="caseicon-facebook"></i></a>
	        <a class="tw-social" title="<?php echo esc_attr__('Twitter', 'evolt'); ?>" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>%20"><i class="caseicon-twitter"></i></a>
	        <a class="pin-social" title="<?php echo esc_attr__('Pinterest', 'evolt'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&description=<?php the_title(); ?>%20"><i class="caseicon-pinterest"></i></a>
	       
    </div>
<?php endif; }

/* Product Single: Gallery */
add_action( 'woocommerce_before_single_product_summary', 'evolt_woocommerce_single_gallery_start', 0 );
function evolt_woocommerce_single_gallery_start() { ?>
	<?php echo '<div class="woocommerce-gallery col-xl-6 col-lg-6 col-md-6">'; ?>
<?php }
add_action( 'woocommerce_before_single_product_summary', 'evolt_woocommerce_single_gallery_end', 30 );
function evolt_woocommerce_single_gallery_end() { ?>
	<?php echo '</div><div class="col-xl-6 col-lg-6 col-md-6">'; ?>
<?php }

/* Ajax update cart item */
add_filter('woocommerce_add_to_cart_fragments', 'evolt_woo_mini_cart_item_fragment');
function evolt_woo_mini_cart_item_fragment( $fragments ) {
	global $woocommerce;
	$product_subtitle = evolt_get_page_option( 'product_subtitle' );
    ob_start();
    ?>
    <div class="widget_shopping_cart">
		<div class="loader" style="display: none;"></div>
    	<div class="widget_shopping_head">
	    	<div class="widget_shopping_title">
	    		<?php echo esc_html__( 'your Cart', 'evolt' ); ?>
	    	</div>
			<!-- <p class="widget_shopping_text mb-0">Congratulations! You have got <span>FREE Shipping</span> </p> -->
	    </div>
        <div class="widget_shopping_cart_content">
            <?php
            	$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
            ?>
            <ul class="cart_list product_list_widget">

			<?php if ( ! WC()->cart->is_empty() ) : ?>

				<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

							$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
							<li>
								<?php if(!empty($thumbnail)) : ?>
									<div class="cart-product-image">
										<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
											<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
										</a>
									</div>
								<?php endif; ?>
								<div class="cart-product-meta">
									<h3><a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>"><?php echo esc_html($product_name); ?></a></h3>
									<?php if(!empty($_product->get_attribute( 'pa_size' ))){ ?>
										<p class="mb-0">
											<span>Size :</span>
											<span><?php echo $_product->get_attribute( 'pa_size' );?></span>
										</p>
									<?php }
									if(!empty($_product->get_attribute( 'pa_color' ))){ ?>
										<p class="mb-0">
											<span>Color :</span>
											<span><?php echo $_product->get_attribute( 'pa_color' ); ?></span>
										</p>
									<?php } ?>
									<div class="product-quantitys">
									
										<div class="counter">
											<input class="counter__input" cart_item_key="<?php echo $cart_item_key; ?>" type="text" value="<?php echo $cart_item['quantity']?>" name="counter" size="2" readonly="readonly"/><a class="counter__increment" href="#">+</a><a class="counter__decrement" href="#">&ndash;</a>
										</div>

										<p class="price"><?php echo wc_price( $_product->get_price() * $cart_item['quantity'] ) ?></p>
									</div>
									
								 	<?php //echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity d-flex justify-content-between">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?> 
									<?php
										echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
											'<a href="%s" class="remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="caseicon-close"></i></a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_attr__( 'Remove this item', 'evolt' ),
											esc_attr( $product_id ),
											esc_attr( $cart_item_key ),
											esc_attr( $_product->get_sku() )
										), $cart_item_key );
									?>
								</div>	
							</li>
							
							<?php
						}
					}
				?>

				<?php else : ?>

					<li class="empty">
						<i class="caseicon-shopping-cart-alt"></i>
						<span><?php esc_html_e( 'Your cart is empty', 'evolt' ); ?></span>
						<a class="btn btn-animate" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php echo esc_html__('Browse Shop', 'evolt'); ?></a>
					</li>

				<?php endif; ?>

			</ul><!-- end product list -->
        </div>
		<div class="widget_may_also">
			<h1 class="widget_may_also_title">You may also like</h1>
			<div class="widget_may_also_card">
				<div class="row">

					<?php
						$args = array(
							'post_type' => 'product',
							'posts_per_page' => 2,
							// 'orderby' => 'date',
							'no_found_rows' => true,
						);
						$counter = 1;
						$max = 2;
						$loop = new WP_Query( $args );
						shuffle($loop->posts);
						if ( $loop->have_posts() ) {
							while ( ($loop->have_posts()) && ($counter <= $max) ) : $loop->the_post();
								// wc_get_template_part( 'content', 'product' );
								$random_product = wc_get_product( get_the_ID() );
								$rand_pro_title = $random_product->get_title();
								$rand_pro_regular_price = $random_product->get_regular_price();
								$rand_pro_sale_price = $random_product->get_sale_price();
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
								?>

								<div class="col-6">
									<div class="card-image">
										<img src="<?php echo $image[0]; ?>" alt="" class="img-fluid">
									</div>
									<div class="card-contact">
										<p class="mb-0"><?php echo $rand_pro_title; ?></p>
										<div class="d-flex card-contact-price">
											<span class="new_price"><?php echo wc_price($rand_pro_regular_price); ?></span>
											<span class="old_price"><?php echo wc_price($rand_pro_sale_price); ?></span>
										</div>
									</div>
								</div>

								<?php
								$counter++;
							endwhile;
						}
						wp_reset_postdata(); 
					?>

				</div>

			</div>
		</div>
        <?php if ( ! WC()->cart->is_empty() ) : ?>
			<div class="widget_shopping_cart_footer">
				<p class="total d-flex justify-content-between">
					<strong><?php esc_html_e( 'Subtotal', 'evolt' ); ?>:</strong>
					 <?php echo WC()->cart->get_cart_subtotal(); ?>
				</p>

				<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

				<p class="buttons d-flex justify-content-between">
					<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn  view-cart btn-animate wc-forward"><?php esc_html_e( 'View Cart', 'evolt' ); ?></a>
					<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-animate checkout wc-forward"><?php esc_html_e( 'Checkout', 'evolt' ); ?></a>
				</p>
			</div>
		<?php endif; ?>
    </div>
    <?php
    $fragments['div.widget_shopping_cart'] = ob_get_clean();
    return $fragments;
}

/* Ajax update cart total number */

add_filter( 'woocommerce_add_to_cart_fragments', 'evolt_woocommerce_sidebar_cart_count_number' );
function evolt_woocommerce_sidebar_cart_count_number( $fragments ) {
	ob_start();
	?>
	<span class="widget_cart_counter"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'evolt' ), WC()->cart->cart_contents_count ); ?></span>
	<?php
	
	$fragments['span.widget_cart_counter'] = ob_get_clean();
	
	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'evolt_woocommerce_sidebar_cart_count_number_header' );
function evolt_woocommerce_sidebar_cart_count_number_header( $fragments ) {
	ob_start(); ?>
	<span class="widget_cart_counter_header"><?php echo sprintf (_n( '%d', '%d', WC()->cart->cart_contents_count, 'evolt' ), WC()->cart->cart_contents_count ); ?> - <span class="cart-total"><?php echo WC()->cart->get_cart_subtotal(); ?></span></span>
	<?php
	
	$fragments['span.widget_cart_counter_header'] = ob_get_clean();
	
	return $fragments;
}

add_filter( 'woocommerce_output_related_products_args', 'evolt_related_products_args', 20 );
  function evolt_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns'] = 4;
	return $args;
}

/* Pagination Args */
function evolt_filter_woocommerce_pagination_args( $array ) { 
	$array['end_size'] = 1;
	$array['mid_size'] = 1;
    return $array; 
}; 
add_filter( 'woocommerce_pagination_args', 'evolt_filter_woocommerce_pagination_args', 10, 1 ); 

add_filter( 'woocommerce_checkout_before_order_review_heading', 'evolt_checkout_before_order_review_heading', 10 );
  function evolt_checkout_before_order_review_heading() {
	echo '<div class="evolt-checkout-order-review">';
}
add_filter( 'woocommerce_checkout_after_order_review', 'evolt_checkout_after_order_review', 20 );
  function evolt_checkout_after_order_review() {
	echo '</div>';
}