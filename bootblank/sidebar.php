<!-- sidebar -->
<?php if(is_active_sidebar('widget-area-1')): ?>
<aside class="sidebar <?php bootblank_sidebar_class(); ?>" role="complementary">

	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
	</div>

</aside>
<?php endif; ?>
<!-- /sidebar -->