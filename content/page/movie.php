<?php
$pageName = "page-movie";
?>

<div class="<?php echo $pageName;?>">
  <div class="<?php echo $pageName;?>__inner">
    <h1 class="page-heading"><?php the_title();?></h1>
    <?php if(have_rows('movie_list')):?>
    <section class="mod-anchor">
      <?php
      while(have_rows('movie_list')): the_row();
      $movieHeading = get_sub_field('movie_heading');
      $movieId = get_sub_field('movie_id');
      ?>
      <a href="#<?php echo $movieId;?>" class="btn__anchor"><?php echo $movieHeading;?></a>
      <?php endwhile;?>
    </section>
    <?php endif;?>
    <ul class="<?php echo $pageName;?>__cont">
      <?php
      if(have_rows('movie_list')): while(have_rows('movie_list')): the_row();
      $movieHeading = get_sub_field('movie_heading');
      $movieId = get_sub_field('movie_id');
      $movieUrl = get_sub_field('movie_url');
      ?>
      <li id="<?php echo $movieId;?>">
        <?php if($movieHeading):?>
        <h3 class="<?php echo $pageName;?>__subTtl"><span><?php echo $movieHeading;?></span></h3>
        <?php endif;?>
        <?php if(have_rows('movie_embed_list')):?>
        <ul class="<?php echo $pageName;?>__list">
          <?php
          while(have_rows('movie_embed_list')): the_row();
          $movieEmbed = get_sub_field('movie_embed_item');
          preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $movieEmbed, $matches);
          $video_id = $matches[1];
      
          // サムネイル画像URLの生成
          $thumbnail_url = "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg";
      
          // YouTubeの埋め込みページから動画タイトルを取得
          $html = file_get_contents("https://www.youtube.com/oembed?url={$movieEmbed}&format=json");
          $data = json_decode($html);
    
          // タイトルの取得
          $video_title = $data->title;
          ?>
          <li class="<?php echo $pageName;?>__item">
            <a href="<?php echo ($movieEmbed);?>" target="_blank">
              <div class="<?php echo $pageName;?>__thumb"><img class="object_fit" src="<?php echo $thumbnail_url;?>" alt=""></div>
              <h3 class="<?php echo $pageName;?>__ttl"><?php echo $video_title;?></h3>
            </a>
          </li>
          <?php endwhile;?>
        </ul>
        <?php endif;?>
        <?php if($movieUrl):?>
        <a class="<?php echo $pageName;?>__btn" href="<?php echo $movieUrl;?>" target="_blank">YouTubeチャンネルを見る</a>
        <?php endif;?>
      </li>
      <?php endwhile; endif;?>
    </ul>
  </div>
</div>