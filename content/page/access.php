<?php
$pageName = "page-access";
$accessMap = get_field('access_map_thumb');
?>
<div class="<?php echo $pageName;?>">
  <h1 class="<?php echo $pageName;?>__heading page-heading"><span>アクセス一覧</span></h1>
  <?php if($accessMap):?>
  <figure class="<?php echo $pageName;?>__thumb"><img class="object_fit" src="<?php echo $accessMap;?>" alt="アクセス一覧"></figure>
  <?php endif;?>
  <div class="<?php echo $pageName;?>__inner">
    <?php if(have_rows('access_list')):?>
    <section class="<?php echo $pageName;?>__anchor">
      <?php
      while(have_rows('access_list')): the_row();
      $accessHeading = get_sub_field('access_heading');
      $accessID = get_sub_field('access_id');
      if($accessHeading || $accessID):
      ?>
      <a href="#<?php echo $accessID;?>" class="btn__anchor"><?php echo $accessHeading;?></a>
      <?php endif; endwhile;?>
    </section>
    <?php endif;?>

    <?php
    if(have_rows('access_list')): while(have_rows('access_list')): the_row();
    $accessHeading = get_sub_field('access_heading');
    $accessID = get_sub_field('access_id');
    ?>
    <section id="<?php echo $accessID;?>" class="<?php echo $pageName;?>__cont">
      <?php if($accessHeading):?>
      <h2 class="<?php echo $pageName;?>__contHeading page-ttl"><span><?php echo $accessHeading;?></span></h2>
      <?php endif;?>
      <?php if(have_rows('access_school')):?>
      <ul class="<?php echo $pageName;?>__list">
        <?php
        while(have_rows('access_school')): the_row();
        // 学校名
        $schoolName = get_sub_field('access_school_name');
        $schoolNameMain = $schoolName['access_school_name_main'];
        $schoolNameSupplement = $schoolName['access_school_name_supplement'];
        //画像
        $schoolThumb = get_sub_field('access_school_thumb');
        // 概要
        $schoolInfo = get_sub_field('access_school_info');
        $schoolInfoLocation = $schoolInfo['access_school_location'];
        $schoolInfoTel = $schoolInfo['access_school_tel'];
        $schoolInfoAccess = $schoolInfo['access_school_access'];
        // ボタン
        $schoolBtn = get_sub_field('access_school_btn');
        $schoolBtnUrl = $schoolBtn['access_school_url'];
        $schoolMapUrl = $schoolBtn['access_map_url'];
        ?>
        <li class="<?php echo $pageName;?>__item">
          <?php if($schoolNameMain):?>
          <h3 class="<?php echo $pageName;?>__itemTtl"><?php echo $schoolNameMain;?></h3>
          <?php endif;?>
          <?php if($schoolNameSupplement):?>
          <span><?php echo $schoolNameSupplement;?></span>
          <?php endif;?>
          <div class="<?php echo $pageName;?>__itemRow">
            <figure class="<?php echo $pageName;?>__itemImg"><img src="<?php echo $schoolThumb;?>" alt="" class="object_fit"></figure>
            <figcaption class="<?php echo $pageName;?>__itemInfo">
              <ul>
                <?php  if($schoolInfoLocation):?>
                <li>
                  <h4>所在地</h4>
                  <p><?php echo $schoolInfoLocation;?></p>
                </li>
                <?php endif;?>
                <?php if($schoolInfoTel):?>
                <li>
                  <h4>Tel</h4>
                  <p><a href="tel:<?php echo $schoolInfoTel;?>"><?php echo $schoolInfoTel;?>(代)</a></p>
                </li>
                <?php endif;?>
                <?php  if($schoolInfoAccess):?>
                <li>
                  <h4>アクセス</h4>
                  <p><?php echo $schoolInfoAccess;?></p>
                </li>
                <?php endif;?>
              </ul>
            </figcaption>
          </div>
          <?php if($schoolBtnUrl || $schoolMapUrl):?>
          <div class="<?php echo $pageName;?>__itemBtn">
            <?php if($schoolBtnUrl):?>
            <a href="<?php echo $schoolBtnUrl?>" class="mod-btn w" target="_blank">学校HP</a>
            <?php endif;?>
            <?php if($schoolMapUrl):?>
            <a href="<?php echo $schoolMapUrl;?>" class="mod-btn w" target="_blank">地図を見る</a>
            <?php endif;?>
          </div>
          <?php endif;?>
        </li>
        <?php endwhile;?>
      </ul>
      <?php endif;?>
    </section>
    <?php endwhile; endif;?>
  </div>
</div>
