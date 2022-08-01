<?php
namespace Eathim_Counter;

/**
 * Elementor Nameshpach
 */
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Controls_Manager;

/**
 * Eathim Image Slider
 */
  class Eathim_Counter extends \Elementor\Widget_Base{

    /**
     * Get widget name.
     *
     * @return void
     */
    public function get_name() {
      return 'eathim-counter';
    }

    /**
     * Get widget title.
     *
     * @return void
     */
    public function get_title() {
      return esc_html__( 'Counter', 'eathim-addons' );
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
      return ['eathim-counter'];
    }

    /**
     * Scripts Depends
     *
     * @return void
     */
    public function get_script_depends() {
      return [''];
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
      return [ 'counter', 'service', 'counter up', 'unordered' ];
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
			'icon',
			[
				'label' => esc_html__( 'Icon', 'eathim-addons' ),
				'type' => Controls_Manager::ICONS,
        'default' => [
          'value' => 'fas fa-star',
          'library' => 'solid',
        ],
			]
		);

    $this->add_control(
			'number',
			[
				'label' => esc_html__( 'Title', 'eathim-addons' ),
				'type' => Controls_Manager::NUMBER,
        'default' => 20,
			]
		);

    $this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'eathim-addons' ),
				'type' => Controls_Manager::TEXTAREA,
        'default' => esc_html__('Default description', 'eathim-addons'),
        'placeholder' => esc_html__('Type your description here', 'eathim-addons'),
			]
		);
		
		$this->add_control(
			'number_post_fix',
			[
				'label' => esc_html__( 'Post Fix', 'eathim-addons' ),
				'type' => Controls_Manager::TEXT,
        'placeholder' => esc_html__('+', 'eathim-addons'),
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
			'card_box',
			[
				'label' => esc_html__( 'Card Box', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'card_box_bg',
			[
				'label' => esc_html__( 'Card Box', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .service-card-wrapper' => 'background-color: {{VALUE}}',
				],
			]
		);

    $this->add_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .service-card-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
    $this->add_control(
			'hover_box_shadow',
			[
				'label' => esc_html__( 'Hover Box Shadow', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::BOX_SHADOW,
				'selectors' => [
					'{{WRAPPER}} .service-card-wrapper:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
				],
			]
		);

    $this->add_control(
			'icon_style',
			[
				'label' => esc_html__( 'Icon', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

    $this->add_control(
			'box_size',
			[
				'label' => esc_html__( 'Box Size', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
					'px' => [
						'min' => 40,
						'max' => 100,
						'step' => 1,
					]
				 ],
       'default' =>[
        'unit' => 'px',
        'size' => 70
       ],
				'selectors' => [
					'{{WRAPPER}} .service-card-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
				],
			]
		);

    $this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
					'px' => [
						'min' => 15,
						'max' => 50,
						'step' => 1,
					]
				 ],
       'default' =>[
        'unit' => 'px',
        'size' =>30
       ],
				'selectors' => [
					'{{WRAPPER}} .service-card-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

    $this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .service-card-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( 'Icon BG Color', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ddd',
				'selectors' => [
					'{{WRAPPER}} .service-card-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

    $this->add_control(
			'heading_style',
			[
				'label' => esc_html__( 'Heading', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => esc_html__('Typography', 'eathim-addons'),
				'selector' => '{{WRAPPER}} .service-card-content h3',
			]
		);

    $this->add_control(
			'heading_color',
			[
				'label' => esc_html__( 'Color', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .service-card-content h3' => 'color: {{VALUE}}',
				],
			]
		);

    $this->add_control(
			'description_style',
			[
				'label' => esc_html__( 'Description', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => esc_html__('Typography', 'eathim-addons'),
				'selector' => '{{WRAPPER}} .service-card-content p',
			]
		);

    $this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .service-card-content p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => esc_html__( 'Description', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__('Typography', 'eathim-addons'),
				'selector' => '{{WRAPPER}} .service-card-btn',
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Color', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .service-card-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__( 'Border', 'eathim-addons' ),
				'selector' => '{{WRAPPER}} .service-card-btn',
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .service-card-btn:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__( 'Hover Bg Color', 'eathim-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ddd',
				'selectors' => [
					'{{WRAPPER}} .service-card-btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

    $this->end_controls_section();
  }




  public function render() {
    $settings = $this->get_settings_for_display();

    $icon = $settings['icon'];
    $number = $settings['number'];
    $number_post_fix = $settings['number_post_fix'];
    $description = $settings['description'];
    
    ?>

    <div class="eathim-counter-wrapper">

		<?php if(!empty($number)): ?>
		<?php \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] ); ?>
		<?php endif; ?>
			
		<?php if(!empty($number)): ?>
			<p><span><?php echo esc_html($number); ?></span><?php if(!empty($number_post_fix)): ?><?php echo esc_html($number_post_fix); ?><?php endif;?></p>
		<?php endif; ?>

		<?php if(!empty($description)): ?>
			<h3><?php echo esc_html($description); ?></h3>
		<?php endif; ?>

		</div>
    <?php 
  }

}