<footer>
  <div class="footer-top">
    <div class="container d-none d-md-block">
      <div class="row">
        <div class="col-12 col-md-6">
          <dl class="widget-footer">
            <dt class="widget-footer-ttl">人気のタグ</dt>
            <dd>
              <ul class="list-unstyled d-flex flex-wrap align-items-center mb-0">
                <?php
                $posttag_args = array('number' => 10);
                $posttags = get_tags($posttag_args);
                if($posttags) :
                  foreach($posttags as $tag) :
                    echo '<li class="widget-footer-tag"><a class="tag" href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a></li>';
                  endforeach;
                endif;
                ?>
              </ul>
            </dd>
          </dl>
          <dl class="widget-footer mb-0">
            <dt class="widget-footer-ttl">エリア一覧</dt>
            <dd class="mb-0">
              <ul class="list-unstyled d-flex flex-wrap align-items-center mb-0">
                <?php
                $areas_id = get_cat_ID('エリア');
                $areas = get_terms("category", "child_of=".$areas_id, "number=6");
                foreach($areas as $area) : $cat_data = get_option('cat_'.intval($area->term_id));
                ?>
                  <li class="widget-footer-area">
                    <a href="<?php echo get_term_link($area); ?>">
                      <i class="fas fa-map-marker-alt ico-gray-light"></i>&nbsp;<?php echo esc_html($area->name) ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </dd>
          </dl>
        </div>
        <div class="col-12 col-md-6">
          <dl class="widget-footer mb-0">
            <dt class="widget-footer-ttl">Baht(バーツ)について</dt>
            <dd>
              <ul class="list-unstyled mb-0">
                <li class="widget-footer-about"><a href="/about.html">Baht(バーツ)運営者</a></li>
                <li class="widget-footer-about"><a href="/contact.html">お問い合わせ</a></li>
                <li class="widget-footer-about"><a href="/contact.html?type=ad">広告掲載について</a></li>
              </ul>
            </dd>
          </dl>
        </div>
      </div>
    </div><!-- //.container.d-none.d-md-block -->
    <div class="container-fluid d-md-none">
      <div class="row">
        <div class="footer-xs-menu col-12 text-center border-right-0">
          <?php get_currency_rate(); ?>
        </div>
        <div class="footer-xs-menu col-6">
          <a href="/"><i class="fas fa-home"></i>&nbsp;トップページ</a>
        </div>
        <div class="footer-xs-menu col-6 border-right-0">
          <a href="/about.html"><i class="fas fa-info-circle"></i>&nbsp;Bahtについて</a>
        </div>
        <div class="footer-xs-menu col-6">
          <a href="/tags/"><i class="fas fa-hashtag"></i>&nbsp;タグ一覧</a>
        </div>
        <div class="footer-xs-menu col-6 border-right-0">
          <a href="<?php echo get_term_link(get_cat_ID('エリア')); ?>"><i class="fas fa-map-marker-alt"></i>&nbsp;エリア一覧</a>
        </div>
        <div class="footer-xs-menu col-6">
          <a href="<?php echo get_term_link(get_cat_ID('特集')); ?>"><i class="far fa-newspaper"></i>&nbsp;特集一覧</a>
        </div>
        <div class="footer-xs-menu col-6 border-right-0">
          <a href="/contact.html"><i class="fas fa-at"></i>&nbsp;お問い合わせ</a>
        </div>
        <div class="footer-xs-menu col-12 d-flex justify-content-center align-items-center border-right-0">
          <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook fa-2x"></i></a>
          <a class="ml-5 mr-5" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-2x"></i></a>
          <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-2x"></i></a>
        </div>
        <div class="footer-xs-menu col-12 text-center border-right-0">
          <a href="#">
            <i class="fas fa-angle-up fa-lg d-block"></i>
            ページトップへ
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <div class="footer-bottom-left">
        <a href="/" class="footer-bottom-logo">
          <span class="logo-hover-red">B</span>aht
        </a>
        <span class="footer-bottom-copyright">Copyright&nbsp;&copy;&nbsp;<?php echo date('Y'); ?>&nbsp;Baht&nbsp;All&nbsp;Rights&nbsp;Reserved.</span>
      </div>
      <div class="footer-bottom-right d-none d-md-block">
        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook fa-lg ico-gray"></i></a>
        <a class="ml-3 mr-3" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-lg ico-gray"></i></a>
        <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-lg ico-gray"></i></a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
