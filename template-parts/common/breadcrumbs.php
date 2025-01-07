<?php
if(is_post_type_archive('career') || is_singular('career')) {
  $postName = "卒業生の活躍";
  $postSlug = "career";
  $postLink = home_url( '/career/' );
} else {
  $postName = "ニュース一覧";
  $postSlug = "news";
  $postLink = home_url( '/news/' );
}
$postTtl = get_the_title();
$postUrl = get_the_permalink();
if(function_exists('bcn_display')){
?>
<nav class="mod-breadcrumbs">
	<div class="mod-breadcrumbs__inner">
	<!--Breadcrumb NavXT-->
    <div id="breadcrumbs" class="mod-breadcrumbs__list" typeof="BreadcrumbList" vocab="https://schema.org/">
      <?php if(is_archive()):?>
      <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to トップ" href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home"><span property="name">TOP</span></a><meta property="position" content="1"></span>
      <span property="itemListElement" typeof="ListItem">
        <span class="post-root post post-post current-item"><?php echo $postName;?></span>
      </span>
      <?php elseif(is_single()):?>
        <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to トップ" href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home"><span property="name">TOP</span></a><meta property="position" content="1"></span>
        <span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="<?php echo $postName;?>へ移動する" href="<?php echo $postLink;?>" class="archive post-<?php echo $postSlug;?>-archive"><span property="name"><?php echo $postName;?></span></a><meta property="position" content="2"></span>
        <span property="itemListElement" typeof="ListItem"><span property="name" class="post post-<?php echo $postSlug;?> current-item"><?php echo $postTtl;?></span><meta property="url" content="<?php echo $postUrl;?>"><meta property="position" content="3"></span>
      <?php else:?>
      <?php bcn_display();?>
      <?php endif;?>
    </div>
	</div>
</nav><!-- / .page__breadcrumbs-->
<?php } ?>