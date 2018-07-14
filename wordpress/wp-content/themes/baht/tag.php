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
  $current_tag_id = $wp_query->query_vars['tag_id'];
  $tag_args = array(
    'post_type'=>'post',
    'posts_per_page' => 30,
    'tag_id' => $current_tag_id,
    'paged' => $paged
  );
  $tag_query = new WP_Query($tag_args);
  $tag_array = get_posts($tag_args)[0];
  ?>
  <div class="header-pages-catch d-sm-none">
    <img src="<?php echo get_the_post_thumbnail_url($tag_array->ID, 'large');?>">
  </div>
  <div class="container">
    <div class="row">
      <div class="main col-12 col-lg-8">
        <div class="header-pages">
          <div class="d-flex">
            <div class="header-pages-catch d-none d-sm-block flex-shrink-0">
              <img src="<?php echo get_the_post_thumbnail_url($tag_array->ID, 'medium');?>">
            </div>
            <div class="header-pages-info">
              <h1 class="header-pages-info-ttl">
                <i class="fas fa-hashtag"></i>&nbsp;<?php single_tag_title(); ?>
              </h1>
              <p class="header-pages-info-txt"><?php single_tag_title(); ?>に関する記事一覧です。</p>
            </div>
          </div>
        </div><!-- //.header-pages -->
        <div class="widget-main media-list">
          <h2 class="media-list-ttl">「<?php single_tag_title(); ?>」に関する記事一覧</h2>
          <ul class="media-list-list list-unstyled">
            <?php if($tag_query->have_posts()) : while ($tag_query->have_posts()) : $tag_query->the_post(); ?>
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
            <?php endwhile; endif; ?>
          </ul>
        <?php
        pc_pagination($tag_query->max_num_pages);
        sp_pagination($tag_query->max_num_pages);
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
