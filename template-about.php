<?php 

// Template Name: About Page

get_header();

?>


<div class="about_section py-3 bg-light mt-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="about_content">
          <h2 class="text-dark">About Me</h2>
          <p class="text-dark">Hello! I'm Rukunujjaman, a passionate web developer with expertise in creating dynamic and responsive websites. With a strong foundation in HTML, CSS, JavaScript, Wordpress and PHP, I specialize in building user-friendly web applications that deliver exceptional user experiences. My goal is to transform ideas into reality through innovative web solutions.</p>
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


  <?php get_footer(); ?>

    <?php wp_footer(); ?>