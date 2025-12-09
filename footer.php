<?php
//パンくず
  if(!is_page(array('sitemap','privacy-policy','media-policy')) && !is_archive() && !is_single() && !is_404()){
    echo '<section class="pageSec"><span class="pageSec__bg"></span></section>';
  }
?>
</main>
<!-- ////コンテンツ -->

<?php /*<!-- フッター -->
<footer class="common-footer" id="Footer">
  <!-- <span class="common-footer__pageTop" style="display:none"></span> -->
  <div class="common-footer__inner">
    <figure class="common-footer__logo"><?php get_template_part('template-parts/svg/logo');?></figure>
    <nav class="common-footer__nav top">
      <ul class="common-footer__navMenu page">
        <li><a href="<?php echo home_url('/about/');?>">岩崎学園について</a></li>
        <li><a href="<?php echo home_url('/facilities/');?>">教育事業</a></li>
        <li><a href="<?php echo home_url('/philosophy/');?>">産官学・地域連携</a></li>
        <li><a href="<?php echo home_url('/career/');?>">卒業生の活躍</a></li>
        <li><a href="<?php echo home_url('/movie/');?>">動画で見る岩崎学園</a></li>
      </ul>
      <ul class="common-footer__navMenu info">
        <li><a href="<?php echo home_url('/contact/');?>" class="contact">お問い合わせ</a></li>
        <li><a href="<?php echo home_url('/access/');?>" class="access">アクセス</a></li>
      </ul>
    </nav>
    <nav class="common-footer__nav bottom">
      <h3>岩崎学園施設</h3>
      <ul class="common-footer__navMenu institution">
        <li>
          <span>専門学校教育</span>
          <ul>
            <li><a href="https://isc.iwasaki.ac.jp/" target="_blank">情報科学専門学校</a></li>
            <li><a href="https://ysw.iwasaki.ac.jp/" target="_blank">横浜スポーツ＆医療ウェルネス専門学校<span>(旧校名 横浜医療情報専門学校)</span></a></li>
            <li><a href="https://yfc.iwasaki.ac.jp/" target="_blank">横浜ｆカレッジ</a></li>
            <li><a href="https://yda.iwasaki.ac.jp/" target="_blank">横浜デジタルアーツ専門学校</a></li>
            <li><a href="https://ycr.iwasaki.ac.jp/" target="_blank">横浜リハビリテーション専門学校</a></li>
            <li><a href="https://hoiku.iwasaki.ac.jp/" target="_blank">横浜保育福祉専門学校</a></li>
            <li><a href="https://jkango.iwasaki.ac.jp/" target="_blank">横浜実践看護専門学校</a></li>
          </ul>
        </li>
        <li>
          <span>子育て支援・幼児教育</span>
          <ul>
            <li><a href="https://www.iwasaki.ac.jp/hodogaya/index.html" target="_blank">岩崎学園附属幼稚園</a></li>
            <li><a href="https://www.iwasaki.ac.jp/isogo/index.htm" target="_blank">岩崎学園附属磯子幼稚園</a></li>
            <li><a href="https://hoiku.iwasaki.ac.jp/nursery/" target="_blank">岩崎学園東戸塚保育園</a></li>
            <li><a href="https://hoiku.iwasaki.ac.jp/kosodate/isyh/index.html" target="_blank">岩崎学園新横浜保育園</a></li>
            <li><a href="https://hoiku.iwasaki.ac.jp/kosodate/isyh2/index.html" target="_blank">​岩崎学園新横浜第二保育園</a></li>
            <li><a href="https://hoiku.iwasaki.ac.jp/gakudou/s_index.html" target="_blank">岩崎学園新横浜放課後児童クラブ</a></li>
            <li><a href="https://hoiku.iwasaki.ac.jp/gakudou" target="_blank">岩崎学園品濃町放課後児童クラブ<br>［大地］・［大空］</a></li>
          </ul>
        </li>
        <li>
          <div class="col">
            <span>大学院大学</span>
            <ul>
              <li><a href="https://www.iisec.ac.jp/" target="_blank">情報セキュリティ大学院大学</a></li>
            </ul>
          </div>
          <div class="col">
            <span>生涯教育・NPO支援事業</span>
            <ul>
              <li><a href="https://www.isef.or.jp/" target="_blank">特定非営利活動法人 <br>NPO情報セキュリティフォーラム</a></li>
            </ul>
          </div>
          <div class="col">
            <span>文化振興</span>
            <ul>
              <li><a href="https://www.iwasaki.ac.jp/museum/index.html" target="_blank">岩崎博物館［ゲーテ座記念］</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
    <ul class="common-footer__privacy">
      <li><a href="<?php echo home_url('/sitemap/');?>">サイトマップ</a></li>
      <li><a href="<?php echo home_url('/privacy-policy/');?>">サイトポリシー</a></li>
      <li><a href="<?php echo home_url('/media-policy/');?>">メディアポリシー</a></li>
    </ul>
    <small class="common-footer__copyright">&copy; 2025 IWASAKI GAKUEN.</small>
  </div>
</footer>
<!-- ////フッター -->*/?>

<?php remove_filter ('acf_the_content', 'wpautop'); the_field('common_footer','option');?>

</div><!-- / #Wrapper-->
<?php wp_footer(); ?>

</body>
</html>