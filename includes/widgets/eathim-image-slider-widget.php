<?php
namespace Eathim_Image_Slider;

/**
 * Elementor Nameshpach
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Eathim Image Slider
 */
  class Eathim_Image_Slider_Widget extends \Elementor\Widget_Base{

    /**
     * Get widget name.
     *
     * @return void
     */
    public function get_name() {
      return 'eathim-eathim-addons-text-widgets';
    }

    /**
     * Get widget title.
     *
     * @return void
     */
    public function get_title() {
      return esc_html__( 'Text Widgets', 'eathim-addons' );
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
      return [];
    }

    /**
     * Scripts Depends
     *
     * @return void
     */
    public function get_script_depends() {
      return ['eathim-image-slider'];
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

    $this->add_control(
			'heading',
			[
				'type' => Controls_Manager::TEXT,
				'label' => esc_html__( 'Heading', 'eathim-addons' ),
			]
		);

    $this->add_control(
			'description',
			[
				'type' => Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Description', 'eathim-addons' ),
			]
		);

    $this->add_control(
			'description',
			[
				'type' => Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Description', 'eathim-addons' ),
			]
		);

    $this->add_control(
			'button_text',
			[
				'type' => Controls_Manager::TEXT,
				'label' => esc_html__( 'Button text', 'eathim-addons' ),
				'placeholder' => esc_html__( 'My Button', 'eathim-addons' ),
			]
		);

    $this->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link', 'eathim-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'eathim-addons' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
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

    $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ra-slider-container h1',
			]
		);

    $this->end_controls_section();
  }




  public function render() {
    $settings = $this->get_settings_for_display();
    $heading = $settings['heading'];
    $button_text = $settings['button_text'];



    if ( ! empty( $settings['website_link']['url'] ) ) {
			$this->add_link_attributes( 'website_link', $settings['website_link'] );
		}
    ?>
    <div class="ra-slider-container">
      <h1><?php echo esc_html($heading, 'eathim-addons'); ?></h1>
      <a <?php echo $this->get_render_attribute_string( 'website_link' ); ?>>
        <?php echo esc_html($button_text, 'eathim-addons'); ?>
		  </a>
    </div>
    <?php
  }

}