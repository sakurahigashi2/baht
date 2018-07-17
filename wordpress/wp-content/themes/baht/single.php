<?php get_header(); ?>

<main>
  <div class="header-pankuzu d-none d-sm-block">
    <div class="container">
      <ul class="row list-unstyled d-flex flex-wrap align-items-center mb-0">
        <?php breadcrumb(); ?>
      </ul>
    </div><!-- //.container -->
  </div><!-- //.header-pankuzu -->
  <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    <div class="container">
      <div class="row">
        <div class="article-catch article-img d-sm-none">
          <img src="<?php the_post_thumbnail_url('large'); ?>">
          <p class="article-img-source pl-2">
            <?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
          </p>
        </div>
        <div class="main col-12 col-lg-8">
          <div class="article">
            <h1 class="article-ttl"><?php echo get_the_title(); ?></h1>
            <div class="article-author d-flex align-items-center">
              <div class="d-flex align-items-center" href="#">
                <div class="article-author-catch mr-3">
                  <?php echo get_avatar(get_the_author_meta('ID'), 35); ?>
                </div>
                <div class="article-author-name mr-4"><?php the_author(); ?></div>
              </div>
              <div class="article-author-update">更新日：<?php the_modified_date("Y/m/j") ?></div>
            </div><!-- //.article-author -->
            <div class="article-catch article-img d-none d-sm-block">
              <img src="<?php the_post_thumbnail_url('large'); ?>">
              <p class="article-img-source">
                <?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
              </p>
            </div>
            <?php the_content(); ?>
          </div><!-- //.article -->
          <div class="main-ad d-md-flex justify-content-between">
            <div class="ad-img">
              <?php if (is_active_sidebar('article_bottom_ads')) : ?>
                <?php dynamic_sidebar('article_bottom_ads'); ?>
              <?php endif; ?>
            </div>
            <div class="ad-img">
              <?php if (is_active_sidebar('article_bottom_ads')) : ?>
                <?php dynamic_sidebar('article_bottom_ads'); ?>
              <?php endif; ?>
            </div>
          </div><!-- //.main-ad -->
          <div class="widget-main">
            <h2 class="media-list-ttl">この記事に関連するタグ</h2>
            <ul class="list-unstyled d-flex flex-wrap align-items-center mb-0 mt-4">
              <?php
              $current_tags = get_the_tags();
              if ($current_tags) :
                foreach($current_tags as $tag) :
                  echo '<li class="widget-tag"><a class="tag" href="'. get_tag_link($tag->term_id) .'">'. $tag->name .'</a></li>';
                endforeach;
              endif;
              ?>
            </ul>
          </div>
          <?php
          if ($current_tags) :
            foreach ( $current_tags as $tag ) {
              $current_tag_list[] = $tag->term_id;
            }
            $relative_args = array(
              'tag__in'        => $current_tag_list,
              'post__not_in'   => array($post->ID),
              'posts_per_page' => 5
            );
            $related_posts = new WP_Query($relative_args);
            if($related_posts->have_posts()) : ?>
              <div class="widget-main media-list">
                <h2 class="media-list-ttl">関連する記事</h2>
                <ul class="media-list-list list-unstyled">
                  <?php while($related_posts->have_posts()) : $related_posts->the_post(); ?>
                    <li class="media">
                      <a class="media-anchor d-flex" href="<?php echo get_permalink(); ?>">
                        <div class="media-catch">
                          <img src="<?php the_post_thumbnail_url('medium'); ?>">
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
                  <?php endwhile; ?>
                </ul>
              </div>
            <?php endif; wp_reset_postdata(); ?>
          <?php endif; ?>
          <?php
          $new_args = array(
            'post__not_in'   => array($post->ID),
            'posts_per_page' => 5
          );
          $new_posts = new WP_Query($new_args);
          if($new_posts->have_posts()) : ?>
            <div class="widget-main media-list">
              <h2 class="media-list-ttl">新着の記事</h2>
              <ul class="media-list-list list-unstyled">
                <?php while($new_posts->have_posts()) :$new_posts->the_post(); ?>
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
                <?php endwhile; ?>
              </ul>
            </div>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
        </div><!-- //.main -->
        <?php get_sidebar(); ?>
      </div><!-- //.row -->
    </div><!-- //.container -->
  <?php endwhile; endif; ?>
  <div class="footer-pankuzu d-none d-sm-block">
    <div class="container">
      <ul class="row list-unstyled d-flex flex-wrap align-items-center mb-0">
        <?php breadcrumb(); ?>
      </ul>
    </div><!-- //.container -->
  </div><!-- //.footer-pankuzu -->
</main>

<?php get_footer(); ?>
