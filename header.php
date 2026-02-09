<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <meta name="description" content="Rukunujjaman - A passionate web developer specializing in creating dynamic and responsive websites using HTML, CSS, JavaScript, WordPress, and PHP.">
    <meta name="keywords" content="Rukunujjaman, web developer, WordPress developer, front-end developer, back-end developer, full-stack developer, HTML, CSS, JavaScript, PHP, responsive web design, web applications">

  

    <?php wp_head(); ?>
</head>
<body>
    <header class="header_section">
   <nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand text-white" href="<?php echo esc_url(home_url('/')); ?>">
     <?php if(has_custom_logo()):?>
      <?php the_custom_logo(); ?>
      <?php else:?>
        <span class="default-logo">Ruku</span>
      <?php endif ;?>


    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <?php wp_nav_menu(array(
        'theme_location' => 'primary-menu',
        'orderby'        => 'menu_order',
       
    

      )); ?>
       
      </ul>
      <div class="cta_btn">
        <a href="#" class=" btn-custom-two">Let's Talk</a>
      </div>
   
    </div>
  </div>
</nav>
    </header>