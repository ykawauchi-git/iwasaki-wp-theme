<?php
$pageName = "page-support";
$pageHeading = get_the_title();
$supportIntro = get_field('support_intro');
?>
<section class="<?php echo $pageName;?>">
  <?php if($pageHeading):?>
  <h1 class="page-heading page-sitemap__heading"><span><?php echo $pageHeading;?></span></h1>
  <?php endif;?>
  <?php if($supportIntro):?>
  <div class="<?php echo $pageName;?>__intro"><?php echo $supportIntro;?></div>
  <?php endif;?>
  <div class="<?php echo $pageName;?>__anchor">
    <a href="#tuition_support" class="btn__anchor">学費サポート</a>
    <a href="#scholarship_system" class="btn__anchor">特待生制度</a>
    <a href="#student_dormitory" class="btn__anchor">学生寮</a>
  </div>
  <!-- 岩崎学園独自の奨学財団 -->
   <?php
   $foundationTtl = get_field('support_foundation_ttl');
   $foundationImg = get_field('support_foundation_img');
   $foundationTxt = get_field('support_foundation_txt');
   $foundationUrl = get_field('support_foundation_url');
?>
  <div class="<?php echo $pageName;?>__foundation">
    <h2 class="<?php echo $pageName;?>__foundationHeading page-heading"><span>岩崎学園独自の奨学財団</span></h2>
    <div class="<?php echo $pageName;?>__foundationInner">
      <div class="<?php echo $pageName;?>__foundationLeft">
        <?php if($foundationTtl):?>
        <div class="<?php echo $pageName;?>__foundationTtl sp-only"><?php echo $foundationTtl;?></div>
        <?php endif;?>
        <?php if($foundationImg):?>
        <div class="<?php echo $pageName;?>__foundationImg">
          <img class="object_fit" src="<?php echo get_stylesheet_directory_uri();?>/img/page/support/img_foundation01.jpg">
        </div>
        <?php endif;?>
      </div>
      <div class="<?php echo $pageName;?>__foundationRight">
        <?php if($foundationTtl):?>
        <div class="<?php echo $pageName;?>__foundationTtl pctab-only"><?php echo $foundationTtl;?></div>
        <?php endif;?>
        <?php if($foundationTxt):?>
        <div class="<?php echo $pageName;?>__foundationTxt"><?php echo $foundationTxt;?></div>
        <?php endif;?>
        <?php if($foundationUrl):?>
        <a href="<?php echo $foundationUrl;?>" class="mod-btn w">詳しく見る</a>
        <?php endif;?>
      </div>
    </div>
  </div>
  <!-- 学費サポートPLAN -->
  <div class="<?php echo $pageName;?>__plan" id="tuition_support">
    <h2 class="<?php echo $pageName;?>__plan-heading page-heading"><span>学費サポートPLAN</span></h2>
    <?php if(have_rows('support_plan_list')):?>
    <ul class="<?php echo $pageName;?>__planList">
      <?php
      while(have_rows('support_plan_list')): the_row();
      $planTtl = get_sub_field('support_plan_ttl');
      $planTxt = get_sub_field('support_plan_txt');
      $planRecruitmentPeriod = get_sub_field('support_plan_recruitment_period');
      $planConduct = get_sub_field('support_plan_conduct');
      ?>
      <li class="<?php echo $pageName;?>__planItem">
        <?php if($planTtl):?>
        <div class="<?php echo $pageName;?>__planTtl"><?php echo $planTtl;?></div>
        <?php endif;?>
        <?php if($planTxt):?>
        <div class="<?php echo $pageName;?>__planTxt"><?php echo $planTxt;?></div>
        <?php endif;?>
        <?php if($planRecruitmentPeriod || $planConduct):?>
        <ul class="<?php echo $pageName;?>__planSubList">
          <?php if($planRecruitmentPeriod):?>
          <li class="<?php echo $pageName;?>__planSubItem">
            <div class="<?php echo $pageName;?>__planSubTtl">募集時期</div>
            <div class="<?php echo $pageName;?>__planSubTxt"><?php echo $planRecruitmentPeriod;?></div>
          </li>
          <?php endif;?>
          <?php if($planConduct):?>
          <li class="<?php echo $pageName;?>__planSubItem">
            <div class="<?php echo $pageName;?>__planSubTtl">実施校</div>
            <div class="<?php echo $pageName;?>__planSubTxt"><?php echo $planConduct;?></div>
          </li>
          <?php endif;?>
        </ul>
        <?php endif;?>
      </li>
      <?php endwhile;?>
    </ul>
    <?php endif;?>
    <div class="<?php echo $pageName;?>__planSystem" id="scholarship_system">
      <h2 class="<?php echo $pageName;?>__planSystemHeading page-heading"><span>２つの特待生制度</span></h2>
      <?php
      $planSystemIntro = get_field('support_plan_system_intro');
      if($planSystemIntro):
      ?>
      <div class="<?php echo $pageName;?>__planSystemIntro"><?php echo $planSystemIntro;?></div>
      <?php endif;?>

      <ul class="<?php echo $pageName;?>__planSystemList">
        <?php
        if(have_rows('support_plan_system_01')): the_row();
        $planSystem01Txt = get_sub_field('support_plan_system_01_txt');
        $planSystem01Period = get_sub_field('support_plan_system_01_recruitment_period');
        $planSystem01Conduct = get_sub_field('support_plan_system_01_conduct');
        ?>
        <li class="<?php echo $pageName;?>__planSystemItem">
          <div class="<?php echo $pageName;?>__planSystemNum">1</div>
          <div class="<?php echo $pageName;?>__planSystemTtl">特待生入学制度</div>
          <?php if($planSystem01Txt):?>
          <div class="<?php echo $pageName;?>__planSystemTxt"><?php echo $planSystem01Txt;?></div>
          <?php endif;?>
          <?php if( $planSystem01Period || $planSystem01Conduct):?>
          <ul class="<?php echo $pageName;?>__planSystemSubList">
            <?php if($planSystem01Period):?>
            <li class="<?php echo $pageName;?>__planSystemSubItem">
              <div class="<?php echo $pageName;?>__planSystemSubTtl">募集時期</div>
              <div class="<?php echo $pageName;?>__planSystemSubTxt"><?php echo $planSystem01Period;?></div>
            </li>
            <?php endif;?>
            <?php if($planSystem01Conduct):?>
            <li class="<?php echo $pageName;?>__planSystemSubItem">
              <div class="<?php echo $pageName;?>__planSystemSubTtl">実施校</div>
              <div class="<?php echo $pageName;?>__planSystemSubTxt"><?php echo $planSystem01Conduct;?></div>
            </li>
            <?php endif;?>
          </ul>
          <?php endif;?>
        </li>
        <?php endif; reset_rows();?>
        <?php
        if(have_rows('support_plan_system_02')): the_row();
        $planSystem02Txt = get_sub_field('support_plan_system_02_txt');
        $planSystem02Period = get_sub_field('support_plan_system_02_recruitment_period');
        $planSystem02Conduct = get_sub_field('support_plan_system_02_conduct');
        ?>
        <li class="<?php echo $pageName;?>__planSystemItem">
          <div class="<?php echo $pageName;?>__planSystemNum">2</div>
          <div class="<?php echo $pageName;?>__planSystemTtl">内部特待生制度</div>
          <?php if($planSystem02Txt):?>
          <div class="<?php echo $pageName;?>__planSystemTxt"><?php echo $planSystem02Txt;?></div>
          <?php endif;?>
          <?php if( $planSystem02Period || $planSystem02Conduct):?>
          <ul class="<?php echo $pageName;?>__planSystemSubList">
            <?php if($planSystem02Period):?>
            <li class="<?php echo $pageName;?>__planSystemSubItem">
              <div class="<?php echo $pageName;?>__planSystemSubTtl">募集時期</div>
              <div class="<?php echo $pageName;?>__planSystemSubTxt"><?php echo $planSystem02Period;?></div>
            </li>
            <?php endif;?>
            <?php if($planSystem02Conduct):?>
            <li class="<?php echo $pageName;?>__planSystemSubItem">
              <div class="<?php echo $pageName;?>__planSystemSubTtl">実施校</div>
              <div class="<?php echo $pageName;?>__planSystemSubTxt"><?php echo $planSystem02Conduct;?></div>
            </li>
            <?php endif;?>
          </ul>
          <?php endif;?>
        </li>
        <?php endif; reset_rows();?>
      </ul>
    </div>
  </div>
  <!-- 学生寮 -->
  <div class="<?php echo $pageName;?>__dormitory" id="student_dormitory">
    <h2 class="<?php echo $pageName;?>__dormitoryHeading page-heading"><span>学生寮</span></h2>
    <?php
    $dormitoryIntro = get_field('support_dormitory_intro');
    if($dormitoryIntro):
    ?>
    <div class="<?php echo $pageName;?>__dormitoryIntro"><?php echo $dormitoryIntro;?></div>
    <?php endif;?>
    <!-- 指定学生寮（女子）のご案内 -->
    <?php
    if(have_rows('support_dormitory_guide')): the_row();
    $dormitoryGuideIntro = get_sub_field('support_dormitory_guide_intro');
    $dormitoryGuideName = get_sub_field('support_dormitory_guide_name');
    ?>
    <div class="<?php echo $pageName;?>__dormitoryGuide">
      <h3 class="page-subHeading"><span>指定学生寮（女子）のご案内</span></h3>
      <?php if($dormitoryGuideIntro):?>
      <div class="<?php echo $pageName;?>__dormitoryGuideIntro"><?php echo $dormitoryGuideIntro;?></div>
      <?php endif;?>
      <div class="<?php echo $pageName;?>__dormitoryGuideGroup">
        <?php if($dormitoryGuideName):?>
        <div class="<?php echo $pageName;?>__dormitoryGuideName"><?php echo $dormitoryGuideName;?></div>
        <?php endif;?>
        <div class="<?php echo $pageName;?>__dormitoryGuideInner">
          <div class="<?php echo $pageName;?>__dormitoryGuideLeft">
            <?php if( have_rows('support_dormitory_guide_img_list') ): $counter = 0; while( have_rows('support_dormitory_guide_img_list') ): the_row(); if( $counter == 0 ): $dormitoryGuideImg = get_sub_field('support_dormitory_guide_img_item');?>
            <div class="<?php echo $pageName;?>__dormitoryGuideLeftMain">
              <img class="object_fit" src="<?php echo $dormitoryGuideImg;?>">
            </div>
            <?php endif; $counter++; endwhile; endif; ?>
            <?php if(have_rows('support_dormitory_guide_img_list')):?>
            <ul class="<?php echo $pageName;?>__dormitoryGuideLeftSub">
              <?php
              while(have_rows('support_dormitory_guide_img_list')): the_row();
              $dormitoryGuideImg = get_sub_field('support_dormitory_guide_img_item');
              ?>
              <li class="<?php echo $pageName;?>__dormitoryGuideLeftSubItem">
                <img class="object_fit" src="<?php echo $dormitoryGuideImg;?>" alt="">
              </li>
              <?php endwhile;?>
            </ul>
            <?php endif;?>
          </div>
          <?php if(have_rows('support_dormitory_guide_info')):?>
          <ul class="<?php echo $pageName;?>__dormitoryGuideRight">
            <?php
            while(have_rows('support_dormitory_guide_info')): the_row();
            $dormitoryGuideInfoTtl = get_sub_field('support_dormitory_guide_ttl');
            $dormitoryGuideInfoDetail = get_sub_field('support_dormitory_guide_detail');
            ?>
            <li class="<?php echo $pageName;?>__dormitoryGuideRightItem">
              <?php if($dormitoryGuideInfoTtl):?>
              <div class="<?php echo $pageName;?>__dormitoryGuideRightTtl"><?php echo $dormitoryGuideInfoTtl;?></div>
              <?php endif;?>
              <?php if($dormitoryGuideInfoDetail):?>
              <div class="<?php echo $pageName;?>__dormitoryGuideRightTxt"><?php echo $dormitoryGuideInfoDetail;?></div>
              <?php endif;?>
            </li>
            <?php endwhile;?>
          </ul>
          <?php endif;?>
        </div>
      </div>
    </div>
    <?php endif; reset_rows();?>
    <!-- 学生寮3つのポイント -->
    <div class="<?php echo $pageName;?>__dormitoryPoint">
      <h3 class="page-subHeading"><span>学生寮3つのポイント</span></h3>
      <?php
        if(have_rows('support_dormitory_point')): the_row();
      ?>
      <ul class="<?php echo $pageName;?>__dormitoryPointList">
        <!-- 01 -->
         <?php
          $dormitoryPoint01 = get_sub_field('support_dormitory_point_01');
          $dormitoryPoint01Img = $dormitoryPoint01['support_dormitory_point_01_img'];
          $dormitoryPoint01Ttl = $dormitoryPoint01['support_dormitory_point_01_ttl'];
          $dormitoryPoint01Txt = $dormitoryPoint01['support_dormitory_point_01_txt'];
         ?>
        <li class="<?php echo $pageName;?>__dormitoryPointItem">
          <div class="<?php echo $pageName;?>__dormitoryPointLeft">
            <div class="<?php echo $pageName;?>__dormitoryPointNum"><span>1</span></div>
            <?php if($dormitoryPoint01Img):?>
            <img class="object_fit" src="<?php echo $dormitoryPoint01Img;?>">
            <?php endif;?>
          </div>
          <div class="<?php echo $pageName;?>__dormitoryPointRight">
            <?php if($dormitoryPoint01Ttl):?>
            <div class="<?php echo $pageName;?>__dormitoryPointTtl"><?php echo $dormitoryPoint01Ttl;?></div>
            <?php endif;?>
            <?php if($dormitoryPoint01Txt):?>
            <div class="<?php echo $pageName;?>__dormitoryPointTxt"><?php echo $dormitoryPoint01Txt;?></div>
            <?php endif;?>
          </div>
        </li>
        <!-- 02 -->
        <?php
          $dormitoryPoint02 = get_sub_field('support_dormitory_point_02');
          $dormitoryPoint02Img = $dormitoryPoint02['support_dormitory_point_02_img'];
          $dormitoryPoint02Ttl = $dormitoryPoint02['support_dormitory_point_02_ttl'];
          $dormitoryPoint02Txt = $dormitoryPoint02['support_dormitory_point_02_txt'];
         ?>
        <li class="<?php echo $pageName;?>__dormitoryPointItem">
          <div class="<?php echo $pageName;?>__dormitoryPointLeft">
            <div class="<?php echo $pageName;?>__dormitoryPointNum"><span>2</span></div>
            <?php if($dormitoryPoint02Img):?>
            <img class="object_fit" src="<?php echo $dormitoryPoint02Img;?>">
            <?php endif;?>
          </div>
          <div class="<?php echo $pageName;?>__dormitoryPointRight">
            <?php if($dormitoryPoint02Ttl):?>
            <div class="<?php echo $pageName;?>__dormitoryPointTtl"><?php echo $dormitoryPoint02Ttl;?></div>
            <?php endif;?>
            <?php if($dormitoryPoint02Txt):?>
            <div class="<?php echo $pageName;?>__dormitoryPointTxt"><?php echo $dormitoryPoint02Txt;?></div>
            <?php endif;?>
          </div>
        </li>
        <!-- 03 -->
        <?php
          $dormitoryPoint03 = get_sub_field('support_dormitory_point_03');
          $dormitoryPoint03Img = $dormitoryPoint03['support_dormitory_point_03_img'];
          $dormitoryPoint03Ttl = $dormitoryPoint03['support_dormitory_point_03_ttl'];
          $dormitoryPoint03Txt = $dormitoryPoint03['support_dormitory_point_03_txt'];
         ?>
        <li class="<?php echo $pageName;?>__dormitoryPointItem">
          <div class="<?php echo $pageName;?>__dormitoryPointLeft">
            <div class="<?php echo $pageName;?>__dormitoryPointNum"><span>3</span></div>
            <?php if($dormitoryPoint03Img):?>
            <img class="object_fit" src="<?php echo $dormitoryPoint03Img;?>">
            <?php endif;?>
          </div>
          <div class="<?php echo $pageName;?>__dormitoryPointRight">
            <?php if($dormitoryPoint03Ttl):?>
            <div class="<?php echo $pageName;?>__dormitoryPointTtl"><?php echo $dormitoryPoint03Ttl;?></div>
            <?php endif;?>
            <?php if($dormitoryPoint03Txt):?>
            <div class="<?php echo $pageName;?>__dormitoryPointTxt"><?php echo $dormitoryPoint03Txt;?></div>
            <?php endif;?>
          </div>
        </li>
      </ul>
      <?php endif; reset_rows();?>
    </div>
    <div class="<?php echo $pageName;?>__dormitoryGuidance">
      <?php if(have_rows('support_dormitory_guidance')):?>
      <ul class="<?php echo $pageName;?>__dormitoryGuidanceList">
        <?php
        while(have_rows('support_dormitory_guidance')): the_row();
        $dormitoryGuidanceTtl = get_sub_field('support_dormitory_guidance_ttl');
        $dormitoryGuidanceTxt = get_sub_field('support_dormitory_guidance_txt');
        ?>
        <li class="<?php echo $pageName;?>__dormitoryGuidanceItem">
          <?php if($dormitoryGuidanceTtl):?>
          <div class="<?php echo $pageName;?>__dormitoryGuidanceLeft">
            <h3 class="page-subHeading"><span><?php echo $dormitoryGuidanceTtl;?></span></h3>
          </div>
          <?php endif;?>
          <?php if($dormitoryGuidanceTxt):?>
          <div class="<?php echo $pageName;?>__dormitoryGuidanceRight"><?php echo $dormitoryGuidanceTxt;?></div>
          <?php endif;?>
        </li>
        <?php endwhile;?>
      </ul>
      <?php endif;?>
    </div>
    <div class="<?php echo $pageName;?>__dormitoryCv">
      <div class="<?php echo $pageName;?>__dormitoryCvTxt">各種制度・学生寮については<br class="sp-only">各校へお問い合わせください</div>
      <a href="<?php echo home_url('/sitemap/'); ?>" class="mod-btn b">問い合わせる</a>
    </div>
  </div>
  <div class="mod-banner">
    <div class="mod-banner__ttl"><span>充実の設備・施設</span></div>
    <a href="<?php echo home_url('/facility'); ?>" class="mod-btn b">詳しく見る</a>
  </div>
</section>