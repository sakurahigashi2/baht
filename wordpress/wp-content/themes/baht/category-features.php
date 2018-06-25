<?php get_header(); ?>

<main>
  <div class="header-pankuzu d-none d-sm-block">
    <div class="container">
      <ul class="row list-unstyled d-flex flex-wrap align-items-center mb-0">
        <?php breadcrumb(); ?>
      </ul>
    </div><!-- //.container -->
  </div><!-- //.header-pankuzu -->
  <div class="header-feature d-sm-none">
    <h1 class="header-feature-info-ttl">特集一覧</h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="feature col-12">
        <div class="header-feature d-none d-sm-block">
          <div class="d-flex">
            <div class="header-feature-info">
              <h1 class="header-feature-info-ttl">特集一覧</h1>
              <p class="header-feature-info-txt">このページは、Baht(バーツ)の特集一覧です。</p>
            </div>
          </div>
        </div><!-- //.header-pages -->
        <div class="feature-list">
          <div class="d-flex justify-content-between flex-wrap">
            <?php
            $features_id = get_cat_ID('特集');
            $features = get_terms("category", "child_of=".$features_id);
            foreach($features as $feature) : $cat_data = get_option('cat_'.intval($feature->term_id));
            ?>
              <a class="feature-list-box" href="<?php echo get_term_link($feature); ?>">
                <div class="feature-list-box-img">
                  <img src="<?php echo esc_html($cat_data['img']) ?>">
                </div>
                <div class="feature-list-box-info">
                  <h2 class="feature-list-box-ttl"><?php echo esc_html($feature->name) ?></h2>
                  <p class="feature-list-box-txt">
                    <?php echo category_description($feature); ?>
                  </p>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div><!-- //.index -->
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
