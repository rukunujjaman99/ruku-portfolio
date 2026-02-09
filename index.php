<?php
// Template Name: Home Page

get_header(); ?>

    <main>
      <section class="about_section py-5  mt-2">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
             <div class="about_content">
               <h1><?php echo get_theme_mod('ruku_about_name'); ?></h1>
    <h2><?php echo get_theme_mod('ruku_about_title'); ?></h2>
    <p><?php echo get_theme_mod('ruku_about_desc'); ?></p>
    <a href="<?php echo get_theme_mod('ruku_about_cv'); ?>" target="_blank" class="btn-custom">Download CV</a>
    <a href="<?php echo get_theme_mod('ruku_about_link'); ?>" class="mx-2 btn-custom-two">Learn More</a>
    <div class="social py-3 mx-2">
        <h4 class="py-3">Find with me</h4>
        <div class="social_links">
            <a href="<?php echo get_theme_mod('ruku_about_facebook'); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="<?php echo get_theme_mod('ruku_about_linkedin'); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            <a href="<?php echo get_theme_mod('ruku_about_github'); ?>" target="_blank"><i class="fab fa-github"></i></a>
          </div>
        </div>
          </div>
          </div>
          <div class="col-md-6">
             <div class="about_image text-center">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/rukunujjaman-about.jpg" alt="About Image">
        </div>
          </div>
          
        </div>
      </div>

      </section>
       
       <!-- skill section start -->
        <section class="skill_section py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="section_title  mb-4">
                  <h2>My Skills</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="skill">
               <div class="skill-title">
               <span>HTML</span>
               <span>95%</span>
               </div>
               <div class="progress-bar">
               <div class="progress html"></div>
               </div>
               </div>
              </div>
               <div class="col-md-2">
                <div class="skill">
               <div class="skill-title">
               <span>CSS</span>
               <span>92%</span>
               </div>
               <div class="progress-bar">
               <div class="progress css"></div>
               </div>
               </div>
              </div>
         
                <div class="col-md-2">
                 <div class="skill">
                <div class="skill-title">
                <span>JavaScript</span>
                <span>85%</span>
                </div>
                <div class="progress-bar">
                <div class="progress js"></div>
                </div>
                </div>
                </div>
                 <div class="col-md-2">
                  <div class="skill">
                 <div class="skill-title">
                  <span>PHP</span>
                  <span>70%</span>
                 </div>
                  <div class="progress-bar">
                  <div class="progress php"></div>
                  </div>
                 </div>
              </div>
            </div>
          </div>

        </section>
        <!-- skill section end -->
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
          <!-- experience section end -->
           <!-- education section start -->
            <section class="education_section py-5">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="section_title  mb-4">
                      <h2>My Education</h2>
                    </div>
                  </div>
                </div>
                <div class="row">
                          <?php
$args = array(
    'post_type'      => 'education',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
);

$education_query = new WP_Query($args);

if ($education_query->have_posts()) :
    while ($education_query->have_posts()) : $education_query->the_post();

        $educations = get_post_meta(get_the_ID(), 'education_repeater', true);

        if (!empty($educations) && is_array($educations)) :
            foreach ($educations as $edu) :
?>
                <div class="col-md-6">
                    <div class="education_item mb-4">
                        <h3><?php echo esc_html($edu['degree']); ?></h3>

                        <h4>
                            <?php echo esc_html($edu['university']); ?>
                            <?php if (!empty($edu['academic_year'])) : ?>
                                | <?php echo esc_html($edu['academic_year']); ?>
                            <?php endif; ?>
                        </h4>

                        <p><?php echo esc_html($edu['short_description']); ?></p>
                    </div>
                </div>
<?php
            endforeach;
        endif;

    endwhile;
    wp_reset_postdata();
endif;
?>
 
                 
                  
                </div>
              </div>
            </section>

            <!-- education section end -->
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
    'posts_per_page' => 3,
    'order'          => 'ASC',
));

if ($projects->have_posts()) :
    while ($projects->have_posts()) : $projects->the_post();

        $project_link = get_post_meta(get_the_ID(), '_project_link', true); // get meta

        ?>
       <div class="col-md-4">
    <div class="portfolio_item mb-4 py-3">

        <!-- Trigger Modal -->
        <a href="#" data-bs-toggle="modal" data-bs-target="#projectModal-<?php the_ID(); ?>">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" 
                     alt="<?php the_title(); ?>" 
                     class="img-fluid w-100 h-100">
            <?php endif; ?>
        </a>

        <h4 class="mt-2">
            <a href="#" class="text-decoration-none"  data-bs-toggle="modal" data-bs-target="#projectModal-<?php the_ID(); ?>">
            
                <h4 class="text-decoration-none"><?php the_title(); ?></h4>
            </a>
        </h4>

        <p><?php the_excerpt(); ?></p>

        <button class="btn-custom"
                data-bs-toggle="modal"
                data-bs-target="#projectModal-<?php the_ID(); ?>">
            View Details
        </button>
    </div>
</div>
<div class="modal fade  bg-dark" id="projectModal-<?php the_ID(); ?>" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content  text-white">

            <div class="modal-header">
                <h5 class="modal-title"><?php the_title(); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php the_post_thumbnail_url('full'); ?>" class="img-fluid mb-3">
                <?php endif; ?>

                <?php the_content(); ?>

                <?php if ($project_link) : ?>
                    <a href="<?php echo esc_url($project_link); ?>" 
                       target="_blank" 
                       class=" btn-custom mt-3">
                        Visit Project
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

      
    <?php
    endwhile;
    wp_reset_postdata();
endif;
?>

              </div>
              <div class="text-center mt-4">
                <a href="<?php echo home_url('/portfolio'); ?>" class="btn-custom-two">View All Projects</a>
              </div>
            </section>
              <!-- portfolio section end -->
               <!-- blog section start -->
    <section class="blog_section py-5 mt-3 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section_title mb-4">
                        <h2>Latest Blog Posts</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <?php
                $blog_posts = new WP_Query(array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'order'          => 'DESC',
                ));

                if ($blog_posts->have_posts()) :
                    while ($blog_posts->have_posts()) : $blog_posts->the_post();
                        ?>
                        <div class="col-md-4">
                            <div class="blog_item mb-4 py-3">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" class="img-fluid w-100 h-100">
                                <?php endif; ?>
                                <h4 class="mt-2"><a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a></h4>
                                <p><?php echo wp_trim_words(get_the_content(), 20); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn-custom ms-auto">Read More</a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>

            </div>
            <div class="text-center mt-4">
                <a href="<?php echo home_url('/blog'); ?>" class="btn-custom-two">View All Blog Posts</a>
            </div>
        </div>
    </section>
    <!-- blog section end -->
     <!-- contact section start -->
    <section class="contact_section py-5 mt-3 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section_title mb-4">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="contat_info">
                        <h4><?php echo get_theme_mod('ruku_contact_heading'); ?></h4>
                              <p><?php echo get_theme_mod('ruku_contact_desc'); ?></p>
                         <ul class="list-unstyled">
        <li>
            <i class="fas fa-phone-alt"></i> 
            <a href="tel:<?php echo get_theme_mod('ruku_contact_phone'); ?>"> Phone: <?php echo get_theme_mod('ruku_contact_phone'); ?></a>
        </li>
        <li>
            <i class="fas fa-envelope"></i> 
            <a href="mailto:<?php echo get_theme_mod('ruku_contact_email'); ?>"> Email: <?php echo get_theme_mod('ruku_contact_email'); ?></a>
        </li>
        <li>
            <i class="fas fa-map-marker-alt"></i> 
            <span>Location: <?php echo get_theme_mod('ruku_contact_location'); ?></span>
        </li>
    </ul>

                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="contact_form">
                        <h4>Send a Message</h4>
                        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                            <input type="hidden" name="action" value="submit_contact_form">
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn-custom">Send Message</button>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    <!-- contact section end -->

    </main>


      <?php get_footer(); ?>

    <?php wp_footer(); ?>
</body>
</html>