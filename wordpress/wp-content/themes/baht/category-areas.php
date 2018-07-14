<?php get_header(); ?>

<main>
  <div class="header-pankuzu d-none d-sm-block">
    <div class="container">
      <ul class="row list-unstyled d-flex flex-wrap align-items-center mb-0">
        <?php breadcrumb(); ?>
      </ul>
    </div><!-- //.container -->
  </div><!-- //.header-pankuzu -->
  <div class="header-category d-sm-none">
    <h1 class="header-category-info-ttl"><i class="fas fa-map-marker-alt"></i>&nbsp;エリア一覧</h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="main col-12 col-lg-8">
        <div class="header-category d-none d-sm-block">
          <div class="header-category-info">
            <h1 class="header-category-info-ttl"><i class="fas fa-map-marker-alt ico-gray-light"></i>&nbsp;エリア一覧</h1>
            <p class="header-category-info-txt">Baht(バーツ)で掲載している記事のエリア一覧です。</p>
          </div>
        </div><!-- //.header-category -->
        <div>
          <h2 class="category-list-ttl">タイ</h2>
          <ul class="list-unstyled d-flex flex-wrap align-items-start">
            <?php
            $areas_id = get_cat_ID('エリア');
            $areas = get_terms("category", "child_of=".$areas_id);
            foreach($areas as $area) : $cat_data = get_option('cat_'.intval($area->term_id));
            ?>
              <li class="category-list d-flex align-items-center">
                <a class="d-flex align-items-center" href="<?php echo get_term_link($area); ?>">
                  <div class="widget-list-catch flex-shrink-0">
                    <img class="widget-list-img" src="<?php echo esc_html($cat_data['img']) ?>">
                  </div>
                  <p class="widget-list-txt"><?php echo esc_html($area->name) ?></p>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
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
