<form method="get" id="searchform" action="<?php echo esc_url( home_url( '' ) ); ?>/">
	<input type="text" name="s" id="s" value="<?php _e( 'search', 'sportapils' ); ?>" onfocus='if (this.value == "<?php _e( 'search', 'sportapils' ); ?>") { this.value = ""; }' onblur='if (this.value == "") { this.value = "<?php _e( 'search', 'sportapils' ); ?>"; }' />
	<input type="hidden" id="searchsubmit" value="Search" />
</form>