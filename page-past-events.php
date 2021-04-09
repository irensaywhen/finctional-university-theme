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
      get_template_part('partials/event_summary');
    } 
  
  echo paginate_links([
    'total' => $past_events->max_num_pages
  ]);
  ?>
</div>

<?php  get_footer(); ?>