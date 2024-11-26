<?php
$secName="post-career";
$graduateTtl = get_the_title();
$graduateInfo = get_field('career_graduate_info');
$graduateAlma = $graduateInfo['career_graduate_alma_mater'];
$graduateOccupation = $graduateInfo['career_graduate_occupation'];
?>
<article class="<?php echo $secName;?>">
  <a href="<?php the_permalink(); ?>" class="<?php echo $secName;?>__link" id="post-<?php the_ID(); ?>">
    <div class="<?php echo $secName;?>__thumb">
      <?php if ( has_post_thumbnail() ): ?><!-- if文による条件分岐 アイキャッチが有る時-->
        <?php echo get_the_post_thumbnail($post->ID,'full', array('class' => 'object_fit')); ?>
        <?php else: ?><!-- アイキャッチが無い時-->
        <!-- <img class="object_fit" src="<?php echo get_stylesheet_directory_uri();?>/img/archive/img_none.jpg"> -->
      <?php endif; ?>
    </div>
    <div class="<?php echo $secName;?>__info">
      <div class="<?php echo $secName;?>__infoCont">
        <?php if($graduateTtl):?>
        <h2><?php echo $graduateTtl;?></h2>
        <?php endif;?>
        <?php if($graduateAlma):?>
        <div class="<?php echo $secName;?>__infoAlma"><?php echo $graduateAlma;?>　卒業</div>
        <?php endif;?>
        <?php if($graduateOccupation):?>
        <div class="<?php echo $secName;?>__infoOccupation"><?php echo $graduateOccupation;?></div>
        <?php endif;?>
      </div>
      <div class="<?php echo $secName;?>__infoLogo"></div>
    </div>
  </a>
</article>