<?php
namespace Eathim_Justified_Gallery;

/**
 * Elementor Nameshpach
 */
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Controls_Manager;

/**
 * Eathim Image Slider
 */
  class Eathim_Justified_Gallery_Widget extends \Elementor\Widget_Base{

    /**
     * Get widget name.
     *
     * @return void
     */
    public function get_name() {
      return 'eathim-addons-justified-gallery-widgets';
    }

    /**
     * Get widget title.
     *
     * @return void
     */
    public function get_title() {
      return esc_html__( 'Justified Gallery', 'eathim-addons' );
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
      return ['justifiedGallery'];
    }

    /**
     * Scripts Depends
     *
     * @return void
     */
    public function get_script_depends() {
      return ['justifiedGallery', 'eathim-justified-gallery'];
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
			'image',
			[
				'type' => Controls_Manager::MEDIA,
				'label' => esc_html__( 'Image', 'eathim-addons' ),
        'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

    $repeater->add_control(
			'caption',
			[
				'type' => Controls_Manager::TEXTAREA,
				'label' => esc_html__( 'Caption', 'eathim-addons' ),
			]
		);

    $this->add_control(
			'images',
			[
				'label' => esc_html__( 'Images', 'eathim-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ caption }}}',
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
			'rowHeight',
			[
				'label' => esc_html__( 'Height ', 'eathim-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 150
			]
		);
    $this->add_control(
			'margins',
			[
				'label' => esc_html__( 'Margin', 'eathim-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10
			]
		);

    $this->end_controls_section();
  }




  public function render() {
    $settings = $this->get_settings_for_display();

    $images = $settings['images'];

    $this->add_render_attribute( 'eathim-gallery', 'class', [ 'eathim-gallery'] );

    $this->add_render_attribute([
      'eathim-gallery' => [
        'data-settings' => [
          wp_json_encode(array_filter([
            "margins" => isset($settings['margins']) ? (int) $settings['margins'] : 10,
            "rowHeight" => isset($settings['rowHeight']) ? (int) $settings['rowHeight'] : 150,
          ]))
        ]
      ]
    ]);


    ?>
      <div <?php $this->print_render_attribute_string( 'eathim-gallery' ); ?>>
        <div class="gallery-content">
          <?php foreach($images as $image):?>
          <a href="<?php echo esc_url($image['image']['url']);?>" class="gallery-single-item">
              <img alt="<?php echo esc_attr($image['caption'])?>" src="<?php echo esc_url($image['image']['url']);?>"/>
              <div class="jg-caption"><?php echo esc_html($image['caption'], 'eathim-addons') ?></div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php
  }

}