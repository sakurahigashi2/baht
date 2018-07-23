<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if(is_home()) : ?>
    <title><?php bloginfo('name') ?> - タイ夜遊びキュレーションメディア</title>
    <meta name="description" content="<?php bloginfo('description') ?>">
    <meta property="og:site_name" content="<?php bloginfo('name') ?>">
    <meta property="og:title" content="<?php bloginfo('name') ?> - タイ夜遊びキュレーションメディア">
    <meta property="og:description" content="<?php bloginfo('description') ?>">
    <meta property="og:url" content="<?php site_url() ?>">
    <meta property="og:image" content="<?php echo get_the_post_thumbnail_url($post->ID, 'large') ?>">
  <?php elseif(is_single()) : ?>
    <?php
    $description = $post->post_content;
    $description = str_replace(array("\r\n","\r","\n","&nbsp;"),'',$description);
    $description = wp_strip_all_tags($description);
    ?>
    <title><?php the_title('',' | Baht(バーツ)') ?></title>
    <meta name="description" content="<?php echo mb_strimwidth($description, 0, 340, '...'); ?>">
    <meta property="og:title" content="<?php the_title('',' | Baht(バーツ)') ?>">
    <meta property="og:description" content="<?php echo mb_strimwidth($description, 0, 340, '...'); ?>">
    <meta property="og:url" content="<?php echo get_permalink($post->ID) ?>">
    <meta property="og:image" content="<?php echo get_the_post_thumbnail_url($post->ID, 'large') ?>">
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
