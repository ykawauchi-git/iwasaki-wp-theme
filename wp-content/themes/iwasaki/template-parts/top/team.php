<?php
$secName = "top-team";
$teamHeading = get_field('top_team_heading');
?>
<section class="<?php echo $secName; ?>">
  <div class="<?php echo $secName; ?>__inner">
    <?php
    $teamHeading = get_field('top_team_heading');
    if (!$teamHeading)
      $teamHeading = get_field('top_team_heading', 'option');
    ?>
    <h2 class="top-team__heading italic"><span><?php echo $teamHeading ? $teamHeading : 'School Groups'; ?></span></h2>
    <div class="top-team__listWrap swiper">
      <?php
      $has_page_team = function_exists('have_rows') && have_rows('top_team_list');
      $has_option_team = function_exists('have_rows') && have_rows('top_team_list', 'option');

      if ($has_page_team || $has_option_team):
        $team_source = $has_page_team ? null : 'option';
        ?>
        <ul class="top-team__list swiper-wrapper">
          <?php
          while (have_rows('top_team_list', $team_source)):
            the_row();
            $teamLogo = get_sub_field('top_team_list_logo');
            $teamName = get_sub_field('top_team_list_name');
            ?>
            <li class="top-team__item swiper-slide">
              <span class="top-team__itemLogo"><img src="<?php echo $teamLogo; ?>" alt=""></span>
              <span class="top-team__itemName"><?php echo $teamName; ?></span>
            </li>
          <?php endwhile; ?>
        </ul>
      <?php else: ?>
        <ul class="top-team__list swiper-wrapper">
          <li class="top-team__item swiper-slide">
            <span class="top-team__itemName">横浜理容美容専門学校</span>
          </li>
          <li class="top-team__item swiper-slide">
            <span class="top-team__itemName">横浜情報ビジネス専門学校</span>
          </li>
        </ul>
      <?php endif; ?>
    </div>
</section>