<?php $secName="mod-post"?>
<article class="<?php echo $secName;?>">
  <a href="<?php the_permalink(); ?>" class="<?php echo $secName;?>__link" id="post-<?php the_ID(); ?>">
    <div class="<?php echo $secName;?>__high">
      <div class="<?php echo $secName;?>__left">
        <div class="<?php echo $secName;?>__thumb">
          <?php if ( has_post_thumbnail() ): ?><!-- if文による条件分岐 アイキャッチが有る時-->
            <?php echo get_the_post_thumbnail($post->ID,'full', array('class' => 'object_fit')); ?>
            <?php else: ?><!-- アイキャッチが無い時-->
            <!-- <img class="object_fit" src="<?php echo get_stylesheet_directory_uri();?>/img/archive/img_none.jpg"> -->
          <?php endif; ?>
        </div>
        <time class="<?php echo $secName;?>__date"><?php the_time('Y.m.d'); ?></time>
      </div>
      <h2 class="<?php echo $secName;?>__ttl"><?php the_title(); ?></h2>
    </div>
    <div class="<?php echo $secName;?>__txt"><?php echo get_the_excerpt(); ?></div>
  </a>
</article>