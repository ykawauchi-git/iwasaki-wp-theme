
</main>
<!-- ////コンテンツ -->

<!-- フッター -->
<footer class="common-footer" id="Footer">
  <span class="common-footer__pageTop" style="display:none"></span>
  <div class="common-footer__inner">
    <figure class="common-footer__logo"><img src="<?php echo get_stylesheet_directory_uri();?>/img/common/logo_footer.svg" alt=""></figure>
    <nav class="common-footer__nav top">
      <ul class="common-footer__navMenu info">
        <li><a href="<?php echo home_url('/');?>" class="contact">お問い合わせ</a></li>
        <li><a href="<?php echo home_url('/');?>" class="document">資料請求</a></li>
        <li><a href="<?php echo home_url('/');?>" class="access">アクセス</a></li>
      </ul>
      <ul class="common-footer__navMenu contact">
        <li><a href="<?php echo home_url('/');?>" class="contact">保護者の方</a></li>
        <li><a href="<?php echo home_url('/');?>" class="document">高校の先生方</a></li>
        <li><a href="<?php echo home_url('/');?>" class="access">企業の方</a></li>
        <li><a href="<?php echo home_url('/');?>" class="document">卒業生の方</a></li>
        <li><a href="<?php echo home_url('/');?>" class="access">教職員採用</a></li>
      </ul>
      <ul class="common-footer__navMenu page">
        <li><a href="<?php echo home_url('/about/');?>">岩崎学園について</a></li>
        <li><a href="<?php echo home_url('/service/');?>">岩崎学園グループ</a></li>
        <li><a href="<?php echo home_url('/members/');?>">岩崎学園の学び</a></li>
        <li><a href="<?php echo home_url('/company/');?>">学生支援</a></li>
        <li><a href="<?php echo home_url('/contact/');?>">動画で見る岩崎学園</a></li>
      </ul>
    </nav>
    <nav class="common-footer__nav bottom">
      <h3>岩崎学園教育施設</h3>
      <ul class="common-footer__navMenu institution">
        <li>
          <span>専門学校</span>
          <ul>
            <li><a href="" target="_blank">情報科学専門学校</a></li>
            <li><a href="" target="_blank">横浜医療情報専門学校</a></li>
            <li><a href="" target="_blank">横浜ｆカレッジ</a></li>
            <li><a href="" target="_blank">横浜リハビリテーション専門学校</a></li>
            <li><a href="" target="_blank">横浜デジタルアーツ専門学校</a></li>
            <li><a href="" target="_blank">横浜保育福祉専門学校</a></li>
            <li><a href="" target="_blank">横浜実践看護専門学校</a></li>
          </ul>
        </li>
        <li>
          <span>幼児教育施設</span>
          <ul>
            <li><a href="" target="_blank">岩崎学園付属幼稚園</a></li>
            <li><a href="" target="_blank">岩崎学園付属磯子幼稚園</a></li>
            <li><a href="" target="_blank">岩崎学園東戸塚保育園</a></li>
            <li><a href="" target="_blank">岩崎学園新横浜保育園</a></li>
            <li><a href="" target="_blank">​岩崎学園新横浜第二保育園</a></li>
            <li><a href="" target="_blank">岩崎学園新横浜放課後児童クラブ</a></li>
            <li><a href="" target="_blank">岩崎学園品濃町放課後児童クラブ</a></li>
          </ul>
        </li>
        <li>
          <div class="col">
            <span>大学院大学</span>
            <ul>
              <li><a href="" target="_blank">情報セキュリティ大学院大学</a></li>
            </ul>
          </div>
          <div class="col">
            <span>文化施設</span>
            <ul>
              <li><a href="" target="_blank">岩崎博物館（ゲーテ座記念）</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
    <p class="common-footer__privacy"><a href="<?php echo home_url('/privacy-policy/');?>">プライバシーポリシー</a></p>
    <small class="common-footer__copyright">COPYRIGHT &copy; IWASAKI GAKUEN. ALL RIGHTS RESERVED.</small>
  </div>
</footer>
<!-- ////フッター -->

</div><!-- / #Wrapper-->
<?php wp_footer(); ?>

</body>
</html>