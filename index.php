<?php get_header(); ?>

    <main>
      <section class="about_section py-5  mt-2">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
             <div class="about_content">
          <h1>I am Rukunujjaman</h1>
          <h2>Web Developer</h2>
          <p>I bring 2 years of experience in Web design & WordPress Developemnt. I consistently demonstrated excellent communication skills, problem-solving abilities, and a customer-centric approach. Throughout my career, I have gained valuable insights into customer behavior and have developed strategies to effectively address their needs, resulting in increased customer satisfaction and retention rates.</p>
          <a href="#" class=" btn-custom">My Resume</a>
          <a href="" class="mx-2 btn-custom">Learn More</a>
          
         
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
                <div class="col-md-6">
                  <div class="experience_item mb-4">
                    <h3>Wordpress Developer</h3>
                    <h4>ABC Company | 2025 - Present</h4>
                    <p>Developed and maintained company website using WordPress and custom themes. Collaborated with design team to implement responsive designs.</p>
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="experience_item mb-4">
                    <h3>Wordpress Developer</h3>
                    <h4>XYZ Agency | 2023 - 2025</h4>
                    <p>Worked on various client projects, creating interactive and user-friendly web interfaces. Utilized HTML, CSS, and JavaScript to enhance user experience.</p>
                  </div>
                </div>
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
                  <div class="col-md-6">
                    <div class="education_item mb-4">
                      <h3>Bachelor of Science in Computer Science Engineering</h3>
                      <h4> Canadian University of Bangladesh | 2023 - 2026</h4>
                      <p>Graduated with Honors, focusing on web development, database management, and software engineering principles.</p>
                    </div>
                  </div>
                   <div class="col-md-6">
                    <div class="education_item mb-4">
                      <h3>Diploma in Computer Science</h3>
                      <h4>Bogura Polytechnic Institute | 2016 - 2020</h4>
                       <p>Completed the diploma program with a strong foundation in programming, database management, and computer systems.</p>
                    </div>
                  </div>
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
                  <div class="col-md-4">
                    <div class="portfolio_item mb-4">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Thaimedicss.png" alt="Portfolio Image" class="img-fluid w-100 h-100">
                      <h4 class="mt-2">Thaimedics</h4>
                      <p>Brief description of the project highlighting key features and technologies used.</p>
                    </div>
                  </div>
                   <div class="col-md-4">
                    <div class="portfolio_item mb-4">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Bangkok.png" alt="Portfolio Image" class="img-fluid w-100 h-100">
                      <h4 class="mt-2">Bangkok Air Ambulance </h4>
                      <p>Brief description of the project highlighting key features and technologies used.</p>
                    </div>
                  </div>
                   <div class="col-md-4">
                    <div class="portfolio_item mb-4">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Elitevisa.png" alt="Portfolio Image" class="img-fluid w-100 h-100">
                      <h4 class="mt-2">Thailand Elite Visa</h4>
                      <p>Brief description of the project highlighting key features and technologies used.</p>
                    </div>
                  </div>
                </div>
              </div>
            </section>
              <!-- portfolio section end -->

    </main>


    <?php get_footer(); ?>

    <?php wp_footer(); ?>
</body>
</html>