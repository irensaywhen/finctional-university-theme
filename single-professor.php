<?php
  get_header();

  while(have_posts()) {
    the_post(); 
    
    $page_banner_image = get_field('page_banner_background_image');
    ?>

    <div class="page-banner">
      <div
        class="page-banner__bg-image"
        style="background-image: url(<?php echo $page_banner_image['sizes']['pageBanner']; ?>"
      ></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
          <p><?php the_field('page_banner_subtitle'); ?></p>
        </div>
      </div>
    </div>

    <div class="container container--narrow page-section">

      <div class="generic-content">
        <div class="row group">
          <div class="one-third">
            <?php the_post_thumbnail('professorPortrait'); ?>
          </div>
          <div class="two-thirds">
            <?php the_content(); ?>
          </div>
        </div>
      </div>

      <?php 
        $related_programs = get_field('related_programs'); 

        if($related_programs) {
      ?> 

        <h2 class="headline headline--medium">
          Subject(s) taught
        </h2>
        <hr class="section-break">
        <ul class="link-list min-list">
        <?php 


          foreach($related_programs as $program) { ?>
            <li>
              <a 
                href="<?php echo get_the_permalink($program); ?>"
              >
              <?php echo get_the_title($program); ?>
              </a>
            </li>
          
        <?php } ?>
          </ul>
        <?php } ?>
    </div>
  <?php }

  get_footer();
?>