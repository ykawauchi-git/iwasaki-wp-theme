<?php
$secName="mod-post";
$secTag = get_the_tags();
$secCat = get_the_category();
?>
<article class="<?php echo $secName;?>">
  <?php
  foreach ($secCat as $cat):
  $cat_name = $cat->name;
  // $cat_url = get_category_link($cat->term_id);
  ?>
  <span class="<?php echo $secName;?>__cat"><?php echo $cat_name;?></span>
  <?php endforeach;?>
  <a href="<?php the_permalink(); ?>" class="<?php echo $secName;?>__link" id="post-<?php the_ID(); ?>">
    <div class="<?php echo $secName;?>__high">
      <div class="<?php echo $secName;?>__left">
        <div class="<?php echo $secName;?>__thumb">
          <?php if ( has_post_thumbnail() ): ?><!-- if文による条件分岐 アイキャッチが有る時-->
            <?php echo get_the_post_thumbnail($post->ID,'full', array('class' => 'object_fit')); ?>
          <?php else: ?><!-- アイキャッチが無い時-->
            <img class="object_fit" src="<?php echo get_stylesheet_directory_uri();?>/img/common/img_none.jpg" alt="">
          <?php endif; ?>
        </div>
        <time class="<?php echo $secName;?>__date"><?php the_time('Y.m.d'); ?></time>
      </div>
      <h2 class="<?php echo $secName;?>__ttl"><?php the_title(); ?></h2>
    </div>
    <div class="<?php echo $secName;?>__txt"><?php echo get_the_excerpt(); ?></div>
    </a>
    <!-- タグ一覧 -->
    <?php if($secTag):?>
    <ul class="<?php echo $secName;?>__tag">
      <?php
      foreach($secTag as $tag) :
      // $tag_link = get_tag_link($tag->term_id);
      $tag_name = $tag->name;
      $tag_link = get_tag_link($tag->term_id);
      ?>
      <li><a href="<?php echo $tag_link;?>"><?php echo $tag_name; ?></a></li>
      <?php endforeach;?>
    </ul>
    <?php endif;?>
</article>