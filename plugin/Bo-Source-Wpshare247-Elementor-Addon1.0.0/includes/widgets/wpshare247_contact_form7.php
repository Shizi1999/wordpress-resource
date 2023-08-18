<?php
class wpshare247_contact_form7 extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wpshare247-contact-form-7';
	}

	public function get_title() {
		return esc_html__( 'Ws247 Contact From 7', 'wpshare247-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'wpshare247' ];
	}

	public function get_keywords() {
		return [ 'tbay', 'wpshare247', 'contact', 'form'];
	}

	protected function register_query_controls() {
		$this->add_control(
			'contact_form_id',
			[
				'label' => esc_html__( 'Form', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => Ws247_EA_Helper::get_contact_form_options(),
				'default' => [''],
			]
		);
		
		$this->add_control(
			'contact_form_attr_id',
			[
				'label' => esc_html__( 'ID', 'elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'elementor' ),
				'placeholder' => esc_html__( 'contact-form-1', 'elementor' ),
			]
		);

		$this->add_control(
			'contact_form_attr_class',
			[
				'label' => esc_html__( 'Class', 'elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'elementor' ),
				'placeholder' => esc_html__( 'form contact-form', 'elementor' ),
			]
		);

		$this->add_control(
			'hide_title',
			[
				'label' => esc_html__( 'Hide title', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => '',
				'prefix_class' => 'ws247-wpcf7-hide-title-',
			]
		);

		$this->add_control(
					'title_color',
					[
						'label' => esc_html__( 'Title color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wpcf7-form p label' => 'color: {{VALUE}}',
						],
					]
				);

		$this->add_control(
					'valid_color',
					[
						'label' => esc_html__( 'Validate Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wpcf7-form .wpcf7-not-valid-tip' => 'color: {{VALUE}}',
						],
					]
				);

		$this->add_control(
					'response_color',
					[
						'label' => esc_html__( 'Response Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wpcf7-form .wpcf7-response-output' => 'color: {{VALUE}}',
						],
					]
				);
		
	}

	protected function register_tab_query_section() {

		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__( 'Form', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT, //TAB_ADVANCED
			]
		);
			$this->register_query_controls();

		$this->end_controls_section();

	}


	protected function register_style_input_controls() {
		$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'input_border',
					'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
				]
			);

		$this->add_control(
					'input_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

		$this->add_control(
					'input_color',
					[
						'label' => esc_html__( 'Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'color: {{VALUE}}',
						],
					]
				);

		$this->add_control(
					'input_margin',
					[
						'label' => esc_html__( 'Margin', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

		$this->add_control(
			'input_full_width',
			[
				'label' => esc_html__( 'Full Width', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( '100%', 'elementor' ),
				'label_off' => esc_html__( 'Auto', 'elementor' ),
				'return_value' => 'yes',
				'default' => '',
				'prefix_class' => 'ws247-wpcf7-field-full-',
			]
		);
	}

	protected function register_style_submit_controls() {
		$this->start_controls_tabs(
			'title_style_tabs'
		);
			$this->start_controls_tab(
				'title_style_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'elementor' ),
				]
			);

			$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'submit_color_bg',
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .wpcf7-submit',
					]
				);

			$this->add_control(
					'submit_color',
					[
						'label' => esc_html__( 'Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .wpcf7-submit' => 'color: {{VALUE}}',
						],
					]
				);

			$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'submit_border',
						'selector' => '{{WRAPPER}} .wpcf7-submit',
					]
				);

			$this->add_control(
						'submit_border_radius',
						[
							'label' => esc_html__( 'Border Radius', 'elementor' ),
							'type' => \Elementor\Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em', 'custom' ],
							'selectors' => [
								'{{WRAPPER}} .wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

			$this->add_control(
					'submit_align',
					[
						'label' => esc_html__( 'Alignment', 'elementor' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'options' => [
							'left' => [
								'title' => esc_html__( 'Left', 'elementor' ),
								'icon' => 'eicon-text-align-left',
							],
							'center' => [
								'title' => esc_html__( 'Center', 'elementor' ),
								'icon' => 'eicon-text-align-center',
							],
							'right' => [
								'title' => esc_html__( 'Right', 'elementor' ),
								'icon' => 'eicon-text-align-right',
							],
							'justify' => [
								'title' => esc_html__( 'Justify', 'elementor' ),
								'icon' => 'eicon-text-align-justify',
							],
						],
						'default' => 'left',
						'prefix_class' => 'ws247-wpcf7-submit-align-',
						'default' => 'left',
					]
				);

			$this->end_controls_tab();

			//Hover
			$this->start_controls_tab(
				'title_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'elementor' ),
				]
			);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'submit_color_bg_hover',
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .wpcf7-submit:hover',
					]
				);

				$this->add_control(
						'submit_color_hover',
						[
							'label' => esc_html__( 'Color', 'elementor' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .wpcf7-submit:hover' => 'color: {{VALUE}}',
							],
						]
					);

				$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'submit_border_hover',
							'selector' => '{{WRAPPER}} .wpcf7-submit:hover',
						]
					);

				$this->add_control(
							'submit_border_radius_hover',
							[
								'label' => esc_html__( 'Border Radius', 'elementor' ),
								'type' => \Elementor\Controls_Manager::DIMENSIONS,
								'size_units' => [ 'px', '%', 'em', 'custom' ],
								'selectors' => [
									'{{WRAPPER}} .wpcf7-submit:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								],
							]
						);
			$this->end_controls_tab();

		$this->end_controls_tabs();

	}


	protected function register_tab_style_input_section(){
		$this->start_controls_section(
			'section_style_input',
			[
				'label' => esc_html__( 'Input', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_style_input_controls();

		$this->end_controls_section();

	}

	protected function register_tab_style_submit_section(){
		$this->start_controls_section(
			'section_style_submit',
			[
				'label' => esc_html__( 'Submit', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_style_submit_controls();

		$this->end_controls_section();

	}


	protected function register_controls() {
		$this->register_tab_query_section();
		$this->register_tab_style_input_section();
		$this->register_tab_style_submit_section();
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();

		$contact_form_id = $settings['contact_form_id']; 
		$contact_form_attr_id = $settings['contact_form_attr_id']; 
		$contact_form_attr_class = $settings['contact_form_attr_class']; 
		
		if(!$contact_form_id>0) return '';

		$shortcode =  '[contact-form-7 ';

		if($contact_form_id>0){
			$shortcode .= ' id="'.$contact_form_id.'" ';
		}

		if($contact_form_attr_id>0){
			$shortcode .= ' html_id="'.$contact_form_attr_id.'" ';
		}

		if($contact_form_attr_class>0){
			$shortcode .= ' html_class="'.$contact_form_attr_class.'" ';
		}

		$shortcode .= ']';
	?>

		<section class="wpshare247-elementor-addon wpshare247-contact-form7">
			<?php echo do_shortcode($shortcode); ?>
		</section>

	<?php
	}
}