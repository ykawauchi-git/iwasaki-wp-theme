<?php if(function_exists('bcn_display')){?>
<nav class="mod-breadcrumbs">
	<div class="mod-breadcrumbs__inner">
	<!--Breadcrumb NavXT-->
    <div id="breadcrumbs" class="mod-breadcrumbs__list" typeof="BreadcrumbList" vocab="https://schema.org/">
      <?php if(is_post_type_archive('post')):?>
      <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to トップ" href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home"><span property="name">TOP</span></a><meta property="position" content="1"></span>
      >
      <span class="post-root post post-post current-item">
        <?php
        $post_type = get_query_var('post');
        $post_type_object = get_post_type_object($post_type);
        echo $post_type_object->label;?>
      </span>
      <?php else:?>
      <?php bcn_display();?>
      <?php endif;?>
    </div>
	</div>
</nav><!-- / .page__breadcrumbs-->
<?php } ?>