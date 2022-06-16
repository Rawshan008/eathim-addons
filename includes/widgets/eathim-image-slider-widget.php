<?php
/**
 * Eathim Image Slider
 */
  class Eathim_Image_Slider_Widget extends \Elementor\Widget_Base{

    // Get widget name.
    public function get_name() {
      return 'eathim-text-widgets';
    }

    // Get widget title.
    public function get_title() {
      return esc_html__( 'Text Widgets', 'eathim' );
    }

    // Get widget icon.
    public function get_icon() {
      return 'eicon-bullet-list';
    }

    // Get custom help URL.
    public function get_custom_help_url() {
      return '';
    }

    // Scripts Styles
    public function get_style_depends() {
      return [];
    }

    // Scripts Depends
    public function get_script_depends() {
      return ['eathim-image-slider'];
    }

    // Widgets Category
    public function get_categories() {
      return [ 'general' ];
    }

    public function get_keywords() {
      return [ 'list', 'lists', 'ordered', 'unordered' ];
    }



    public function render() {
      $settings = $this->get_settings_for_display();
      ?>
      <div class="ra-slider-container">
        hello
      </div>
      <?php
    }

  }