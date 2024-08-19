<?php

// Extend Twig with custom functions and filters
add_filter('timber/twig', 'extend_twig');
function extend_twig($twig)
{
    // Filters
    $twig->addFilter(new Twig\TwigFilter('span', 'span_filter'));

    // Functions
    $twig->addFunction(new Twig\TwigFunction('option', 'option'));
    $twig->addFunction(new Twig\TwigFunction('asset', 'asset'));
    $twig->addFunction(new Twig\TwigFunction('get_page_class', 'get_page_class'));
    $twig->addFunction(new Twig\TwigFunction('is_active', 'is_active'));

    return $twig;
}

/**
 * Convert <<text>> to <span>text</span>
 *
 * @param string $text
 * @return string
 */
function span_filter(string $text)
{
    $text = htmlspecialchars_decode($text);
    return str_replace(array('<<', '>>'), array('<span>', '</span>'), $text);
}

/**
 * Return the slug or post type of the current page
 *
 * @return string
 */
function get_page_class()
{
    if (is_singular('post') || is_home()) {
        return 'post';
    }

    if (is_archive() || is_single()) {
        global $wp_query;
        $post_type = $wp_query->query['post_type'];
        $post_type_data = get_post_type_object($post_type);
        return $post_type_data->rewrite['slug'];
    }

    if (is_page()) {
        return get_post()->slug;
    }
}

/**
 * Check if a page is active
 *
 * @param string|array $page
 * @param string $return
 * @return string
 */
function is_active($page, $return = '_active')
{
    $slug = get_page_class();

    if (is_array($page)) {
        foreach ($page as $p) {
            if ($slug === $p) {
                return $return;
            }
        }
    }

    if ($slug === $page) {
        return $return;
    }
}

/**
 * Return the asset url and prevent caching
 *
 * @param string $filename
 * @return string
 */
function asset(string $filename)
{
    $filename = trim($filename, '/');
    $path = get_template_directory() . "/assets/$filename";

    if (! file_exists($path)) {
        return '';
    }

    $timestamp = date('dmYHis', filemtime($path));
    return get_template_directory_uri() . "/assets/$filename?v=$timestamp";
}

/**
 * Require all PHP files in the given directory.
 *
 * @param string $dir
 * @return void
 */
function require_dir(string $dir)
{
    if (!is_dir($dir)) {
        return;
    }

    foreach (glob("$dir/*.php") as $file) {
        require_once $file;
    }
}
