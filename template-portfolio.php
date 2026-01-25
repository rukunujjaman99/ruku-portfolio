<?php 

// Template Name: Portfolio Page

get_header();

?>


              <!-- portfolio section start -->
              <section class="portfolio_section py-5 mt-3 mb-3">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="section_title  mb-4">
                      <h2>My Portfolio</h2>
                    </div>
                  </div>
                </div>
                <div class="row">

                            <?php
$projects = new WP_Query(array(
    'post_type'      => 'project',
    'posts_per_page' => -1,
    'order'          => 'ASC',
));

if ($projects->have_posts()) :
    while ($projects->have_posts()) : $projects->the_post();

        $project_link = get_post_meta(get_the_ID(), '_project_link', true); // get meta

        ?>
        <div class="col-md-4">
            <div class="portfolio_item mb-4 py-3">
                     <a href="<?php echo esc_url($project_link); ?>" target="_blank">
                            <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" class="img-fluid w-100 h-100">
                <?php endif; ?>
                     </a>

            

                <h4 class="mt-2"><?php the_title(); ?></h4>
                <p><?php the_excerpt(); ?></p>

                <?php if ($project_link) : ?>
                    <a href="<?php echo esc_url($project_link); ?>" target="_blank" class="btn-custom ms-auto">View Project</a>
                <?php endif; ?>

            </div>
        </div>
    <?php
    endwhile;
    wp_reset_postdata();
endif;
?>

               </div>
              </div>
            </section>
            <!-- portfolio section end -->

  <?php get_footer(); ?>

    <?php wp_footer(); ?>