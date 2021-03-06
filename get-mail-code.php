<?php
  /*
    Plugin Name: Get Mail Code
    Description: メールアドレスを ASCIIコード に変換し Javascript で表示する
    Author: TCP Inc.
    Version: 1.1
  */
 
/* 文字列を ASCIIコードに変換する */
function str2ascii($str) {
    $i = 0;
    $delim = ',';
    $result = '';
    while (($char = substr($str, $i++, 1)) !== false) {
        if ($i > 1) {
            $result .= $delim;
        }
        $result .= ord($char);
    }
    return $result;
}

/* メールアドレスを Local part, Domain Part に分割し ASCIIコードに変換し、表示用 Javascript を生成する */
function get_mail_code_shortcode($atts) {
    extract(shortcode_atts(array(
                                 'mail' => '',
                                 ),$atts));
    $mail_str = explode('@',$mail);
    $local = str2ascii($mail_str[0].'@');
    $domain = str2ascii($mail_str[1]);

    $ret_str  = '<script type="text/javascript">var ma=String.fromCharCode(';
    $ret_str .= $local;
    $ret_str .= ')+String.fromCharCode(';
    $ret_str .= $domain;
    $ret_str .= ');';
    $ret_str .= 'document.write(';
    $ret_str .= "'<a href=\"mai'+'lto:'+ma+'\">'+ma+'</a>');";
    $ret_str .= '</script>';
    return $ret_str;
}

add_shortcode('get_mail_code','get_mail_code_shortcode');
