<?php 

// Template Name: About Page

get_header();

?>


<div class="about_section py-3  mt-5">                  
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="about_content">
          <h2 class="text-white">About Me</h2>
          <p class="text-white">Hello! I'm Rukunujjaman, a passionate web developer with expertise in creating dynamic and responsive websites. With a strong foundation in HTML, CSS, JavaScript, Wordpress and PHP, I specialize in building user-friendly web applications that deliver exceptional user experiences. My goal is to transform ideas into reality through innovative web solutions.</p>
        </div>
          </div>
          <div class="col-md-6">
             <div class="about_image text-center">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/rukunujjaman-about.jpg" alt="About Image">
        </div>
          </div>  
        </div>
      </div>
      </div>

      <!-- experience section start -->
           <section class="experience_section py-5">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="section_title  mb-4">
                    <h2>My Experience</h2>
                  </div>
                </div>
              </div>
                  
              <div class="row">
<?php
$args = array(
    'post_type'      => 'experience', // Your CPT
    'posts_per_page' => -1,           // All posts
    'post_status'    => 'publish',
    'orderby'        => 'date',       // Optional: order by date
    'order'          => 'ASC',        // Optional: ascending order
);

$experience_query = new WP_Query($args);

if ($experience_query->have_posts()) :
    while ($experience_query->have_posts()) : $experience_query->the_post();

        // Get meta fields
        $job_title   = get_post_meta(get_the_ID(), 'job_title', true);
        $company     = get_post_meta(get_the_ID(), 'company', true);
        $duration    = get_post_meta(get_the_ID(), 'duration', true);
        $short_desc  = get_post_meta(get_the_ID(), 'short_description', true);
?>
        <div class="col-md-6">
            <div class="experience_item mb-4">
                <?php if ($job_title) : ?>
                    <h3><?php echo esc_html($job_title); ?></h3>
                <?php endif; ?>

                <?php if ($company || $duration) : ?>
                    <h4>
                        <?php echo esc_html($company); ?>
                        <?php if ($company && $duration) : ?> | <?php endif; ?>
                        <?php echo esc_html($duration); ?>
                    </h4>
                <?php endif; ?>

                <?php if ($short_desc) : ?>
                    <p><?php echo esc_html($short_desc); ?></p>
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
          <!-- training section start -->
           <section class="experience_section py-5">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="section_title  mb-4">
                    <h2>My Training</h2>
                  </div>
                </div>
              </div>
                  
              <div class="row">
<?php
$args = array(
    'post_type'      => 'training', // Your CPT
    'posts_per_page' => -1,           // All posts
    'post_status'    => 'publish',
    'orderby'        => 'date',       // Optional: order by date
    'order'          => 'ASC',        // Optional: ascending order
);

$training_query = new WP_Query($args);

if ($training_query->have_posts()) :
    while ($training_query->have_posts()) : $training_query->the_post();

        // Get meta fields
        $course_name   = get_post_meta(get_the_ID(), 'course_name', true);
        $institute     = get_post_meta(get_the_ID(), 'institute', true);
        $duration    = get_post_meta(get_the_ID(), 'duration', true);
        $short_desc  = get_post_meta(get_the_ID(), 'short_description', true);
?>
       <div class="col-md-6 d-flex">
    <div class="experience_item mb-4 w-100">
        <?php if ($course_name) : ?>
            <h3><?php echo esc_html($course_name); ?></h3>
        <?php endif; ?>

        <?php if ($institute || $duration) : ?>
            <h4>
                <?php echo esc_html($institute); ?>
                <?php if ($institute && $duration) : ?> | <?php endif; ?>
                <?php echo esc_html($duration); ?>
            </h4>
        <?php endif; ?>

        <?php if ($short_desc) : ?>
            <p><?php echo esc_html($short_desc); ?></p>
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

        <!-- training section end -->

  <?php get_footer(); ?>

    <?php wp_footer(); ?>