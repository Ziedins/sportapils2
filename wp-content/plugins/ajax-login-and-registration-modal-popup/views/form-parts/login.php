<div class="lrm-signin-section <?php echo !$users_can_register || $is_inline && $default_tab == 'login' ? 'is-selected' : ''; ?>"> <!-- log in form -->
	<form class="lrm-form" action="#0" data-action="login">
        <div class="lrm-fieldset-wrap">

            <div class="lrm-integrations lrm-integrations--login">
                <?php do_action( 'lrm/login_form/before' ); ?>
            </div>

            <p class="lrm-form-message lrm-form-message--init"></p>

            <div class="fieldset">
                <?php $username_label = esc_attr( lrm_setting('messages/login/username', true) ); ?>
                <label class="image-replace lrm-email lrm-ficon-mail" title="<?= $username_label; ?>"></label>
                <input name="username" class="full-width has-padding has-border" type="text" aria-label="<?= $username_label; ?>" placeholder="<?= $username_label; ?>" <?= $fields_required; ?> value="" autocomplete="username" data-autofocus="1">
                <span class="lrm-error-message"></span>
            </div>

            <div class="fieldset">
                <?php $pass_label = esc_attr( lrm_setting('messages/login/password', true) ); ?>
                <label class="image-replace lrm-password lrm-ficon-key" title="<?= $pass_label; ?>"></label>
                <input name="password" class="full-width has-padding has-border" type="password" aria-label="<?= $pass_label; ?>" placeholder="<?= $pass_label; ?>" <?= $fields_required; ?> value="">
                <span class="lrm-error-message"></span>
                <?php if ( apply_filters('lrm/login_form/allow_show_pass', true) ): ?>
                    <span class="hide-password lrm-ficon-eye" data-show="<?php echo lrm_setting('messages/other/show_pass'); ?>" data-hide="<?php echo lrm_setting('messages/other/hide_pass'); ?>" aria-label="<?php echo lrm_setting('messages/other/show_pass'); ?>"></span>
                <?php endif; ?>
            </div>

            <div class="fieldset">
<!--                --><?php //if ( apply_filters('lrm/form/use_nice_checkbox', true) ): ?>
<!--                    <label class="lrm-nice-checkbox__label lrm-remember-me-checkbox">--><?php //echo lrm_setting('messages/login/remember-me', true); ?>
<!--                        <input type="checkbox" class="lrm-nice-checkbox lrm-remember-me" name="remember-me" checked>-->
<!--                        <div class="lrm-nice-checkbox__indicator"></div>-->
<!--                    </label>-->
<!--                --><?php //else: ?>
<!--                    <label class="lrm-remember-me-checkbox">-->
<!--                        <input type="checkbox" class="lrm-remember-me" name="remember-me" checked>-->
<!--                        --><?php //echo lrm_setting('messages/login/remember-me', true); ?>
<!--                    </label>-->
<!--                --><?php //endif; ?>
            </div>

            <div class="lrm-integrations lrm-integrations--login lrm-integrations-before-btn">
                <?php do_action( 'lrm_login_form' ); // Deprecated ?>
                <?php do_action( 'lrm/login_form' ); ?>
            </div>

            <div class="lrm-integrations-otp"></div>

        </div>

		<div class="fieldset fieldset--submit <?= esc_attr($fieldset_submit_class); ?>">
			<button class="full-width has-padding" type="submit">
				<?php echo lrm_setting('messages/login/button', true); ?>
			</button>
            <a class="button-facebook" href="https://sportapils.com/wp-login.php?loginSocial=facebook" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="facebook" data-popupwidth="475" data-popupheight="175">
                <?php esc_html_e( 'Autorizēties ar Facebook', 'sportapils' ); ?>
            </a>
            [nextend_social_login provider="facebook"]
            <div class="nsl-button nsl-button-default nsl-button-google" data-skin="light" style="background-color:#fff;"><div class="nsl-button-svg-container"><svg xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path fill="#4285F4" fill-rule="nonzero" d="M20.64 12.2045c0-.6381-.0573-1.2518-.1636-1.8409H12v3.4814h4.8436c-.2086 1.125-.8427 2.0782-1.7959 2.7164v2.2581h2.9087c1.7018-1.5668 2.6836-3.874 2.6836-6.615z"/><path fill="#34A853" fill-rule="nonzero" d="M12 21c2.43 0 4.4673-.806 5.9564-2.1805l-2.9087-2.2581c-.8059.54-1.8368.859-3.0477.859-2.344 0-4.3282-1.5831-5.036-3.7104H3.9574v2.3318C5.4382 18.9832 8.4818 21 12 21z"/><path fill="#FBBC05" fill-rule="nonzero" d="M6.964 13.71c-.18-.54-.2822-1.1168-.2822-1.71s.1023-1.17.2823-1.71V7.9582H3.9573A8.9965 8.9965 0 0 0 3 12c0 1.4523.3477 2.8268.9573 4.0418L6.964 13.71z"/><path fill="#EA4335" fill-rule="nonzero" d="M12 6.5795c1.3214 0 2.5077.4541 3.4405 1.346l2.5813-2.5814C16.4632 3.8918 14.426 3 12 3 8.4818 3 5.4382 5.0168 3.9573 7.9582L6.964 10.29C7.6718 8.1627 9.6559 6.5795 12 6.5795z"/><path d="M3 3h18v18H3z"/></g></svg></div><div class="nsl-button-label-container"><?php esc_html_e( 'Autorizēties ar Google', 'sportapils' ); ?></div></div>

		</div>

        <div class="lrm-fieldset-wrap">
            <div class="lrm-integrations lrm-integrations--login">
                <?php do_action( 'lrm/login_form/after' ); ?>
            </div>
        </div>

		<input type="hidden" name="redirect_to" value="<?= $redirect_to; ?>">
		<input type="hidden" name="lrm_action" value="login">
		<input type="hidden" name="wp-submit" value="1">
		<!-- Fix for Eduma WP theme-->
		<input type="hidden" name="lp-ajax" value="login">

		<?php wp_nonce_field( 'ajax-login-nonce', 'security-login' ); ?>

		<!-- For Invisible Recaptcha plugin -->
		<span class="wpcf7-submit" style="display: none;"></span>
	</form>

	<p class="lrm-form-bottom-message">
        <a href="#0" class="lrm-switch-to--register"><?php esc_html_e( 'Reģistrēties', 'sportapils' ); ?></a>
        <span class="separator-line">|</span>
        <a href="#0" class="lrm-switch-to--reset-password"><?php echo lrm_setting('messages/login/forgot-password', true); ?></a>
    </p>
	<!-- <a href="#0" class="lrm-close-form">Close</a> -->
</div> <!-- lrm-login -->