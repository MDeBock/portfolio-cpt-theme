# 👨‍💻 Portafolio Personal - Custom WordPress Theme

Desarrollo desde cero de mi portafolio profesional utilizando WordPress como gestor de contenido (CMS). Este proyecto es un **tema 100% a medida**, diseñado para ser ultraligero, prescindir de constructores visuales pesados (bloatware) y demostrar control total sobre la arquitectura de datos y el renderizado del frontend.

## 🚀 El Desafío y la Solución
El objetivo era crear una plataforma que no solo mostrara mis proyectos, sino que el código fuente en sí mismo fuera una prueba de mis habilidades. 

**La Solución:** Se construyó una arquitectura basada en **Custom Post Types (CPT)** para aislar la lógica del contenido. El tema es completamente administrable desde el editor nativo de WordPress, permitiendo una gestión ágil del portafolio y de las tecnologías exhibidas sin sacrificar el rendimiento ni la semántica del código.

## 🛠️ Stack Tecnológico del Tema
* **Core:** WordPress (Custom Theme Development)
* **Backend:** PHP, Custom Post Types (CPT), Metadatos Customizados
* **Frontend:** HTML5, CSS3
* **UI Framework:** Bootstrap 5

## ✨ Características Principales

* **Arquitectura de Datos Modular:** Implementación de dos Custom Post Types (`Proyectos` y `Stacks`). Esto separa semánticamente los trabajos realizados del escaparate de habilidades técnicas, permitiendo actualizar la grilla de tecnologías dinámicamente desde el panel de control.
* **Renderizado UI Condicional (Smart Buttons):** Los botones de acción de cada tarjeta de proyecto (Repositorio, Demo, Caso de Estudio) evalúan la base de datos y solo se imprimen en el DOM si el enlace existe, evitando botones rotos.
* **Procesamiento de Cadenas a UI:** Lógica en PHP que toma *strings* ingresados en el backend (ej: "Python, Django, JavaScript") y los renderiza iterativamente como "pastillas" (pills) visuales de formato uniforme en las tarjetas de los proyectos.
* **Customización Nativa:** Soporte total para la edición desde el panel administrador de WordPress, brindando flexibilidad para actualizar el sitio sin tocar código.

## 📸 Galería del Proyecto

*(Nota: Aquí puedes poner la captura de los círculos de neón de tu stack y una de tus proyectos).*

## 💻 Snippet Destacado: Lógica de Metadatos y Renderizado Dinámico

Fragmento del archivo `single-proyectos.php` que demuestra el manejo de cadenas para las etiquetas tecnológicas y el renderizado condicional de la botonera de acciones:

```php
<div class="mt-3">
    <?php 
    // Procesamiento dinámico del Stack Tecnológico en pastillas
    $tech_string = get_post_meta(get_the_ID(), '_portfolio_tech', true);
    if (!empty($tech_string)) {
        $tecnologias = explode(',', $tech_string);
        foreach ($tecnologias as $tech) {
            echo '<span class="project-stack-pill" style="margin: 0 5px; font-size: 0.9rem;">' . esc_html(trim($tech)) . '</span>';
        }
    }
    ?>
</div>

<div class="mt-5 pt-4 d-flex flex-wrap gap-3 justify-content-center" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
    <a href="<?php echo esc_url(home_url('/')); ?>#proyectos" class="btn-cv">
        <i class="fa-solid fa-arrow-left"></i> Volver al Portfolio
    </a>
    
    <?php 
    $url_github = get_post_meta(get_the_ID(), '_portfolio_github', true);
    $url_demo   = get_post_meta(get_the_ID(), '_portfolio_demo', true);
    $url_sitio  = get_post_meta(get_the_ID(), '_portfolio_sitio', true);
    
    // Solo imprime el HTML del botón si el metadato no está vacío
    if (!empty($url_github)) echo '<a href="'.esc_url($url_github).'" target="_blank" class="btn-cv"><i class="fa-brands fa-github"></i> Repositorio</a>';
    if (!empty($url_demo))   echo '<a href="'.esc_url($url_demo).'" target="_blank" class="btn-cv">Ver Demo</a>';
    if (!empty($url_sitio))  echo '<a href="'.esc_url($url_sitio).'" target="_blank" class="btn-cv">Visitar Sitio</a>';
    ?>
</div>
```