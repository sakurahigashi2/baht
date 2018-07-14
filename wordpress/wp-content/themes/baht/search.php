<?php get_header(); ?>

<?php
global $wp_query;
query_posts($query_string.'&posts_per_page=30');
$total_results = $wp_query->found_posts;
$search_query = get_search_query();
?>

<main>
  <div class="header-pankuzu d-none d-sm-block">
    <div class="container">
      <ul class="row list-unstyled d-flex flex-wrap align-items-center mb-0">
        <?php breadcrumb(); ?>
      </ul>
    </div><!-- //.container -->
  </div><!-- //.header-pankuzu -->
  <div class="header-category d-sm-none">
    <h1 class="header-category-info-ttl"><i class="fas fa-search"></i>&nbsp;検索結果</h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="main col-12 col-lg-8">
        <div class="header-category d-none d-sm-block">
          <div class="header-category-info">
            <h1 class="header-category-info-ttl"><i class="fas fa-search"></i>&nbsp;検索結果</h1>
            <p class="header-category-info-txt">「<?php echo $search_query; ?>」に関連する記事一覧です。</p>
          </div>
        </div><!-- //.header-category -->
        <div>
          <h2 class="category-list-ttl">「<?php echo $search_query; ?>」の検索結果<span>(<?php echo $total_results; ?>件)</span></h2>
          <ul class="medias-list list-unstyled">
            <?php if($total_results > 0 && have_posts()) : while(have_posts()) : the_post(); ?>
              <li class="media">
                <a class="media-anchor d-flex" href="<?php echo get_permalink(); ?>">
                  <div class="media-catch">
                    <img class="widget-list-img" src="<?php the_post_thumbnail_url('medium'); ?>">
                  </div>
                  <div class="media-body">
                    <h3 class="media-body-ttl">
                      <?php echo mb_strimwidth(get_the_title(), 0, 76, '...'); ?>
                    </h3>
                    <div class="media-body-sub">
                      <p class="media-body-description d-none d-md-block">
                        <?php echo mb_substr(strip_tags($post-> post_content), 0, 60).'...'; ?>
                      </p>
                      <p class="media-body-meta">
                        <span class="media-body-meta-date"><?php the_modified_date("Y/m/j") ?></span>&nbsp;|&nbsp;<span class="media-body-meta-author"><?php the_author(); ?></span>
                      </p>
                    </div>
                  </div>
                </a>
              </li>
            <?php endwhile; else: ?>
              <?php echo $search_query; ?> に一致する情報は見つかりませんでした。
            <?php endif; ?>
          </ul>
          <?php pc_pagination($wp_query->max_num_pages); ?>
          <?php sp_pagination($wp_query->max_num_pages); ?>
        </div>
      </div><!-- //.main -->
      <?php get_sidebar(); ?>
    </div><!-- //.row -->
  </div><!-- //.container -->
  <div class="footer-pankuzu d-none d-sm-block">
    <div class="container">
      <ul class="row list-unstyled d-flex flex-wrap align-items-center mb-0">
        <?php breadcrumb(); ?>
      </ul>
    </div><!-- //.container -->
  </div><!-- //.footer-pankuzu -->
</main>

<?php get_footer(); ?>
