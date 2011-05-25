<?php do_action( 'bp_before_member_header' ) ?>

<?php if( ! dynamic_sidebar( 'memberheader' )) : ?>
 <?php cc_profiles_header();?>
<?php endif; ?>

<div class="clear"></div>

<?php if (is_active_sidebar('memberheaderleft') ){ ?>
	<div class="widgetarea cc-widget">
	<?php dynamic_sidebar( 'memberheaderleft' )?>
	</div>
<?php } ?>
<?php if (is_active_sidebar('memberheadercenter') ){ ?>
	<div <?php if(!is_active_sidebar('memberheaderleft')) { echo 'style="margin-left:30% !important"'; } ?> class="widgetarea cc-widget">
	<?php dynamic_sidebar( 'memberheadercenter' ) ?>
	</div>
<?php } ?>
<?php if (is_active_sidebar('memberheaderright') ){ ?>
	<div class="widgetarea cc-widget cc-widget-right">
	<?php dynamic_sidebar( 'memberheaderright' ) ?>
	</div>
<?php } ?>

<?php do_action( 'bp_after_member_header' ) ?>
