<?php get_header(); ?>

<main>
  <div class="header-pankuzu d-none d-sm-block">
    <div class="container">
      <ul class="row list-unstyled d-flex flex-wrap align-items-center mb-0">
        <?php breadcrumb(); ?>
      </ul>
    </div><!-- //.container -->
  </div><!-- //.header-pankuzu -->
  <div class="container">
    <div class="row">
      <div class="main col-12 col-lg-8">
        <h1>404 Not Found</h1>
        <p class="mb-5">ページが見つかりません。</p>
        <div class="medias">
          <h2 class="media-list-ttl">新着の記事</h2>
          <ul class="medias-list list-unstyled">
            <?php
              $args = array(
                'post_type'=>'post',
                'posts_per_page' => 10
              );
              $q = new WP_Query($args);
            ?>
            <?php if($q->have_posts()) : while ($q->have_posts()) : $q->the_post(); ?>
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
          <?php pc_pagination(); ?>
          <?php sp_pagination(); ?>
        </div><!-- //.medias -->
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

<?php get_footer();
