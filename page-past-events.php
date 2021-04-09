<?php 

get_header(); 
page_banner([
  'title' => 'Past events',
  'subtitle' => 'A recap of our past events'
]);
?>

<div class="container container--narrow page-section">
  <?php
    $today = date('Ymd');
    $past_events = new WP_Query([
      'paged' => get_query_var('paged', 1),
      'post_type' => 'event',
      'orderby' => 'meta_value_num',
      'meta_key' => 'event_date',
      'order' => 'ASC',
      'meta_query' => [
        [
          'key' => 'event_date',
          'compare' => '<',
          'value' => $today,
          'type' => 'numeric'
        ]
      ]
    ]);

    while($past_events->have_posts()) {
      $past_events->the_post(); 
  ?>

      <div class="event-summary">
        <a 
          class="event-summary__date t-center" 
          href="<?php the_permalink(); ?>"
        >
          <span class="event-summary__month">
            <?php 
              $event_date = new DateTime(get_field('event_date'));
              echo $event_date->format('M');
            ?>
          </span>
          <span class="event-summary__day">
            <?php 
              echo $event_date->format('d');
            ?>
          </span>
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny">
            <a 
              href="<?php the_permalink(); ?>"
            >
              <?php the_title(); ?>
            </a>
          </h5>
          <p>
            <?php echo wp_trim_words(get_the_content(), 18); ?>
            <a 
              href="<?php the_permalink(); ?>" 
              class="nu gray"
            >
              Learn more
            </a>
          </p>
        </div>
      </div>
  <?php  } 
  
  echo paginate_links([
    'total' => $past_events->max_num_pages
  ]);
  ?>
</div>

<?php  get_footer(); ?>