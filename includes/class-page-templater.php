<?php
/**
 * @package  Upload 2 Search
 */


class PageTemplater
{
  public $templates;

  public function register()
  {
    $this->templates = array(
      'page-templates/search-page-tpl.php' => 'Search Page Layout'
    );

    add_filter( 'theme_page_templates', array( $this, 'custom_template' ) );
    add_filter( 'template_include', array( $this, 'load_template' ) );
  }

  public function custom_template( $templates )
  {
    $templates = array_merge( $templates, $this->templates );

    return $templates;
  }

  public function load_template( $template )
  {
    global $post;

    if ( ! $post ) {
      return $template;
    }

    $template_name = get_post_meta( $post->ID, '_wp_page_template', true );

    if ( ! isset( $this->templates[$template_name] ) ) {
      return $template;
    }

    $file = plugin_dir_path( dirname(__FILE__) ) . $template_name;

    if ( file_exists( $file ) ) {
      return $file;
    }

    return $template;
  }
}
