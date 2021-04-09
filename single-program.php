<?php
  get_header();

  while(have_posts()) {
    the_post(); 
    page_banner();
    ?>

    <div class="container container--narrow page-section">
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a 
            class="metabox__blog-home-link" 
            href="<?php echo get_post_type_archive_link('program'); ?>"
          >
            All programs
          </a>
          <span class="metabox__main">
            <?php the_title(); ?>
          </span>
        </p>
      </div>

      <div class="generic-content">
        <?php the_content(); ?>
      </div>

      <?php
        $related_professors = new WP_Query([
         'posts_per_page' => -1,
         'post_type' => 'professor',
         'orderby' => 'title',
         'order' => 'ASC',
         'meta_query' => [
           [
             'key' => 'related_programs',
             'compare' => 'LIKE',
             'value' => '"'.get_the_ID().'"'
           ]
         ]
        ]);
            
        if($related_professors->have_posts()) {
          echo '<hr class="section-break"/>';
          echo '<h2>Professors:</h2>';
          echo '<ul class="professor-cards"';
          while($related_professors->have_posts()) {
            $related_professors->the_post(); ?>

            <li class="professor-card__list-item">
              <a 
                class="professor-card" 
                href="<?php the_permalink(); ?>"
              >
                <img 
                  src="<?php the_post_thumbnail_url('professorLandscape'); ?>" 
                  alt="" 
                  class="professor-card__image"
                />
                <span class="professor-card__name">
                  <?php the_title(); ?>
                </span>
              </a>
            </li>
          
          <?php  }
            echo "</ul>";
            wp_reset_postdata();
            }
          ?>

      <?php
            $today = date('Ymd');

             $homepage_events = new WP_Query([
              'posts_per_page' => 2,
              'post_type' => 'event',
              'orderby' => 'meta_value_num',
              'meta_key' => 'event_date',
              'order' => 'ASC',
              'meta_query' => [
                [
                  'key' => 'event_date',
                  'compare' => '>=',
                  'value' => $today,
                  'type' => 'numeric'
                ],
                [
                  'key' => 'related_programs',
                  'compare' => 'LIKE',
                  'value' => '"'.get_the_ID().'"'
                ]
              ]
            ]);
            
            if($homepage_events->have_posts()) {
              echo '<hr class="section-break"/>';
              echo '<h2>Upcoming events: ' . get_the_title() . '</h2>';

              while($homepage_events->have_posts()) {
                $homepage_events->the_post();
                get_template_part('partials/event_summary');
              }
            wp_reset_postdata();
            }
          ?>
    </div>
  <?php }

  get_footer();
?>