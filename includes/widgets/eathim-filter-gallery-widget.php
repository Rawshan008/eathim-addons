<?php
namespace Eathim_Filter_Gallery;

/**
 * Elementor Nameshpach
 */
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Controls_Manager;

/**
 * Eathim Image Slider
 */
  class Eathim_Filter_Gallery_Widget extends \Elementor\Widget_Base{

    /**
     * Get widget name.
     *
     * @return void
     */
    public function get_name() {
      return 'eathim-addons-filter-gallery-widgets';
    }

    /**
     * Get widget title.
     *
     * @return void
     */
    public function get_title() {
      return esc_html__( 'Filter Gallery', 'eathim-addons' );
    }

    /**
     * Get widget icon.
     *
     * @return void
     */
    public function get_icon() {
      return 'eicon-bullet-list';
    }

    /**
     * Get custom help URL.
     *
     * @return void
     */
    public function get_custom_help_url() {
      return '';
    }

    /**
     * Scripts Styles
     *
     * @return void
     */
    public function get_style_depends() {
      return ['magnific-popup'];
    }

    /**
     * Scripts Depends
     *
     * @return void
     */
    public function get_script_depends() {
      return ['isotope', 'magnific-popup', 'eathim-filter-gallery'];
    }

    /**
     * Widgets Category
     *
     * @return void
     */
    public function get_categories() {
      return [ 'eathim-addons' ];
    }

    public function get_keywords() {
      return [ 'list', 'lists', 'ordered', 'unordered' ];
    }

  /**
   * Addons Control Controls
   */

  protected function register_controls() {
    /**
     * Content Control
     */
    $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'eathim-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

    $repeater = new Repeater();

    $repeater->add_control(
			'filter_menu',
			[
				'type' => Controls_Manager::TEXT,
				'label' => esc_html__( 'Filter Text', 'eathim-addons' ),
			]
		);

    $repeater->add_control(
			'image',
			[
				'type' => Controls_Manager::MEDIA,
				'label' => esc_html__( 'Image', 'eathim-addons' ),
        'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

    $this->add_control(
			'images',
			[
				'label' => esc_html__( 'Images', 'eathim-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
    

    $this->end_controls_section();

    /**
     * Style Control
     */

    $this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Style', 'eathim-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

  
    $this->add_control(
			'column',
			[
				'label' => esc_html__( 'column', 'eathim-addons' ),
				'type' => Controls_Manager::SELECT,
        'options' => [
					1 => __( '1 Column', 'eathim-addons' ),
					2 => __( '2 Columns', 'eathim-addons' ),
					3 => __( '3 Columns', 'eathim-addons' ),
					4 => __( '4 Columns', 'eathim-addons' ),
					5 => __( '5 Columns', 'eathim-addons' ),
					6 => __( '6 Columns', 'eathim-addons' ),
				],
				'default' => 2,
        'selectors' => [
					'{{WRAPPER}} .filter-gallery-single-item' => '--image-grid-column: {{VALUE}};',
				],
        'style_transfer' => true,
			]
		);

    $this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Masonry?', 'eathim-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
          'masonry' => __('Masonry', 'eathim-addons'),
          'fitRows' => __('fitRows', 'eathim-addons'),
          'equal' => __('Equal Height', 'eathim-addons'),
        ],
				'default' => 'masonry',
			]
		);

    $this->add_control(
			'image_height',
			[
				'label' => esc_html__( 'Image Height', 'plugin-name' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000
					]
				],
        'selectors' => [
					'{{WRAPPER}} .filter-gallery-single-item img' => 'height: {{SIZE}}{{UNIT}}',
				],
        'condition' => [
					'layout' => 'equal',
				]
			]
		);


    $this->end_controls_section();
  }




  public function render() {
    $settings = $this->get_settings_for_display();

    $images = $settings['images'];

    $this->add_render_attribute( 'eathim-gallery', 'class', [ 'filter-eathim-gallery'] );

    $this->add_render_attribute([
      'eathim-gallery' => [
        'data-settings' => [
          wp_json_encode(array_filter([
            "layoutMode" => ('equal' == $settings['layout']) ? "masonry" : $settings['layout'],
          ]))
        ]
      ]
    ]);


    ?>
      <div <?php $this->print_render_attribute_string( 'eathim-gallery' ); ?>>
        <div class="filter-gallery-filter">
          <?php 
            $filters = [];
            foreach($images as $image) {
              $filters[] = strtolower($image['filter_menu']);
            }
          ?>
          <button data-filter="*">All</button>
         <?php  
            foreach(array_unique($filters) as $filter):
          ?>
         <button data-filter=".eathim-filter-<?php echo esc_attr($filter)?>"><?php echo esc_html($filter) ?></button>
         <?php endforeach; ?>
        </div>
        <div class="filter-gallery-content filter-gallery-content-<?php echo $this->get_id();?>">
          <?php foreach($images as $image): ?>
          <a href="<?php echo esc_url($image['image']['url']);?>" class="filter-gallery-single-item eathim-filter-<?php echo esc_attr(strtolower($image['filter_menu']))?>">
              <img alt="" src="<?php echo esc_url($image['image']['url']);?>"/>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php

      if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) :
        printf( '<script>jQuery(".filter-gallery-content-%s").isotope();</script>', $this->get_id() );
      endif;
  }

}