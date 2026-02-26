<?php get_header(); ?>

<main style="background-color: var(--bg-color); min-height: 80vh; padding-top: 120px; padding-bottom: 80px;">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article>
                
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h1 style="font-size: 3rem; font-weight: 700; color: var(--text-color); margin-bottom: 1rem;">
                            <?php the_title(); ?>
                        </h1>
                        <div class="mt-3">
                            <?php 
                            // Traemos las tecnologías para mostrarlas bajo el título
                            $tech_string = get_post_meta(get_the_ID(), '_portfolio_tech', true);
                            if (!empty($tech_string)) {
                                $tecnologias = explode(',', $tech_string);
                                foreach ($tecnologias as $tech) {
                                    echo '<span class="project-stack-pill" style="margin: 0 5px; font-size: 0.9rem;">' . esc_html(trim($tech)) . '</span>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="caso-estudio-content" style="color: var(--text-color); font-size: 1.05rem; line-height: 1.8;">
                            <?php the_content(); ?>
                        </div>

                        <div class="mt-5 pt-4 d-flex flex-wrap gap-3 justify-content-center" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                            <a href="<?php echo esc_url(home_url('/')); ?>#proyectos" class="btn-cv">
                                <i class="fa-solid fa-arrow-left"></i> Volver al Portfolio
                            </a>
                            
                            <?php 
                            $url_github = get_post_meta(get_the_ID(), '_portfolio_github', true);
                            $url_demo   = get_post_meta(get_the_ID(), '_portfolio_demo', true);
                            $url_sitio  = get_post_meta(get_the_ID(), '_portfolio_sitio', true);
                            
                            if (!empty($url_github)) echo '<a href="'.esc_url($url_github).'" target="_blank" class="btn-cv"><i class="fa-brands fa-github"></i> Repositorio</a>';
                            if (!empty($url_demo)) echo '<a href="'.esc_url($url_demo).'" target="_blank" class="btn-cv">Ver Demo</a>';
                            if (!empty($url_sitio)) echo '<a href="'.esc_url($url_sitio).'" target="_blank" class="btn-cv">Visitar Sitio</a>';
                            ?>
                        </div>
                    </div>
                </div>

            </article>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>