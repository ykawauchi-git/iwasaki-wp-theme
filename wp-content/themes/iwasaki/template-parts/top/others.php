<?php $secName = "top-others"; ?>
<section class="<?php echo $secName; ?>">
  <?php
  $has_page_others = function_exists('have_rows') && have_rows('top_others');
  $has_option_others = function_exists('have_rows') && have_rows('top_others', 'option');

  if ($has_page_others || $has_option_others):
    $others_source = $has_page_others ? null : 'option';
    ?>
    <ul class="<?php echo $secName; ?>__list">
      <?php
      while (have_rows('top_others', $others_source)):
        the_row();
        $othersLink = get_sub_field('top_others_link');
        $othersThumb = get_sub_field('top_others_thumb');
        ?>
        <li>
          <a href="<?php echo $othersLink['url']; ?>" target="<?php echo $othersLink['target']; ?>">
            <img class="object_fit" src="<?php echo $othersThumb; ?>" alt="">
            <span><?php echo $othersLink['title']; ?></span>
          </a>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else: ?>
    <ul>
      <li><a href="<?php echo home_url('/privacy/'); ?>">プライバシーポリシー</a></li>
      <li><a href="<?php echo home_url('/contact/'); ?>">お問い合わせ</a></li>
    </ul>
  <?php endif; ?>
</section>