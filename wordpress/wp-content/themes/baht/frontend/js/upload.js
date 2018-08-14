(function() {
  jQuery('#upload_image_button').click(function(e) {
    e.preventDefault();
    var formfield = jQuery('#upload_image').attr('name');
    tb_show('', 'media-upload.php?type=image&post_id=&TB_iframe=true');
  });

  window.send_to_editor = function(html) {
    var imgUrl = jQuery('img', html).attr('src');
    if (imgUrl === undefined) imgUrl = jQuery(html).attr('src');
    jQuery('#upload_image').val(imgUrl);
    tb_remove();
  };
})();
