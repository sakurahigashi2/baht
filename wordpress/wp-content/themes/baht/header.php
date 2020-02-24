<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
    console.log('\n' +
      'BBBBBBBBBBBBBBBBB                     hhhhhhh                      tttt          \n' +
      'B::::::::::::::::B                    h:::::h                   ttt:::t          \n' +
      'B::::::BBBBBB:::::B                   h:::::h                   t:::::t          \n' +
      'BB:::::B     B:::::B                  h:::::h                   t:::::t          \n' +
      '  B::::B     B:::::B  aaaaaaaaaaaaa    h::::h hhhhh       ttttttt:::::ttttttt    \n' +
      '  B::::B     B:::::B  a::::::::::::a   h::::hh:::::hhh    t:::::::::::::::::t    \n' +
      '  B::::BBBBBB:::::B   aaaaaaaaa:::::a  h::::::::::::::hh  t:::::::::::::::::t    \n' +
      '  B:::::::::::::BB             a::::a  h:::::::hhh::::::h tttttt:::::::tttttt    \n' +
      '  B::::BBBBBB:::::B     aaaaaaa:::::a  h::::::h   h::::::h      t:::::t          \n' +
      '  B::::B     B:::::B  aa::::::::::::a  h:::::h     h:::::h      t:::::t          \n' +
      '  B::::B     B:::::B a::::aaaa::::::a  h:::::h     h:::::h      t:::::t          \n' +
      '  B::::B     B:::::Ba::::a    a:::::a  h:::::h     h:::::h      t:::::t    tttttt\n' +
      'BB:::::BBBBBB::::::Ba::::a    a:::::a  h:::::h     h:::::h      t::::::tttt:::::t\n' +
      'B:::::::::::::::::B a:::::aaaa::::::a  h:::::h     h:::::h      tt::::::::::::::t\n' +
      'B::::::::::::::::B   a::::::::::aa:::a h:::::h     h:::::h        tt:::::::::::tt\n' +
      'BBBBBBBBBBBBBBBBB     aaaaaaaaaa  aaaa hhhhhhh     hhhhhhh          ttttttttttt  \n'
    )
  </script>
  <?php if(is_home()) : ?>
    <title><?php bloginfo('name') ?> - タイ夜遊びキュレーションメディア</title>
    <meta name="description" content="<?php bloginfo('description') ?>">
    <meta property="og:site_name" content="<?php bloginfo('name') ?>">
    <meta property="og:title" content="<?php bloginfo('name') ?> - タイ夜遊びキュレーションメディア">
    <meta property="og:description" content="<?php bloginfo('description') ?>">
    <meta property="og:url" content="<?php site_url() ?>">
    <meta property="og:image" content="<?php echo get_the_post_thumbnail_url($post->ID, 'large') ?>">
    <meta name="twitter:image" content="<?php echo get_the_post_thumbnail_url($post->ID, 'large') ?>">
  <?php elseif(is_single()) : ?>
    <?php
    $description = $post->post_content;
    $description = str_replace(array("\r\n","\r","\n","&nbsp;"),'',$description);
    $description = wp_strip_all_tags($description);
    $author = get_userdata($post->post_author);
    ?>
    <title><?php the_title('',' | Baht(バーツ)') ?></title>
    <meta name="description" content="<?php echo mb_strimwidth($description, 0, 340, '...'); ?>">
    <meta property="og:title" content="<?php the_title('',' | Baht(バーツ)') ?>">
    <meta property="og:description" content="<?php echo mb_strimwidth($description, 0, 340, '...'); ?>">
    <meta property="og:url" content="<?php echo get_permalink($post->ID) ?>">
    <meta property="og:image" content="<?php echo get_the_post_thumbnail_url($post->ID, 'large') ?>">
    <meta name="twitter:image" content="<?php echo get_the_post_thumbnail_url($post->ID, 'large') ?>">
    <script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "Article",
        "mainEntityOfPage": {
          "@type": "WebPage",
          "@id": "<?php echo get_permalink($post->ID) ?>"
        },
        "headline": "<?php the_title() ?>",
        "image": [
          "<?php echo get_the_post_thumbnail_url($post->ID, 'large') ?>"
        ],
        "datePublished": "<?php echo get_the_date('Y-m-d') ?>",
        "dateModified": "<?php the_modified_date('Y-m-d') ?>",
        "author": {
          "@type": "Person",
          "name": "<?php echo the_author_meta('nickname', $author->ID) ?>"
        },
         "publisher": {
          "@type": "Organization",
          "name": "<?php echo the_author_meta('nickname', $author->ID) ?>",
          "logo": {
            "@type": "ImageObject",
            "url": "<?php echo get_template_directory_uri() . '/assets/img/baht_180x180.png' ?>"
          }
        },
        "description": "<?php echo mb_strimwidth($description, 0, 340, '...'); ?>"
      }
    </script>
  <?php elseif(is_category()): ?>
    <title>「<?php single_cat_title() ?>」に関する記事一覧 | <?php bloginfo('name') ?></title>
  <?php elseif(is_tag()): ?>
    <title>「<?php single_tag_title() ?>」に関する記事一覧 | <?php bloginfo('name') ?></title>
  <?php elseif(is_search()): ?>
    <title>検索結果 | Baht(バーツ)</title>
  <?php else : ?>
    <title><?php bloginfo('name') ?> - タイ夜遊びキュレーションメディア</title>
  <?php endif; ?>
  <meta name="keywords" content="タイ,バンコク,パタヤ,バーツ,baht,夜遊び,ゴーゴーバー,置屋,ペイバー,バーファイン,東南アジア">
  <meta property="og:type" content="article">
  <meta property="og:locale" content="ja_JP">
  <meta name="twitter:card" content="summary_large_image">
  <?php wp_head(); ?>
</head>

<body>
<?php if (is_active_sidebar('start_body_hidden')) : ?>
  <?php dynamic_sidebar('start_body_hidden'); ?>
<?php endif; ?>
<header>
  <div class="header container-fluid d-flex justify-content-between align-items-center">
    <div class="col-md-4 d-none d-md-block">
      <?php get_search_form(); ?>
    </div>
    <div class="col-12 col-md-4 text-center">
      <a href="/" class="header-logo">
        <span class="logo-hover-red">B</span>aht
      </a>
    </div>
    <div class="header-currency col-md-4 text-right d-none d-md-block">
      <?php get_currency_rate(); ?>
    </div>
  </div>
</header>
