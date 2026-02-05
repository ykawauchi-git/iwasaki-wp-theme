<section class="top-movies">
  <div class="top-movies__inner">
    <h2>MOVIES</h2>
    <?php if (function_exists('have_rows') && have_rows('top_movies')): ?>
      <ul class="top-movies__list">
        <?php
        while (function_exists('have_rows') && have_rows('top_movies')):
          the_row();
          $moviesEmbed = get_sub_field('top_movies_embed');
          ?>
          <li>
            <div class="youtube-wrap"><?php echo $moviesEmbed; ?></div>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <ul class="top-movies__list">
        <li>
          <div class="youtube-wrap"><iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ"
              title="YouTube video player" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen></iframe></div>
        </li>
      </ul>
    <?php endif; ?>
    <a href="https://www.youtube.com/channel/UC9xNVB7d0nVB5v_toBOoP1Q" class="btn__more w">もっと見る</a>
  </div>
</section>