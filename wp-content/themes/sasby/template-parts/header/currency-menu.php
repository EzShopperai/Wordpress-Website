<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>

<?php if (has_nav_menu('currency_menu')) { ?>
	<?php
		wp_nav_menu(array(
			'theme_location' => 'currency_menu', 
			'menu_class'     => 'your-menu-class',     
			'container'      => 'nav',           
		));
	?>
<?php } ?>