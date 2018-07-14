<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if(is_home()) : ?>
    <title><?php bloginfo('name') ?> - タイ夜遊びキュレーションメディア</title>
    <meta name="description" content="<?php bloginfo('description') ?>">
  <?php elseif(is_single()) : ?>
    <?php
    $description = $post->post_content;
    $description = str_replace(array("\r\n","\r","\n","&nbsp;"),'',$description);
    $description = wp_strip_all_tags($description);
    ?>
    <title><?php the_title('',' | Baht(バーツ)') ?></title>
    <meta name="description" content="<?php echo mb_strimwidth($description, 0, 340, '...'); ?>">
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
  <?php wp_head(); ?>
</head>

<body>
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
