<?php get_header(); ?>

<main>
  <div class="container-fluid">
    <div class="band row">
      <?php
      $band_post_ids;
      $band_args = array(
        'post_type'=>'post',
        'posts_per_page' => 3,
        'orderby' => 'rand'
      );
      $band_query = new WP_Query($band_args);
      ?>
      <?php if($band_query->have_posts()) : while ($band_query->have_posts()) : $band_query->the_post(); ?>
        <?php
        $counter++;
        $band_post_ids[] = get_the_ID();
        ?>
        <?php if($counter == 1) : ?>
          <div class="col-12 col-lg-4 p-0">
        <?php else : ?>
          <div class="col-6 col-lg-4 p-0">
        <?php endif; ?>
        <a href="<?php echo get_permalink(); ?>" class="band-catch" style="background-image: url(<?php the_post_thumbnail_url('large'); ?>)">
          <div class="band-catch-info">
            <p class="band-catch-info-ttl"><?php echo mb_strimwidth(get_the_title(), 0, 76, '...'); ?></p>
            <p class="band-catch-info-meta">
              <span class="band-catch-info-date"><?php the_modified_date("Y/m/j") ?></span>&nbsp;|&nbsp;<span class="band-catch-info-author"><?php the_author(); ?></span>
            </p>
          </div>
        </a>
      </div>
      <?php endwhile; endif; ?>
    </div><!-- //.band -->
  </div><!-- //.container-fluid -->
  <div class="container">
    <div class="row">
      <div class="main col-12 col-lg-8">
        <div class="medias">
          <h2 class="media-list-ttl">
            <i class="fas fa-hand-holding-heart ico-red"></i>&nbsp;編集部のおすすめ
          </h2>
          <ul class="medias-list list-unstyled">
            <?php
            $main_args = array(
              'post_type'=>'post',
              'posts_per_page' => 30,
              'post__not_in' => $band_post_ids,
              'paged' => $paged
            );
            $main_query = new WP_Query($main_args);
            ?>
            <?php if($main_query->have_posts()) : while ($main_query->have_posts()) : $main_query->the_post(); ?>
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
        pc_pagination($main_query->max_num_pages);
        sp_pagination($main_query->max_num_pages);
        ?>
        </div><!-- //.medias -->
      </div><!-- //.main -->
      <?php get_sidebar(); ?>
    </div><!-- //.row -->
  </div><!-- //.container -->
</main>

<?php get_footer(); ?>
