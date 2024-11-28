<?php
$pageName = "single-career";
$careerTtl = get_the_title();
$graduateInfo = get_field('career_graduate_info');
$graduateAlma = $graduateInfo['career_graduate_alma_mater'];
$graduateOccupation = $graduateInfo['career_graduate_occupation'];
?>
<section class="<?php echo $pageName;?> single-wrap">
  <div class="<?php echo $pageName;?>__info">
    <div class="<?php echo $pageName;?>__infoThumb">
      <?php if ( has_post_thumbnail() ): ?><!-- if文による条件分岐 アイキャッチが有る時-->
        <?php echo get_the_post_thumbnail($post->ID,'full', array('class' => 'object_fit')); ?>
        <?php else: ?><!-- アイキャッチが無い時-->
        <!-- <img class="object_fit" src="<?php //echo get_stylesheet_directory_uri();?>/img/archive/img_none.jpg"> -->
      <?php endif; ?>
    </div>
    <div class="<?php echo $pageName;?>__infoCont">
      <?php if($careerTtl):?>
      <h1><?php echo $careerTtl;?></h1>
      <?php endif;?>
      <ul class="<?php echo $pageName;?>__infoList">
        <?php if($graduateAlma):?>
        <li>
          <div class="<?php echo $pageName;?>__infoTtl">出身校</div>
          <div class="<?php echo $pageName;?>__infoDetail"><?php echo $graduateAlma;?></div>
        </li>
        <?php endif;?>
        <?php if($graduateOccupation):?>
        <li>
          <div class="<?php echo $pageName;?>__infoTtl">職　業</div>
          <div class="<?php echo $pageName;?>__infoDetail"><?php echo $graduateOccupation;?></div>
        </li>
        <?php endif;?>
      </ul>
    </div>
  </div>
  <?php if(have_rows('career_editor')):?>
  <ul class="<?php echo $pageName;?>__editor">
    <?php
    while(have_rows('career_editor')): the_row();
    $editorType = get_sub_field('career_editor_type');
    $editorValue = $editorType['value'];
    $editorLabel = $editorType['label'];
    if($editorValue == 'タイプA') {
      $editorTypeValue = "type-a";
    } elseif($editorValue == 'タイプB') {
      $editorTypeValue = "type-b";
    } elseif($editorValue == 'タイプC') {
      $editorTypeValue = "type-c";
    }

    $editorHeading = get_sub_field('career_editor_heading');
    $editorThumb = get_sub_field('career_editor_thumb');
    $editorTxt = get_sub_field('career_editor_txt');
    ?>
    <li class="<?php echo $editorTypeValue;?>">
      <?php if($editorHeading):?>
      <h2><?php echo $editorHeading;?></h2>
      <?php endif;?>
      <div class="<?php echo $pageName;?>__editorCont">
        <?php if($editorThumb):?>
        <div class="<?php echo $pageName;?>__editorThumb">
          <img class="object_fit" src="<?php echo $editorThumb;?>" alt="">
        </div>
        <?php endif;?>
        <?php if($editorTxt):?>
        <p class="<?php echo $pageName;?>__editorTxt"><?php echo $editorTxt;?></p>
        <?php endif;?>
      </div>
    </li>
    <?php endwhile;?>
  </ul>
  <?php endif;?>
  <!-- 他の卒業生たち -->
  <div class="<?php echo $pageName;?>__other">
    <h2 class="page-subHeading"><span>他の卒業生たち</span></h2>
    <ul class="<?php echo $pageName;?>__otherList">
      <?php
      $args = array(
        'post_type' => 'career',
        'posts_per_page' => 2,
        'orderby' => 'rand',
        'post__not_in' => array($post -> ID),
      );
      $career_query = new WP_Query($args); if($career_query->have_posts()): while ($career_query->have_posts()): $career_query->the_post();
      get_template_part('content/loop/career');
      endwhile;else:
      echo '<p style="margin-top: 3em;">まだ記事がありません。</p>';
      endif;?>
    </ul>
    <a class="btn__more b" href="<?php echo home_url('/career/');?>">一覧へ戻る</a>
  </div>
</section>