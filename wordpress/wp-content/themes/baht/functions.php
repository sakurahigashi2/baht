<?php
//　head内（ヘッダー）から不要なコード削除
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
//head内（ヘッダー）絵文字削除
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles');
//head内（ヘッダー）Embed系の記述削除
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');
remove_action('template_redirect', 'rest_output_link_header', 11 );

// アイキャッチ画像を有効にする。
add_theme_support('post-thumbnails');

// js読込
function add_js_files() {
  wp_deregister_script('jquery'); // WordPress本体のjquery.jsを読み込まない
  wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/vendor/js/jquery-3.3.1.min.js', null, '201806', false);
  wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/vendor/js/bootstrap.min.js', 'jquery', '201806', false);
  wp_enqueue_script('tooltip', get_template_directory_uri() . '/assets/vendor/js/tooltip.min.js', 'bootstrap', '201806', false);
}
add_action('wp_enqueue_scripts', 'add_js_files');

// css読込
function add_css_files() {
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/vendor/css/bootstrap.min.css', null, '201806');
  wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/vendor/css/fontawesome-all.min.css', null, '201806');
  wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/style.css', 'bootstrap', '201806');
}
add_action('wp_enqueue_scripts', 'add_css_files');

// favicon設定
function set_myfavicon() {
  echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/assets/img/baht.ico">' . "\n";
  echo '<link rel="apple-touch-icon" href="' . get_template_directory_uri() . '/assets/img/baht_180x180.png" sizes="180x180">' . "\n";
}
add_action('wp_head', 'set_myfavicon');

// widget追加
function sidebar_bottom_ads_widgets_init() {
  register_sidebar(
    array(
      'name' => 'サイドバー広告エリア下',
      'id' => 'sidebar_bottom_ads',
      'before_widget' => '<div>',
      'after_widget' => '</div>',
    )
  );
}

function sidebar_top_ads_widgets_init() {
  register_sidebar(
    array(
      'name' => 'サイドバー広告エリア上',
      'id' => 'sidebar_top_ads',
      'before_widget' => '<div>',
      'after_widget' => '</div>',
    )
  );
}

function article_bottom_ads_widgets_init() {
  register_sidebar(
    array(
      'name' => '記事下部広告エリア',
      'id' => 'article_bottom_ads',
      'before_widget' => '<div>',
      'after_widget' => '</div>',
    )
  );
}

function start_body_hidden_widgets_init() {
  register_sidebar(
    array(
      'name' => 'body開始タグ直後script用タグ',
      'id' => 'start_body_hidden',
      'before_widget' => '<div hidden>',
      'after_widget' => '</div>',
    )
  );
}

function end_body_hidden_widgets_init() {
  register_sidebar(
    array(
      'name' => 'body終了タグ直前script用タグ',
      'id' => 'end_body_hidden',
      'before_widget' => '<div hidden>',
      'after_widget' => '</div>',
    )
  );
}

add_action('widgets_init', 'sidebar_top_ads_widgets_init');
add_action('widgets_init', 'sidebar_bottom_ads_widgets_init');
add_action('widgets_init', 'article_bottom_ads_widgets_init');
add_action('widgets_init', 'start_body_hidden_widgets_init');
add_action('widgets_init', 'end_body_hidden_widgets_init');

// pcサイズ用ページネーション
function pc_pagination($pages = '', $range = 2) {
  $showitems = ($range * 2) + 1; // 表示するページ数（５ページを表示）
  global $paged; // 現在のページ値
  if(empty($paged)) $paged = 1; // デフォルトのページ
  if($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages; // 全ページ数を取得
    if(!$pages) $pages = 1; // 全ページ数が空の場合は、１とする
  }

  // 全ページが１でない場合はページネーションを表示する
  if(1 != $pages) {
    echo "<nav class='d-none d-md-block' aria-label='navigation'>";
    echo "<ul class='pagination pagination-lg justify-content-center align-items-center'>";
    for ($i = 1; $i <= $pages; $i++) {
      if (1 != $pages &&( !($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
        echo ($paged == $i) ? "<li class='page-item page-link active $page'>".$i."</li>" : "<li class='page-item'><a class='page-link' href='".get_pagenum_link($i)."'>".$i."</a></li>";
      }
    }
    echo "</ul>";
    echo "</nav>";
  }
}

// spサイズ用ページネーション
function sp_pagination($pages = '', $range = 2) {
  $showitems = ($range * 2) + 1; // 表示するページ数（５ページを表示）
  global $paged; //現在のページ値
  if(empty($paged)) $paged = 1; // デフォルトのページ
  if($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages; // 全ページ数を取得
    if(!$pages) $pages = 1; // 全ページ数が空の場合は、１とする
  }
  // 全ページが１でない場合はページネーションを表示する
  if(1 != $pages) {
    echo "<nav class='d-md-none' aria-label='navigation'>";
    echo "<ul class='pagination pagination-lg justify-content-between align-items-center'>";
    //Back：総ページ数より現在のページ値が小さい場合は表示
    if($paged > 1) {
      echo "<li class='page-item'>";
      echo "<a class='page-link' href='".get_pagenum_link($paged - 1)."' aria-label='Back'>";
      echo "<span aria-hidden='true'><i class='fas fa-angle-left fa-2x'></i></span>";
      echo "<span class='sr-only'>Back</span>";
      echo "</a>";
      echo "</li>";
    } else {
      echo "<li class='page-item'></li>";
    }
    echo "<li class='page-item'>$paged&nbsp;/&nbsp;$pages</li>";
    //Next：現在のページ値が１より大きい場合は表示
    if ($paged < $pages) {
      echo "<li class='page-item'>";
      echo "<a class='page-link' href='".get_pagenum_link($paged + 1)."' aria-label='Next'>";
      echo "<span aria-hidden='true'><i class='fas fa-angle-right fa-2x'></i></span>";
      echo "<span class='sr-only'>Next</span>";
      echo "</a>";
      echo "</li>";
    } else {
      echo "<li class='page-item'></li>";
    }

    echo "</ul>";
    echo "</nav>";
  }
}

// パンくずリスト
function breadcrumb() {
  echo '<li class="pankuzu"><a href="'.get_bloginfo('url').'" ><i class="fas fa-home"></i>&nbsp;トップページ</a></li>';
  //投稿記事ページとカテゴリーページでの、カテゴリーの階層を表示
  $cats = '';
  $cat_id = '';
  if (is_category()) {
    $cats = get_queried_object();
    $cat_id = $cats->parent;
  }
  $cat_list = array();
  while ($cat_id != 0){
    $cat = get_category( $cat_id );
    $cat_link = get_category_link( $cat_id );
    array_unshift( $cat_list, '<a href="'.$cat_link.'">'.$cat->name.'</a>' );
    $cat_id = $cat->parent;
  }
  foreach($cat_list as $value){
    echo '<li class="pankuzu">'.$value.'</li>';
  }
  //現在のページ名を表示
  if (is_singular()) {
    if (is_attachment()) {
      previous_post_link('<li class="pankuzu">%link</li>');
    }
    the_title('<li class="pankuzu">', '</li>');
  }
  else if( is_archive() ) the_archive_title('<li class="pankuzu">', '</li>');
  else if( is_search() ) echo '<li class="pankuzu"><i class="fas fa-search"></i>&nbsp;'.get_search_query().'</li>';
  else if( is_404() ) echo '<li class="pankuzu">ページが見つかりません</li>';
}

// カテゴリー編集に項目を追加
function extra_category_fields($tag) {
  $t_id = $tag->term_id;
  $cat_meta = get_option( "cat_$t_id");
?>
<tr class="form-field">
  <th><label for="extra_text">その他テキスト</label></th>
  <td><input type="text" name="Cat_meta[extra_text]" id="extra_text" size="25" value="<?php if(isset ( $cat_meta['extra_text'])) echo esc_html($cat_meta['extra_text']) ?>" /></td>
</tr>
<tr class="form-field">
  <th><label for="upload_image">画像URL</label></th>
  <td>
    <input id="upload_image" type="text" size="36" name="Cat_meta[img]" value="<?php if(isset ( $cat_meta['img'])) echo esc_html($cat_meta['img']) ?>" /><br />
    画像を追加: <img src="images/media-button-other.gif" alt="画像を追加"  id="upload_image_button" value="Upload Image" style="cursor:pointer;" />
  </td>
</tr>
<?php
}

// メタデータの保存
function save_extra_category_fileds( $term_id ) {
  if ( isset( $_POST['Cat_meta'] ) ) {
    $t_id = $term_id;
    $cat_meta = get_option( "cat_$t_id");
    $cat_keys = array_keys($_POST['Cat_meta']);
    foreach ($cat_keys as $key){
      if (isset($_POST['Cat_meta'][$key])){
        $cat_meta[$key] = $_POST['Cat_meta'][$key];
      }
    }
    update_option( "cat_$t_id", $cat_meta );
  }
}

// 画像アップ用のjsの読み込み
function my_admin_scripts() {
  global $taxonomy;
  if( 'category' == $taxonomy ) {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script('my-upload', get_bloginfo('template_directory') .'/assets/js/upload.js', null, '201806', true);
    wp_enqueue_script('my-upload');
  }
}

// 画像アップ用のcssの読み込み
function my_admin_styles() {
  global $taxonomy;
  if( 'category' == $taxonomy ) {
    wp_enqueue_style('thickbox');
  }
}

add_action('edit_category_form_fields', 'extra_category_fields');
add_action('edit_tag_form_fields', 'extra_tag_fields');
add_action('edited_term', 'save_extra_category_fileds');
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');

// カテゴリー、タグから接頭語を削除
add_filter( 'get_the_archive_title', function ($title) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
  } elseif ( is_author() ) {
    $title = '<span class="vcard">' . get_the_author() . '</span>' ;
  }
  return $title;
});

// メタディスクリプションの設定
function get_description() {
  if(is_single()) {
    // 投稿画面で入力した抜粋を出力用の変数へ代入
    $description = get_the_excerpt();
  }
  // 抜粋が無い場合は通常通りキャッチフレーズを出力
  if(empty($description)) {
    $description = bloginfo('description');
  }
  return $description;
}

// 通貨の交換レート取得
function get_currency_rate() {
  global $wpdb;
  $query = "SELECT * FROM $wpdb->currency_rates LIMIT 1;";
  $rows = $wpdb->get_results($query);
  if($rows){
    foreach ($rows as $row) {
      $created_at = $row->created_at;
      $date = mysql2date('Y/m/d H:i:s', $created_at);
      echo "<p class='m-0'>";
      echo "<span data-currency='baht'>1</span>バーツ&nbsp;=&nbsp;約<span data-currency='yen'>$row->rate</span>円";
      echo "</p>";
      echo "<p class='m-0'>";
      echo "<span data-currency='date'>$date</span>時点";
      echo "<a href='//info.finance.yahoo.co.jp/fx/convert/?a=1&s=THB&t=JPY' target='_blank'><i class='fas fa-external-link-square-alt ico-gray'></i></a>";
      echo "</p>";
    }
  }
}

//
// エディターのカスタマイズ
//
function editor_setting($init) {
  $style_formats = array(
    array(
      'title' => '要約',
      'block' => 'div',
      'classes'=> 'article-description'
    ),
    array(
      'title' => '文章',
      'block' => 'p',
      'classes'=> 'article-txt'
    ),
    array(
      'title' => '文中タイトル',
      'block' => 'h2',
      'classes'=> 'article-ttl-sub'
    ),
    array(
      'title' => '画像',
      'block' => 'div',
      'classes'=> 'article-img'
    ),
    array(
      'title' => 'YouTube',
      'block' => 'div',
      'classes'=> 'article-movie'
    ),
  );
  $init['style_formats'] = json_encode( $style_formats );
  return $init;
}
add_filter('tiny_mce_before_init', 'editor_setting');

//エディタのスタイルメニューを有効化
function add_stylebuttons($buttons){
  array_splice($buttons, 1, 0, 'styleselect');
  return $buttons;
}
add_filter('mce_buttons_2' , 'add_stylebuttons');

// 記事の自動整形を無効にする
remove_filter('the_content', 'wpautop');
// 抜粋の自動整形を無効にする
remove_filter('the_excerpt', 'wpautop');

// 画像タグ
//挿入した画像に好きなクラス名を追加する
add_filter('get_image_tag_class', 'add_image_class');
  function add_image_class($classes) {
  return $classes . ' article-img';
}
