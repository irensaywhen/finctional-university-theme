<?php 
get_header(); 
page_banner([
  'title' => 'All events',
  'subtitle' => 'Discover our events'
]);

?>

<div class="container container--narrow page-section">
  <?php
    while(have_posts()) {
      the_post();
      get_template_part('partials/event_summary');
    } 
  
  echo paginate_links();
  ?>

  <hr class="section-break" />
  <p>
    Looking for a recap of our past events?
    <a href="<?php echo site_url('/past-events'); ?>">Check it out!</a>
  </p>
</div>

<?php  get_footer(); ?>