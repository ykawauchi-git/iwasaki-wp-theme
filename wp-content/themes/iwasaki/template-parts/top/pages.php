<section class="top-pages">
  <?php if (function_exists('have_rows') && have_rows('top_pages')): ?>
    <ul class="top-pages__list">
      <?php
      while (function_exists('have_rows') && have_rows('top_pages')):
        the_row();
        $pagesTtl = get_sub_field('top_pages_ttl');
        $pagesTtlJP = $pagesTtl['top_pages_ttl_jp'];
        $pagesTtlEN = $pagesTtl['top_pages_ttl_en'];
        $pagesTxt = get_sub_field('top_pages_txt');
        $pagesLink = get_sub_field('top_pages_link');
        $pagesThumb = get_sub_field('top_pages_thumb');
        ?>
        <li class="top-pages__item right">
          <figcaption class="top-pages__itemBox right">
            <?php if ($pagesTtlJP): ?>
              <h3><?php echo $pagesTtlJP; ?></h3>
            <?php endif; ?>
            <?php if ($pagesTxt): ?>
              <p><?php echo $pagesTxt; ?></p>
            <?php endif; ?>
            <a href="<?php echo home_url('/philosphy/'); ?>">もっと見る</a>
          </figcaption>
          <?php if ($pagesThumb): ?>
            <figure class="top-pages__itemThumb">
              <img class="object_fit" src="<?php echo $pagesThumb; ?>" alt="" class="object_fit">
              <?php if ($pagesTtlEN): ?>
                <span><?php echo $pagesTtlEN; ?></span>
              <?php endif; ?>
            </figure>
          <?php endif; ?>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else: ?>
    <ul class="top-pages__list">
      <li class="top-pages__item right">
        <figcaption class="top-pages__itemBox right">
          <h3>岩崎学園について</h3>
          <p>1927年の創立以来、時代とともに変化しながら、自分らしく生きる若者を応援しています。</p>
          <a href="<?php echo home_url('/about/'); ?>">もっと見る</a>
        </figcaption>
        <figure class="top-pages__itemThumb">
          <img class="object_fit" src="<?php echo get_template_directory_uri(); ?>/img/top/img_page01.jpg" alt="">
          <span>ABOUT</span>
        </figure>
      </li>
      <li class="top-pages__item right">
        <figcaption class="top-pages__itemBox right">
          <h3>岩崎学園の学び</h3>
          <p>多彩な学科と実践的なカリキュラムで、将来活躍できる専門性を身につけます。</p>
          <a href="<?php echo home_url('/philosophy/'); ?>">もっと見る</a>
        </figcaption>
        <figure class="top-pages__itemThumb">
          <img class="object_fit" src="<?php echo get_template_directory_uri(); ?>/img/top/img_page03.jpg" alt="">
          <span>PHILOSOPHY</span>
        </figure>
      </li>
    </ul>
  <?php endif; ?>
</section>