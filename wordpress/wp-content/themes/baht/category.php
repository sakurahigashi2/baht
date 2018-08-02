<?php get_header(); ?>

<main>
  <div class="header-pankuzu d-none d-sm-block">
    <div class="container">
      <ul class="row list-unstyled d-flex flex-wrap align-items-center mb-0">
        <?php breadcrumb(); ?>
      </ul>
    </div><!-- //.container -->
  </div><!-- //.header-pankuzu -->
  <?php
  $cat = get_category($cat);
  $cat_id = $cat->term_id;
  $cat_name = $cat->cat_name;
  $cat_description = $cat->description;
  $cat_data = get_option('cat_'.intval($cat_id));
  $cat_parent = get_category($cat->category_parent);
  $cat_parent_id = $cat_parent->term_id;
  $cat_parent_name = $cat_parent->cat_name;
  $cat_args = array(
    'post_type'=>'post',
    'posts_per_page' => 30,
    'category__in' => $cat_id,
    'paged' => $paged
  );
  $cat_query = new WP_Query($cat_args);
  ?>
  <div class="header-pages-catch d-sm-none">
    <img src="<?php echo esc_html($cat_data['img']) ?>">
  </div>
  <div class="container">
    <div class="row">
      <div class="main col-12 col-lg-8">
        <div class="header-pages">
          <div class="d-flex">
            <div class="header-pages-catch d-none d-sm-block flex-shrink-0">
              <img src="<?php echo esc_html($cat_data['img']) ?>">
            </div>
            <div class="header-pages-info">
              <h1 class="header-pages-info-ttl">
                <?php if($cat_parent_name == 'エリア') : ?>
                  <i class="fas fa-map-marker-alt ico-gray-light"></i>&nbsp;
                <?php endif; ?>
                <?php echo $cat_name ?>
              </h1>
              <p class="header-pages-info-txt"><?php echo $cat_description ?></p>
            </div>
          </div>
        </div><!-- //.header-pages -->
        <div class="widget-main media-list">
          <h2 class="media-list-ttl">「<?php echo $cat_name ?>」に関する記事一覧</h2>
          <ul class="media-list-list list-unstyled">
            <?php if($cat_query->have_posts()) : while ($cat_query->have_posts()) : $cat_query->the_post(); ?>
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
                        <span class="media-body-meta-date"><?php the_modified_date("Y/m/d") ?></span>&nbsp;|&nbsp;<span class="media-body-meta-author"><?php the_author(); ?></span>
                      </p>
                    </div>
                  </div>
                </a>
              </li>
            <?php endwhile; endif; ?>
          </ul>
        <?php
        pc_pagination($cat_query->max_num_pages);
        sp_pagination($cat_query->max_num_pages);
        ?>
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
