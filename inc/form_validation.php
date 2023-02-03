<?php
/* mw wp form validate いずれか必須状態 */

function entry_validation_rule( $Validation, $data) {
  $validation_message2 = '未入力項目があります。';

  if ( empty( $data['birth-year'] ) ) {
    $Validation->set_rule( 'birth-year', 'noempty', array( 'message' => $validation_message2 ) );
  } elseif ( empty( $data['birth-month'] ) ) {
    $Validation->set_rule( 'birth-month', 'noempty', array( 'message' => $validation_message2 ) );
  } elseif ( empty( $data['birth-date'] ) ) {
    $Validation->set_rule( 'birth-date', 'noempty', array( 'message' => $validation_message2 ) );
  }

  return $Validation;
}
add_filter( 'mwform_validation_mw-wp-form-211', 'entry_validation_rule', 10, 2 );

function entry_validation_rule2( $Validation, $data) {
  $validation_message2 = '未入力項目があります。';

  if ( empty( $data['birth-year'] ) ) {
    $Validation->set_rule( 'birth-year', 'noempty', array( 'message' => $validation_message2 ) );
  } elseif ( empty( $data['birth-month'] ) ) {
    $Validation->set_rule( 'birth-month', 'noempty', array( 'message' => $validation_message2 ) );
  } elseif ( empty( $data['birth-date'] ) ) {
    $Validation->set_rule( 'birth-date', 'noempty', array( 'message' => $validation_message2 ) );
  }

  return $Validation;
}
add_filter( 'mwform_validation_mw-wp-form-701', 'entry_validation_rule2', 10, 2 );


//お問い合わせフォームエラーメッセージ(jp/209)
function my_exam_validation_rule209( $Validation, $data, $Data ) {
$Validation->set_rule( 'classification', 'required', array( 'message' => 'お客様区分は必須入力項目です。' ) );
$Validation->set_rule( 'your_name', 'noEmpty', array( 'message' => '氏名は必須入力項目です。' ) );
$Validation->set_rule( 'your_mail', 'noEmpty', array( 'message' => 'メールアドレスは必須入力項目です。' ) );
$Validation->set_rule( 'your_mail-confirm', 'noEmpty', array( 'message' => 'メールアドレス(再入力)は必須入力項目です。' ) );
$Validation->set_rule( 'your_tel', 'noEmpty', array( 'message' => '電話番号は必須入力項目です。' ) );
$Validation->set_rule( 'your_contents', 'noEmpty', array( 'message' => 'お問い合わせ内容は必須入力項目です。' ) );
$Validation->set_rule( 'your_mail-confirm', 'eq', array('target' => 'your_mail','message' => '確認用メールアドレスが一致していません。'
  ) );
return $Validation;
}
add_filter( 'mwform_validation_mw-wp-form-209', 'my_exam_validation_rule209', 10, 3 );
//お問い合わせフォームエラーメッセージ(en/709)
function my_exam_validation_rule709( $Validation, $data, $Data ) {
$Validation->set_rule( 'classification', 'required', array( 'message' => 'Customer category is a required item.' ) );
$Validation->set_rule( 'your_name', 'noEmpty', array( 'message' => 'Name is a required item.。' ) );
$Validation->set_rule( 'your_mail', 'noEmpty', array( 'message' => 'Email address is a required item.' ) );
$Validation->set_rule( 'your_mail-confirm', 'noEmpty', array( 'message' => 'Email address (re-enter) is a required item.' ) );
$Validation->set_rule( 'your_tel', 'noEmpty', array( 'message' => 'Telephone number is a required item.' ) );
$Validation->set_rule( 'your_contents', 'noEmpty', array( 'message' => 'Contents of inquiry is a required item.' ) );
$Validation->set_rule( 'your_mail-confirm', 'eq', array('target' => 'your_mail','message' => 'Email addresses do not match.'
  ) );
return $Validation;
}
add_filter( 'mwform_validation_mw-wp-form-709', 'my_exam_validation_rule709', 10, 3 );
//お問い合わせフォームエラーメッセージ(tw/710)
function my_exam_validation_rule710( $Validation, $data, $Data ) {
$Validation->set_rule( 'classification', 'required', array( 'message' => 'Customer category is a required item.' ) );
$Validation->set_rule( 'your_name', 'noEmpty', array( 'message' => 'Name is a required item.。' ) );
$Validation->set_rule( 'your_mail', 'noEmpty', array( 'message' => 'Email address is a required item.' ) );
$Validation->set_rule( 'your_mail-confirm', 'noEmpty', array( 'message' => 'Email address (re-enter) is a required item.' ) );
$Validation->set_rule( 'your_tel', 'noEmpty', array( 'message' => 'Telephone number is a required item.' ) );
$Validation->set_rule( 'your_contents', 'noEmpty', array( 'message' => 'Contents of inquiry is a required item.' ) );
$Validation->set_rule( 'your_mail-confirm', 'eq', array('target' => 'your_mail','message' => 'Email addresses do not match.'
  ) );
return $Validation;
}
add_filter( 'mwform_validation_mw-wp-form-710', 'my_exam_validation_rule710', 10, 3 );
//お問い合わせフォームエラーメッセージ(cn/711)
function my_exam_validation_rule711( $Validation, $data, $Data ) {
$Validation->set_rule( 'classification', 'required', array( 'message' => 'Customer category is a required item.' ) );
$Validation->set_rule( 'your_name', 'noEmpty', array( 'message' => 'Name is a required item.。' ) );
$Validation->set_rule( 'your_mail', 'noEmpty', array( 'message' => 'Email address is a required item.' ) );
$Validation->set_rule( 'your_mail-confirm', 'noEmpty', array( 'message' => 'Email address (re-enter) is a required item.' ) );
$Validation->set_rule( 'your_tel', 'noEmpty', array( 'message' => 'Telephone number is a required item.' ) );
$Validation->set_rule( 'your_contents', 'noEmpty', array( 'message' => 'Contents of inquiry is a required item.' ) );
$Validation->set_rule( 'your_mail-confirm', 'eq', array('target' => 'your_mail','message' => 'Email addresses do not match.'
  ) );
return $Validation;
}
add_filter( 'mwform_validation_mw-wp-form-711', 'my_exam_validation_rule711', 10, 3 );
//お問い合わせフォームエラーメッセージ(ko/712)
function my_exam_validation_rule712( $Validation, $data, $Data ) {
$Validation->set_rule( 'classification', 'required', array( 'message' => 'Customer category is a required item.' ) );
$Validation->set_rule( 'your_name', 'noEmpty', array( 'message' => 'Name is a required item.。' ) );
$Validation->set_rule( 'your_mail', 'noEmpty', array( 'message' => 'Email address is a required item.' ) );
$Validation->set_rule( 'your_mail-confirm', 'noEmpty', array( 'message' => 'Email address (re-enter) is a required item.' ) );
$Validation->set_rule( 'your_tel', 'noEmpty', array( 'message' => 'Telephone number is a required item.' ) );
$Validation->set_rule( 'your_contents', 'noEmpty', array( 'message' => 'Contents of inquiry is a required item.' ) );
$Validation->set_rule( 'your_mail-confirm', 'eq', array('target' => 'your_mail','message' => 'Email addresses do not match.'
  ) );
return $Validation;
}
add_filter( 'mwform_validation_mw-wp-form-712', 'my_exam_validation_rule712', 10, 3 );

//お問い合わせフォーム（採用）エラーメッセージ
function my_exam_validation_rule2( $Validation, $data, $Data ) {
$Validation->set_rule( 'your_name', 'noEmpty', array( 'message' => '氏名は必須入力項目です。' ) );
$Validation->set_rule( 'your_mail', 'noEmpty', array( 'message' => 'メールアドレスは必須入力項目です。' ) );
$Validation->set_rule( 'your_mail-confirm', 'noEmpty', array( 'message' => 'メールアドレス(再入力)は必須入力項目です。' ) );
$Validation->set_rule( 'your_tel', 'noEmpty', array( 'message' => '電話番号は必須入力項目です。' ) );
$Validation->set_rule( 'your_contents', 'noEmpty', array( 'message' => 'お問い合わせ内容は必須入力項目です。' ) );
$Validation->set_rule( 'your_mail-confirm', 'eq', array('target' => 'your_mail','message' => '確認用メールアドレスが一致していません。'
  ) );
return $Validation;
}
add_filter( 'mwform_validation_mw-wp-form-210', 'my_exam_validation_rule2', 10, 3 );


//アルバイト応募フォームエラーメッセージ
function my_exam_validation_rule3( $Validation, $data, $Data ) {
$Validation->set_rule( 'desired', 'required', array( 'message' => '希望職は必須入力項目です。' ) );
$Validation->set_rule( 'position', 'required', array( 'message' => '希望ポジションは必須入力項目です。' ) );
$Validation->set_rule( 'your_name', 'noEmpty', array( 'message' => '氏名は必須入力項目です。' ) );
$Validation->set_rule( 'your_furigana', 'noEmpty', array( 'message' => '氏名（フリガナ）は必須入力項目です。' ) );
$Validation->set_rule( 'your_sex', 'required', array( 'message' => '性別は必須入力項目です。' ) );
$Validation->set_rule( 'your_mail', 'noEmpty', array( 'message' => 'メールアドレスは必須入力項目です。' ) );
$Validation->set_rule( 'your_mail-confirm', 'noEmpty', array( 'message' => 'メールアドレス(再入力)は必須入力項目です。' ) );
$Validation->set_rule( 'your_tel', 'noEmpty', array( 'message' => '電話番号は必須入力項目です。' ) );
$Validation->set_rule( 'region', 'noEmpty', array( 'message' => 'お住いの都道府県は必須入力項目です。' ) );
$Validation->set_rule( 'profession', 'noEmpty', array( 'message' => '現在の職業は必須入力項目です。' ) );
$Validation->set_rule( 'your_mail-confirm', 'eq', array('target' => 'your_mail','message' => '確認用メールアドレスが一致していません。'
  ) );
return $Validation;
}
add_filter( 'mwform_validation_mw-wp-form-211', 'my_exam_validation_rule3', 10, 3 );


//生体管理スタッフ応募フォームエラーメッセージ
function my_exam_validation_rule4( $Validation, $data, $Data ) {
$Validation->set_rule( 'your_name', 'noEmpty', array( 'message' => '氏名は必須入力項目です。' ) );
$Validation->set_rule( 'your_furigana', 'noEmpty', array( 'message' => '氏名（フリガナ）は必須入力項目です。' ) );
$Validation->set_rule( 'your_sex', 'required', array( 'message' => '性別は必須入力項目です。' ) );
$Validation->set_rule( 'your_mail', 'noEmpty', array( 'message' => 'メールアドレスは必須入力項目です。' ) );
$Validation->set_rule( 'your_mail-confirm', 'noEmpty', array( 'message' => 'メールアドレス(再入力)は必須入力項目です。' ) );
$Validation->set_rule( 'your_tel', 'noEmpty', array( 'message' => '電話番号は必須入力項目です。' ) );
$Validation->set_rule( 'region', 'noEmpty', array( 'message' => 'お住いの都道府県は必須入力項目です。' ) );
$Validation->set_rule( 'profession', 'noEmpty', array( 'message' => '現在の職業は必須入力項目です。' ) );
$Validation->set_rule( 'your_mail-confirm', 'eq', array('target' => 'your_mail','message' => '確認用メールアドレスが一致していません。'
  ) );
return $Validation;
}
add_filter( 'mwform_validation_mw-wp-form-701', 'my_exam_validation_rule4', 10, 3 );