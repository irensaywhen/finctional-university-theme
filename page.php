<?php
  get_header();

  while(have_posts()) {
    the_post(); 
    page_banner();
    ?>

    <div class="container container--narrow page-section">

    <?php
      $pagent_id = wp_get_post_parent_id(get_the_ID());

      if($pagent_id){ 
    ?>
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a 
            class="metabox__blog-home-link" 
            href="<?php echo get_permalink($pagent_id); ?>"
          ><i class="fa fa-home" aria-hidden="true"></i> 
            Back to <?php echo get_the_title($pagent_id); ?>
          </a>
          <span class="metabox__main"><?php the_title(); ?></span>
        </p>
      </div>
    <?php  }?>
    
    <?php 
       // $pages = get_pages([
       //   'child_of' => get_the_ID()
       // ]);



      // $pages = get_pages(array(
      //   "child_of" => get_the_ID()
      // ))

      //if ($pagent_id || $pages ) { ?>
      <div class="page-links">
        <h2 class="page-links__title">
          <a href="<?php echo get_permalink($pagent_id); ?>">
            <?php echo get_the_title($pagent_id); ?>
          </a>
        </h2>
        <ul class="min-list">
          <?php
            if($pagent_id){
              $child_of_id = $pagent_id;
            } else {
              $child_of_id = get_the_ID();
            }

            wp_list_pages([
              'title_li' => NULL,
              'child_of' =>  $child_of_id,
              'sort_column' => 'menu_order'
            ]);
          ?>
        </ul>
      </div>
      <?php //} ?>

      <div class="generic-csontent">
        <?php the_content(); ?>
      </div>
    </div>
  <?php }

  get_footer();
?>