<?php get_header(); ?>

<main>
    <section id="inicio" class="d-flex align-items-center" style="min-height: 90vh;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">
                        <?php echo get_theme_mod('hero_subtitle', 'Hola, soy'); ?>
                    </h3>

                    <h1 class="hero-name">
                        <span><?php echo get_theme_mod('hero_first_name', 'Matías'); ?></span>
                        <br> 
                        <span><?php echo get_theme_mod('hero_last_name', 'Sánchez'); ?></span>
                    </h1>

                    <div class="specialties-container mt-2 mb-3">
                        <?php 
                        for ($i = 1; $i <= 5; $i++) {
                            $specialty = get_theme_mod("hero_specialty_$i");
                            if (!empty($specialty)) {
                                echo '<span class="hero-specialty">' . esc_html($specialty) . '</span>';
                            }
                        }
                        ?>
                    </div>

                    <p class="hero-description">
                        <?php echo get_theme_mod('hero_description', 'Desarrollador enfocado en soluciones custom.'); ?>
                    </p>

                    <div class="social-media">
                        <?php 
                        $networks = array(
                            'facebook'  => 'fa-brands fa-facebook-f',
                            'instagram' => 'fa-brands fa-instagram',
                            'linkedin'  => 'fa-brands fa-linkedin-in',
                            'github'    => 'fa-brands fa-github',
                            'whatsapp'  => 'fa-brands fa-whatsapp'
                        );

                        foreach ($networks as $key => $icon) :
                            $url = get_theme_mod("hero_social_$key");
                            if (!empty($url)) : ?>
                                <a href="<?php echo esc_url($url); ?>" target="_blank"><i class="<?php echo $icon; ?>"></i></a>
                            <?php endif;
                        endforeach; ?>
                    </div>

                    <div>
                        <?php 
                        $cv_url = get_theme_mod('hero_cv_url');
                        if (!empty($cv_url)) : ?>
                            <a href="<?php echo esc_url($cv_url); ?>" class="btn-cv" target="_blank">
                                Descargar CV
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-lg-5 text-center">
                    <?php 
                    $hero_img = get_theme_mod('hero_image');
                    if ($hero_img) : ?>
                        <div class="img-box" style="width: 25rem; height: 25rem; border-radius: 50%; border: 2px solid var(--main-color); margin: 0 auto; padding: 1rem; box-shadow: 0 0 20px var(--main-color); overflow: hidden;">
                            <img src="<?php echo esc_url($hero_img); ?>" alt="Perfil" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    <?php else : ?>
                        <div class="img-box" style="width: 320px; height: 320px; border-radius: 50%; border: 4px solid var(--second-bg-color); margin: 0 auto; display: flex; align-items: center; justify-content: center; background: var(--second-bg-color);">
                            <span style="color: var(--main-color);">Sube una foto</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="sobre-mi" class="section-padding" style="background-color: var(--second-bg-color);">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-lg-6 mb-5 mb-lg-0 pr-lg-5">
                    <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem;">
                        Sobre <span style="color: var(--main-color);">Mí</span>
                    </h2>
                    
                    <p style="font-size: var(--tamano-cuerpo); margin-bottom: 1.5rem;">
                        <?php echo nl2br(get_theme_mod('about_text', 'Soy un desarrollador web...')); ?>
                    </p>
                    
                    <ul class="list-unstyled mt-4" style="font-size: var(--tamano-cuerpo);">
                        <?php 
                        for ($i = 1; $i <= 3; $i++) {
                            $label = get_theme_mod("about_label_$i");
                            $value = get_theme_mod("about_value_$i");
                            if (!empty($label) && !empty($value)) : ?>
                                <li class="mb-3">
                                    <strong style="color: var(--main-color); display: inline-block; width: 100px;">
                                        <?php echo esc_html($label); ?>
                                    </strong> 
                                    <?php echo esc_html($value); ?>
                                </li>
                            <?php endif;
                        } ?>
                    </ul>
                </div>

                <div class="col-lg-6">
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem; text-align: center;">
                        Stack <span style="color: var(--main-color);">Tecnológico</span>
                    </h3>
                    
                    <div class="d-flex flex-wrap gap-3 justify-content-center">
                        <?php
                        $stack_args = array(
                            'post_type'      => 'stack',
                            'posts_per_page' => -1,
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC'
                        );
                        $stack_query = new WP_Query($stack_args);

                        if ($stack_query->have_posts()) :
                            while ($stack_query->have_posts()) : $stack_query->the_post();
                                $title = get_the_title();
                                $excerpt = get_the_excerpt();
                                ?>
                                <div class="stack-circle" style="width: 6rem; height: 6rem; border-radius: 50%; border: 2px solid var(--main-color); display: flex; align-items: center; justify-content: center; color: var(--main-color); font-size: 1.5rem; box-shadow: 0 0 10px rgba(0, 238, 255, 0.2); overflow: hidden; background: var(--bg-color);" title="<?php echo esc_attr($title); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div style="width: 60%; height: 60%; display: flex; align-items: center; justify-content: center;">
                                            <?php the_post_thumbnail('full', array('style' => 'max-width: 100%; max-height: 100%; object-fit: contain;')); ?>
                                        </div>
                                    <?php elseif (!empty($excerpt)) : ?>
                                        <span style="font-weight: 700;"><?php echo esc_html($excerpt); ?></span>
                                    <?php else : ?>
                                        <span style="font-weight: 700; text-transform: uppercase;"><?php echo substr($title, 0, 1); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else: ?>
                            <p style="text-align:center; opacity:0.5;">Carga tus tecnologías desde el panel.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="proyectos" class="section-padding" style="background-color: var(--bg-color);">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 style="font-size: 2.5rem; font-weight: 700;">
                        Mis <span style="color: var(--main-color);">Proyectos</span>
                    </h2>
                    <p style="color: #ccc;">Casos de estudio y desarrollos a medida.</p>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <?php
                $args_proyectos = array(
                    'post_type'      => 'proyectos',
                    'posts_per_page' => -1, 
                );
                $query_proyectos = new WP_Query($args_proyectos);

                if ($query_proyectos->have_posts()) :
                    while ($query_proyectos->have_posts()) : $query_proyectos->the_post(); 
                        
                        $tech_string = get_post_meta(get_the_ID(), '_portfolio_tech', true);
                        $url_github  = get_post_meta(get_the_ID(), '_portfolio_github', true);
                        $url_demo    = get_post_meta(get_the_ID(), '_portfolio_demo', true);
                        $url_sitio   = get_post_meta(get_the_ID(), '_portfolio_sitio', true);
                        
                        $contenido_proyecto = get_the_content();
                        $tiene_caso_estudio = !empty(trim($contenido_proyecto));
                        ?>
                        
                        <div class="col-md-6 col-lg-4">
                            <div class="project-card">
                                
                                <div class="project-img-wrapper">
                                    <?php if (has_post_thumbnail()) : 
                                        the_post_thumbnail('large');
                                    else: ?>
                                        <div style="width: 100%; height: 100%; background: var(--bg-color); display: flex; align-items: center; justify-content: center; color: var(--main-color); border: 1px dashed var(--main-color);">Sin Imagen</div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="project-content">
                                    <h3 class="project-title"><?php the_title(); ?></h3>
                                    
                                    <div class="project-desc">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <?php 
                                        if (!empty($tech_string)) {
                                            $tecnologias = explode(',', $tech_string);
                                            foreach ($tecnologias as $tech) {
                                                echo '<span class="project-stack-pill">' . esc_html(trim($tech)) . '</span>';
                                            }
                                        }
                                        ?>
                                    </div>

                                    <div class="project-links mt-auto">
                                        <?php if ($tiene_caso_estudio) : ?>
                                            <a href="<?php the_permalink(); ?>" class="btn-project">Caso de Estudio</a>
                                        <?php endif; ?>

                                        <?php if (!empty($url_github)) : ?>
                                            <a href="<?php echo esc_url($url_github); ?>" target="_blank" class="btn-project" title="Ver Código">
                                                <i class="fa-brands fa-github"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (!empty($url_demo)) : ?>
                                            <a href="<?php echo esc_url($url_demo); ?>" target="_blank" class="btn-project">Demo</a>
                                        <?php endif; ?>

                                        <?php if (!empty($url_sitio)) : ?>
                                            <a href="<?php echo esc_url($url_sitio); ?>" target="_blank" class="btn-project">Sitio</a>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php endwhile; wp_reset_postdata();
                else : ?>
                    <div class="col-12 text-center">
                        <p style="color: var(--main-color); font-size: 1.2rem; margin-top: 2rem;">
                            Aún no hay proyectos cargados. Ve a tu panel de WordPress > Proyectos > Añadir Nuevo.
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>