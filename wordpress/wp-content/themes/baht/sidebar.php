<div class="sidebar col-12 col-lg-4">
  <div class="widget">
    <h3 class="widget-ttl">人気のお遊びタグ</h3>
    <ul class="list-unstyled d-flex flex-wrap align-items-center mb-0">
      <?php
      $posttag_args = array('number' => 15);
      $posttags = get_tags($posttag_args);
      if($posttags) :
        foreach($posttags as $tag) :
          echo '<li class="widget-tag"><a class="tag" href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a></li>';
        endforeach;
      endif;
      ?>
    </ul>
    <!-- <p class="text-right"><a class="widget-more" href="/tags/">タグ一覧&nbsp;&gt;</a></p> -->
  </div><!-- //.widget -->
  <div class="widget">
    <?php if (is_active_sidebar('sidebar_top_ads')) : ?>
      <?php dynamic_sidebar('sidebar_top_ads'); ?>
    <?php endif; ?>
  </div><!-- //.widget -->
  <div class="widget">
    <h3 class="widget-ttl">エリア一覧</h3>
    <ul class="list-unstyled d-flex flex-wrap align-items-center mb-0">
      <?php
      $areas_id = get_cat_ID('エリア');
      $areas = get_terms("category", "child_of=".$areas_id, "number=10");
      foreach($areas as $area) : $cat_data = get_option('cat_'.intval($area->term_id));
      ?>
        <li class="widget-list w-50 pr-2">
          <a class="d-flex align-items-center" href="<?php echo get_term_link($area); ?>">
            <div class="widget-list-catch flex-shrink-0">
              <img class="widget-list-img" src="<?php echo esc_html($cat_data['img']) ?>">
            </div>
            <p class="widget-list-txt"><?php echo esc_html($area->name) ?></p>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
    <!-- <p class="text-right"><a class="widget-more" href="<?php echo get_term_link($areas_id); ?>">エリア一覧&nbsp;&gt;</a></p> -->
  </div><!-- //.widget -->
  <?php
  $count = 0;
  // とりあえずランダムに設定しておく
  $popular_args = array(
    'post__not_in'   => array($post->ID),
    'orderby'        => 'rand',
    'posts_per_page' => 5
  );
  $popular_posts = new WP_Query($popular_args);
  if($popular_posts->have_posts()) : ?>
    <div class="widget">
      <h3 class="widget-ttl">人気ランキング</h3>
      <ul class="list-unstyled">
        <?php while($popular_posts->have_posts()) : $popular_posts->the_post(); $count++; ?>
          <li class="widget-list">
            <a class="d-flex align-items-center" href="<?php echo get_permalink(); ?>">
              <div class="widget-list-catch-ranking widget-list-catch-square flex-shrink-0" data-ranking="<?php echo $count ?>">
                <img class="widget-list-img" src="<?php the_post_thumbnail_url('thumbnail'); ?>">
              </div>
              <p class="widget-list-txt">
                <?php echo mb_strimwidth(get_the_title(), 0, 76, '...'); ?>
              </p>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
    </div><!-- //.widget -->
  <?php endif; wp_reset_postdata(); ?>
  <div class="widget">
    <?php if (is_active_sidebar('sidebar_bottom_ads')) : ?>
      <?php dynamic_sidebar('sidebar_bottom_ads'); ?>
    <?php endif; ?>
  </div><!-- //.widget -->
  <div class="widget">
    <h3 class="widget-ttl">新着特集</h3>
    <ul class="list-unstyled">
      <?php
      $features_id = get_cat_ID('特集');
      $features = get_terms("category", "child_of=".$features_id, "number=5");
      foreach($features as $feature) : $cat_data = get_option('cat_'.intval($feature->term_id));
      ?>
      <li class="widget-list">
        <a class="d-flex align-items-center" href="<?php echo get_term_link($feature); ?>">
          <div class="widget-list-catch-square flex-shrink-0">
            <img class="widget-list-img" src="<?php echo esc_html($cat_data['img']) ?>">
          </div>
          <p class="widget-list-txt">
            <?php echo esc_html($feature->name) ?>
          </p>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
    <p class="text-right"><a class="widget-more" href="<?php echo get_term_link($features_id); ?>">特集一覧&nbsp;&gt;</a></p>
  </div><!-- //.widget -->
</div><!-- //.sidebar -->
