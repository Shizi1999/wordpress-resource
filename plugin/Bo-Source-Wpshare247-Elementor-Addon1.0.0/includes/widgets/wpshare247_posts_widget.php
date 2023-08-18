<?php
class wpshare247_posts_widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wpshare247-get-list-posts';
	}

	public function get_title() {
		return esc_html__( 'Ws247 List Posts', 'wpshare247-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'wpshare247' ];
	}

	public function get_keywords() {
		return [ 'tbay', 'wpshare247', 'post', 'list', 'query', 'grid', 'carousel', 'slider' ];
	}


	protected function register_query_controls() {
		$this->add_control(
			'post_type',
			[
				'label' => esc_html__( 'Post Types', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'post',
				'options' => Ws247_EA_Helper::get_post_type_options()
			]
		);


		$this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Order By', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => esc_html__( 'Creation Date', 'elementor' ),
					'title' => esc_html__( 'Title', 'elementor' ),
					'rand'  => esc_html__( 'Random', 'elementor' )
				]
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'desc' => esc_html__( 'DESC', 'elementor' ),
					'asc' => esc_html__( 'ASC', 'elementor' )
				]
			]
		);


		$this->add_control(
			'post_per_page',
			[
				'label' => esc_html__( 'Posts Per Page', 'elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 50,
				'step' => 1,
				'default' => 6,
			]
		);
	}

	protected function register_slider_controls() {
		$this->add_control(
			'slider_on',
			[
				'label' => esc_html__( 'Show', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'slidesPerView',
			[
				'label' => esc_html__( 'Column', 'elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 20,
				'step' => 1,
				'default' => 3,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 1,
				'default' => 0,
			]
		);

		$this->add_control(
			'slider_pagination',
			[
				'label' => esc_html__( 'Pagination', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'slider_arrows',
			[
				'label' => esc_html__( 'Arrows', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
	}

	protected function register_pagination_controls() {
		$this->add_control(
			'pagination_on',
			[
				'label' => esc_html__( 'Show', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'pagination_align',
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
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .nav-links' => 'text-align: {{VALUE}};',
				],
			]
		);
	}

	protected function register_layout_controls(){
		$this->add_control(
			'list_column',
			[
				'label' => esc_html__( 'Column', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5'
				]
			]
		);

		$this->add_control(
			'lo_hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'img_show',
			[
				'label' => esc_html__( 'Image', 'elementor' ) . ' ' .esc_html__( 'Show', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'img_size',
			[
				'label' => esc_html__( 'Image Size', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'medium',
				'options' => Ws247_EA_Helper::get_image_sizes_options()
			]
		);
		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'title_show',
			[
				'label' => esc_html__( 'Title', 'elementor' ) . ' ' .esc_html__( 'Show', 'elementor' ) ,
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h2' => esc_html__( 'h2', 'elementor' ),
					'h3' => esc_html__( 'h3', 'elementor' ),
					'h4' => esc_html__( 'h4', 'elementor' ),
					'h5' => esc_html__( 'h5', 'elementor' ),
					'h6' => esc_html__( 'h6', 'elementor' ),
					'p' => esc_html__( 'p', 'elementor' ),
					'div' => esc_html__( 'div', 'elementor' ),
				]
			]
		);

		$this->add_control(
			'title_text_align',
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
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		

		$this->add_control(
			'excerpt_show',
			[
				'label' => esc_html__( 'Excerpt', 'elementor' ) . ' ' .esc_html__( 'Show', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' => esc_html__( 'Length', 'elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 200,
				'step' => 1,
				'default' => 50,
			]
		);

		$this->add_control(
			'excerpt_text_align',
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
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .excerpt' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'hr3',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'readmore_show',
			[
				'label' => esc_html__( 'Read More', 'elementor' ) . ' '.esc_html__( 'Show', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label' => esc_html__( 'Label', 'elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Read more', 'elementor' ),
				'placeholder' => esc_html__( 'Type your read more', 'elementor' ),
			]
		);

		$this->add_control(
			'readmore_icon',
			[
				'label' => esc_html__( 'Icon', 'elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-long-arrow-alt-right',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'long-arrow-alt-right',
						'angle-right',
						'chevron-right',
					],
					'fa-regular' => [
						'long-arrow-alt-right',
						'angle-right',
						'chevron-right',
					],
				],
			]
		);


		$this->add_control(
			'readmore_text_align',
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
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .readmore-out' => 'text-align: {{VALUE}};',
				],
			]
		);
	}


	protected function register_tab_content_section(){
		// Query Tab Start
		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__( 'Query', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT, //TAB_ADVANCED
			]
		);

			$this->register_query_controls();
		
		$this->end_controls_section();

		// Slider Tab Start
		$this->start_controls_section(
			'section_slider',
			[
				'label' => _x( 'Slideshow', 'Background Control', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT, //TAB_ADVANCED
			]
		);

			$this->register_slider_controls();

		$this->end_controls_section();

		// Pagination Tab Start
		$this->start_controls_section(
			'pagination',
			[
				'label' => esc_html__( 'Pagination', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT, //TAB_ADVANCED
			]
		);
			$this->register_pagination_controls();

		$this->end_controls_section();

		// Layout Tab Start
		$this->start_controls_section(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT, //TAB_ADVANCED
			]
		);
			$this->register_layout_controls();

		$this->end_controls_section();
	}


	protected function register_image_controls(){
		$this->start_controls_tabs(
			'image_style_tabs'
		);
			$this->start_controls_tab(
				'image_style_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'elementor' ),
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'img_border',
						'selector' => '{{WRAPPER}} .loop-top img',
					]
				);

				$this->add_control(
					'img_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .loop-top img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'image_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'elementor' ),
				]
			);
				$this->add_control(
					'box_img_hover',
					[
						'label' => esc_html__( 'Image scale', 'elementor' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 's' ],
						'range' => [
							's' => [
								'min' => 0,
								'max' => 2,
								'step' => 0.1,
							]
						],
						'default' => [
							'unit' => 's',
							'size' => 1,
						],
						'selectors' => [
							'{{WRAPPER}} .ws247-eaddon-post-loop-item:hover .loop-top img' => 'transform: scale({{SIZE}});',
						],
					]
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
	}

	protected function register_title_controls(){
		$this->start_controls_tabs(
			'title_style_tabs'
		);
			$this->start_controls_tab(
				'title_style_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'elementor' ),
				]
			);

				$this->add_control(
					'title_style_color',
					[
						'label' => esc_html__( 'Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .title a' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'title_style_typography',
						'selector' => '{{WRAPPER}} .title a',
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'title_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'elementor' ),
				]
			);

				$this->add_control(
					'title_style_color_hover',
					[
						'label' => esc_html__( 'Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ws247-eaddon-post-loop-item:hover .title a' => 'color: {{VALUE}}',
						],
					]
				);
				
			$this->end_controls_tab();
		$this->end_controls_tabs();
	}

	protected function register_excerpt_controls(){
		$this->start_controls_tabs(
			'excerpt_style_tabs'
		);
			$this->start_controls_tab(
				'excerpt_style_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'elementor' ),
				]
			);

				$this->add_control(
					'title_excerpt_color',
					[
						'label' => esc_html__( 'Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .excerpt' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'title_excerpt_typography',
						'selector' => '{{WRAPPER}} .excerpt',
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'excerpt_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'elementor' ),
				]
			);

				$this->add_control(
					'title_excerpt_color_hover',
					[
						'label' => esc_html__( 'Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ws247-eaddon-post-loop-item:hover .excerpt' => 'color: {{VALUE}}',
						],
					]
				);
				
			$this->end_controls_tab();
		$this->end_controls_tabs();

		
	}

	protected function register_readmore_controls(){
		$this->start_controls_tabs(
			'readmore_style_tabs'
		);
			$this->start_controls_tab(
				'readmore_style_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'elementor' ),
				]
			);
				$this->add_control(
					'title_readmore_color',
					[
						'label' => esc_html__( 'Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .readmore' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'title_readmore_bg',
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .readmore',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'title_readmore_typography',
						'selector' => '{{WRAPPER}} .readmore',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'title_readmore_border',
						'selector' => '{{WRAPPER}} .readmore',
					]
				);

				$this->add_control(
					'title_readmore_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'title_readmore_padding',
					[
						'label' => esc_html__( 'Padding', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'title_readmore_margin',
					[
						'label' => esc_html__( 'Margin', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .readmore-out' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				

			$this->end_controls_tab();

			$this->start_controls_tab(
				'readmore_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'elementor' ),
				]
			);

				$this->add_control(
					'title_readmore_color_hover',
					[
						'label' => esc_html__( 'Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ws247-eaddon-post-loop-item:hover .readmore' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'title_readmore_bg_hover',
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .ws247-eaddon-post-loop-item:hover .readmore',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'title_readmore_typography_hover',
						'selector' => '{{WRAPPER}} .ws247-eaddon-post-loop-item:hover .readmore',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'title_readmore_border_hover',
						'selector' => '{{WRAPPER}} .ws247-eaddon-post-loop-item:hover .readmore',
					]
				);

				$this->add_control(
					'title_readmore_border_radius_hover',
					[
						'label' => esc_html__( 'Border Radius', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .ws247-eaddon-post-loop-item:hover .readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'title_readmore_padding_hover',
					[
						'label' => esc_html__( 'Padding', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .ws247-eaddon-post-loop-item:hover .readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'title_readmore_margin_hover',
					[
						'label' => esc_html__( 'Margin', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .ws247-eaddon-post-loop-item:hover .readmore-out' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				
			$this->end_controls_tab();
		$this->end_controls_tabs();
	}

	protected function register_bottom_box_controls(){
		$this->add_control(
				'bottom_box_padding',
				[
					'label' => esc_html__( 'Padding', 'elementor' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em', 'custom' ],
					'default' => [
						'unit' => 'px',
						'top' => 10,
						'right' => 10,
						'bottom' => 10,
						'left' => 10
					],
					'selectors' => [
						'{{WRAPPER}} .loop-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	}


	protected function register_box_controls(){
		$this->start_controls_tabs(
			'box_style_tabs'
		);
			$this->start_controls_tab(
				'box_style_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'elementor' ),
				]
			);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'box_bg',
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .ws247-eaddon-post-loop-item',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'box_border',
						'selector' => '{{WRAPPER}} .ws247-eaddon-post-loop-item',
					]
				);

				$this->add_control(
					'box_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .ws247-eaddon-post-loop-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'box_padding',
					[
						'label' => esc_html__( 'Padding', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .ws247-eaddon-post-loop-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'box_margin',
					[
						'label' => esc_html__( 'Margin', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'default' => [
							'unit' => 'px',
							'top' => 0,
							'right' => 0,
							'bottom' => 20,
							'left' => 0
						],
						'selectors' => [
							'{{WRAPPER}} .ws247-eaddon-post-loop-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'box_style_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'elementor' ),
				]
			);
				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'box_bg_hover',
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .ws247-eaddon-post-loop-item:hover',
					]
				);

				$this->add_control(
					'box_style_hover_tab_hr1',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);


				$this->add_control(
					'box_box_shadow_hover',
					[
						'label' => esc_html__( 'Box Shadow', 'elementor' ),
						'type' => \Elementor\Controls_Manager::BOX_SHADOW,
						'selectors' => [
							'{{WRAPPER}} .ws247-eaddon-post-loop-item:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
						],
					]
				);

				$this->add_control(
					'box_style_hover_tab_hr2',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);

				$this->add_control(
					'box_transition_hover',
					[
						'label' => esc_html__( 'Transition (s)', 'elementor' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 's' ],
						'range' => [
							's' => [
								'min' => 0,
								'max' => 1,
								'step' => 0.1,
							]
						],
						'default' => [
							'unit' => 's',
							'size' => .5,
						],
						'selectors' => [
							'{{WRAPPER}} *' => 'transition: all {{SIZE}}{{UNIT}};',
						],
					]
				);
			$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	protected function register_tab_style_section(){
		//----------------------
		$this->start_controls_section(
			'section_img_style',
			[
				'label' => esc_html__( 'Image', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_image_controls();

		$this->end_controls_section();

		//----------------------
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_title_controls();

		$this->end_controls_section();

		//----------------------
		$this->start_controls_section(
			'section_Excerpt_style',
			[
				'label' => esc_html__( 'Excerpt', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);

			$this->register_excerpt_controls();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_readmore_style',
			[
				'label' => esc_html__( 'Read More', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_readmore_controls();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_bottom_box_style',
			[
				'label' => esc_html__( 'Bottom box', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_bottom_box_controls();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => esc_html__( 'Box', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_box_controls();

		$this->end_controls_section();
	}


	//https://developers.elementor.com/docs/editor-controls/control-types/
	protected function register_controls() {

		$this->register_tab_content_section();

		$this->register_tab_style_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$post_type = $settings['post_type'];
		$post_per_page = $settings['post_per_page'];
		$slider_on = ($settings['slider_on']==='yes') ? true : false;
		$orderby = $settings['orderby'];
		$order = $settings['order'];

		$args_filter = array(
		    'post_type' => $post_type,
		    'post_status' => array('publish'),
		    'posts_per_page' => $post_per_page,
		    'paged' => Ws247_EA_Helper::get_current_page(),
		    'orderby'             => $orderby, 
		    'order'                => $order
		);
		$the_query = new WP_query($args_filter);

		$slidesPerView = $settings['slidesPerView']; 
		$autoplay = (int)$settings['autoplay'];
		$slider_pagination = ($settings['slider_pagination']==='yes') ? true : false; 
		$slider_arrows = ($settings['slider_arrows']==='yes') ? true : false;

		$pagination_on = ($settings['pagination_on']==='yes') ? true : false;

		$img_show = ($settings['img_show']==='yes') ? true : false;
		$img_size = $settings['img_size']; 

		
		$title_show = ($settings['title_show']==='yes') ? true : false;
		$title_tag = $settings['title_tag'];
		

		$excerpt_show = ($settings['excerpt_show']==='yes') ? true : false;
		$excerpt_length = $settings['excerpt_length'];

		
		$readmore_show = ($settings['readmore_show']==='yes') ? true : false;
		$readmore_text = $settings['readmore_text'];
		$readmore_icon = $settings['readmore_icon'];
 
		$container_id = uniqid('wpshare247-posts-container-'); 

		$i_column = (int)$settings['list_column'];

		if($i_column==1){
			$column_class = 'elementor-col';
		}elseif($i_column==2){
			$column_class = 'elementor-col-50';
		}elseif($i_column==4){
			$column_class = 'elementor-col-25';
		}elseif($i_column==5){
			$column_class = 'elementor-col-20';
		}else{
			$column_class = 'elementor-col-33';
		}

	
		if($the_query->have_posts()):
			?>
		<section class="wpshare247-elementor-addon">
			<div id="<?php echo esc_html__($container_id); ?>" class="elementor-container elementor-column-gap-default <?php if($slider_on) echo 'wpshare247-swiper-slider swiper'; else echo 'wpshare247-flex-wrap'; ?>">
				<?php
				if($slider_on){
					echo '<div class="swiper-wrapper">';
				}
			    while ($the_query->have_posts()) : $the_query->the_post();
			    ?>
			    	<div class="<?php if($slider_on) echo 'swiper-slide'; ?> elementor-column <?php echo esc_html__($column_class); ?> elementor-top-column elementor-element ws247-eaddon-post-loop ">
			    		<div class="elementor-widget-wrap elementor-element-populated">
			    			<article <?php post_class('ws247-eaddon-post-loop-item ws247-eaddon-classic'); ?>>
			    				<?php 
			    				if($img_show){
			    					?>
			    					<a class="loop-top" href="<?php the_permalink(); ?>">
					    				<?php the_post_thumbnail( $img_size, array('alt' => get_the_title())); ?>
					    			</a>
			    					<?php
			    				}
			    				?>
			    				
				    			<div class="loop-bottom">
				    				<?php 
				    				if($title_show){
				    				?>
				    				<<?php echo esc_html__($title_tag); ?> class="title">
				    					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				    				</<?php echo esc_html__($title_tag); ?>>
				    				<?php
				    				}
				    				?>
				    				
				    				<?php 
				    				if($excerpt_show){
				    				?>
				    					<p class="excerpt"><?php echo wp_trim_words( get_the_content(), $excerpt_length, '...' ); ?></p>
				    				<?php
				    				}
				    				?>
				    				

				    				<?php 
				    				if($readmore_show){
				    				?>
				    				<div class="readmore-out">
				    					<a class="readmore" href="<?php the_permalink(); ?>"><?php echo esc_html__($readmore_text); ?> 
				    					<?php 
				    					if($readmore_icon){
				    					?>
				    					<i class="<?php echo esc_html__($readmore_icon['value']);?>"></i>
				    					<?php
				    					}
				    					?>
				    						
				    					</a>
				    				</div>
				    				<?php
				    				}
				    				?>
				    				
				    			</div>
			    			</article>
			    		</div>
			    	</div>
			    <?php
			    endwhile;
			    wp_reset_postdata();
			    if($slider_on){
					echo '</div> <!-- .swiper-wrapper -->';
					?>
					<div class="swiper-pagination"></div>

					<?php 
					if($slider_arrows){
					?>
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
					<?php
					}
				}
			    ?>
		    </div>

		    <?php
		    if($slider_on){
		    	?>
		    	<script type="text/javascript">
		    		jQuery(document).ready(function($) {
		    			const wpshare247_swiper = new Swiper('#<?php echo esc_html__($container_id);?>', {
							  loop: true,

							  slidesPerView: <?php echo esc_html__($slidesPerView); ?>,

							  spaceBetween: 30,

							  <?php 
							  if($autoplay>0){
							  ?>
							   autoplay: {
							  	delay: <?php echo esc_html__($autoplay)*1000; ?>,
							  },
							  <?php
							  }
							  ?>
							 

							  breakpoints: {
								    320: {
								      slidesPerView: 1,
								      spaceBetween: 20
								    },
								    // when window width is >= 480px
								    480: {
								      slidesPerView: 2,
								      spaceBetween: 30
								    },
								    // when window width is >= 640px
								    640: {
								      slidesPerView: <?php echo esc_html__($slidesPerView); ?>,
								      spaceBetween: 40
								    }
							  },

							  <?php 
							  if($slider_pagination){
							  ?>
							  // If we need pagination
							  pagination: {
							    el: '.swiper-pagination',
							    clickable: true,
							  },
							  <?php 
							  }
							  ?>

							  <?php 
							  if($slider_arrows){
							  	?>
							  	 // Navigation arrows
								  navigation: {
								    nextEl: '.swiper-button-next',
								    prevEl: '.swiper-button-prev',
								  },
							  	<?php
							  }
							  ?>
							 

							  // And if we need scrollbar
							  scrollbar: {
							    el: '.swiper-scrollbar',
							  },
							} );
						});	
		    	</script>
		    	<?php
		    }else{
		    	//pagination
		    	$GLOBALS['wp_query']->max_num_pages = $the_query->max_num_pages;
		    	if($pagination_on){
			    	the_posts_pagination( array(
					    'mid_size'  => 2,
					    'prev_text' => __( '<i class="fas fa-angle-left"></i>', 'elementor' ),
					    'next_text' => __( '<i class="fas fa-angle-right"></i>', 'elementor' ),
					) );
		    	}
		    }
		endif;
		?>
	</section>
	<?php
	}
}