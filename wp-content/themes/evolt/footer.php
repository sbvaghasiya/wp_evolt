<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 * @package eVolt
 */ 
$back_totop_on = evolt_get_option('back_totop_on', true);
?>
	</div><!-- #content inner -->
</div><!-- #content -->

<?php evolt_footer(); ?>
<?php if (isset($back_totop_on) && $back_totop_on) : ?>
    <a href="#" class="scroll-top"><i class="caseicon-long-arrow-right-three"></i></a>
<?php endif; ?>

</div><!-- #page -->
<?php evolt_search_popup(); ?>
<?php evolt_sidebar_hidden(); ?>
<?php evolt_cart_sidebar(); ?>
<?php evolt_user_form(); ?>
<?php wp_footer(); ?>

</body>
</html>
