
<div class="form__row name">
  <div class="form__col">名前*</div>
  <div class="form__col"><?php echo do_shortcode('[mwform_text name="your_name" id="your_name" class="your_name" size="60"]'); ?>
  </div>
</div>

<div class="form__row company">
  <div class="form__col">会社名</div>
  <div class="form__col"><?php echo do_shortcode('[mwform_text name="your_company" id="your_company" class="your_company" size="60"]'); ?>
  </div>
</div>

<div class="form__row mail">
  <div class="form__col">メールアドレス*</div>
  <div class="form__col"><?php echo do_shortcode('[mwform_email name="your_mail" id="your_mail" class="your_mail" size="60"]'); ?></div>
</div>

<div class="form__row mail_confirm">
  <div class="form__col">確認用メールアドレス*</div>
  <div class="form__col"><?php echo do_shortcode('[mwform_email name="your_mail-confirm" id="your_mail-confirm" class="your_mail-confirm" size="60"]'); ?></div>
</div>

<div class="form__row tel">
  <div class="form__col">電話番号</div>
  <div class="form__col"><?php echo do_shortcode('[mwform_text name="your_tel" id="your_tel" class="your_tel" size="60"]'); ?></div>
</div>

<div class="form__row kinds">
  <div class="form__col">お問い合わせ種別*</div>
  <div class="form__col"><?php echo do_shortcode('[mwform_radio name="your_kinds" id="your_kinds" class="your_kinds" children="メディア出演,取材,大会やイベント出演,YouTube案件,その他"]'); ?><span class="form__note">※その他のご依頼は<a href="https://aaa.com" target="_blank" rel="noreferrer noopener">こちら</a>へ</span></div>
</div>

<div class="form__row content">
  <div class="form__col">お問い合わせ内容*</div>
  <div class="form__col"><?php echo do_shortcode('[mwform_textarea name="your_content" id="your_content" class="your_content" cols="50" rows="8"]'); ?></div>
</div>

<div class="form__btn">
  <label class="form__btn-col back btn__more"><span class="txt"><?php echo do_shortcode('[mwform_backButton class="btn__back" value="戻　る"]'); ?></span><span class="arrow"><span class="corner"></span></span></label>
  <label class="form__btn-col submit btn__more"><span class="txt"><?php echo do_shortcode('[mwform_submitButton name="btn_submit" class="btn__submit" confirm_value="入力内容を確認する" submit_value="送信する"]'); ?></span><span class="arrow"><span class="corner"></span></span></label>
</div>