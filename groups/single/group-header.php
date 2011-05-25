<?php do_action( 'bp_before_group_header' ) ?>

<?php if( ! dynamic_sidebar( 'groupheader' )) : ?>
 <?php cc_groups_header();?>
<?php endif; ?>

<?php if (is_active_sidebar('groupheaderleft') ){ ?>
	<div class="widgetarea cc-widget">
	<?php dynamic_sidebar( 'groupheaderleft' )?>
	</div>
<?php } ?>
<?php if (is_active_sidebar('groupheadercenter') ){ ?>
	<div <?php if(!is_active_sidebar('groupheaderleft')) { echo 'style="margin-left:30% !important"'; } ?> class="widgetarea cc-widget">
	<?php dynamic_sidebar( 'groupheadercenter' ) ?>
	</div>
<?php } ?>
<?php if (is_active_sidebar('groupheaderright') ){ ?>
	<div class="widgetarea cc-widget cc-widget-right">
	<?php dynamic_sidebar( 'groupheaderright' ) ?>
	</div>
<?php } ?>

<?php do_action( 'bp_after_group_header' ) ?>
