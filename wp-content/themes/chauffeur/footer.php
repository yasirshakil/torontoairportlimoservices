<?php global $chauffeur_data; ?>

<!-- BEGIN .footer -->
<footer class="footer">

	<!-- BEGIN .footer-inner -->
	<div class="footer-inner clearfix">
		
		<div class="footer-inner-wrapper">
		
		<?php if ( is_active_sidebar('footer-widget-area-1') ) { ?>
			<div class="one-half clearfix">
				<?php dynamic_sidebar( 'footer-widget-area-1' ); ?>
			</div>
		<?php } ?>
		
		<?php if ( is_active_sidebar('footer-widget-area-2') ) { ?>	
			<div class="one-fourth clearfix">
				<?php dynamic_sidebar( 'footer-widget-area-2' ); ?>
			</div>
		<?php } ?>
		
		<?php if ( is_active_sidebar('footer-widget-area-3') ) { ?>	
			<div class="one-fourth clearfix">
				<?php dynamic_sidebar( 'footer-widget-area-3' ); ?>
			</div>
		<?php } ?>
		
		</div>

	<!-- END .footer-inner -->
	</div>
	
	<?php if ( isset($chauffeur_data['footer-message']) ) { ?>
	
	<?php if( $chauffeur_data['footer-message'] != '' || chauffeur_footer_social_icons_check() != 'false' ) { ?>
	
		<!-- BEGIN .footer-bottom -->
		<div class="footer-bottom <?php if ( $chauffeur_data['site-footer-style'] == 'chauffeur-footer-center-align' ) { echo 'footer-bottom-center';} ?>">

			<div class="footer-bottom-inner clearfix">

				<?php echo chauffeur_footer_social_icons(); ?>

				<?php if( $chauffeur_data['footer-message'] ) { ?>
					<p class="footer-message"><?php echo $chauffeur_data['footer-message']; ?></p>
				<?php } ?>

			</div>

		<!-- END .footer-bottom -->
		</div>

	<?php } ?>
	
	<?php } ?>

<!-- END .footer -->	
</footer>

<!-- END .outer-wrapper -->
</div>

<?php wp_footer(); ?>

<!-- END body -->
</body>
</html>