<?php
class wpshare247_products_widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wpshare247-get-list-products';
	}

	public function get_title() {
		return esc_html__( 'Ws247 Woo Poroducts', 'wpshare247-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-products';
	}

	public function get_categories() {
		return [ 'wpshare247' ];
	}

	public function get_keywords() {
		return [ 'tbay', 'wpshare247', 'product', 'list', 'query', 'grid', 'carousel', 'slider' ];
	}


	protected function register_query_controls() {
		$this->add_control(
				'type',
				[
					'label' => esc_html__( 'Sources', 'elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						''	=> esc_html__( 'New product', 'woocommerce' ),
						'on_sale'	=> esc_html__( 'Product on sale', 'woocommerce' ),
						'best_selling'	=> esc_html__( 'Top sellers', 'woocommerce' ),
						'top_rated'	=> esc_html__( 'Top rated products', 'woocommerce' ),
					]
				]
			);


		$this->add_control(
			'categories_options',
			[
				'label' => esc_html__( 'Categories', 'woocommerce' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
				'cat_operator',
				[
					'label' => esc_html__( 'Additional Options', 'elementor' ),
					'show_label' => false,
					'label_block' => true,
					'separator' => 'none',
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'IN',
					'options' => [
						'IN'	=> esc_html__( 'Include categories', 'woocommerce' ),
						'AND'	=> esc_html__( 'Both categories', 'woocommerce' ),
						'NOT IN'	=> esc_html__( 'Exclude categories', 'woocommerce' )
					]
				]
			);


		$this->add_control(
			'category',
			[
				'label' => esc_html__( 'Categories', 'woocommerce' ),
				'show_label' => false,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => Ws247_EA_Helper::get_term_options('product_cat'),
				'default' => [],
			]
		);

		$this->add_control(
			'tag_options',
			[
				'label' => esc_html__( 'Tags', 'woocommerce' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
				'tag_operator',
				[
					'label' => esc_html__( 'Additional Options', 'elementor' ),
					'show_label' => false,
					'label_block' => true,
					'separator' => 'none',
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'IN',
					'options' => [
						'IN'	=> esc_html__( 'Include tags', 'woocommerce' ),
						'AND'	=> esc_html__( 'Both tags', 'woocommerce' ),
						'NOT IN'	=> esc_html__( 'Exclude tags', 'woocommerce' )
					]
				]
			);

		$this->add_control(
			'tag',
			[
				'label' => esc_html__( 'Tags', 'woocommerce' ),
				'show_label' => false,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => Ws247_EA_Helper::get_term_options('product_tag'),
				'default' => [],
			]
		);

		$this->add_control(
			'featured',
			[
				'label' => esc_html__( 'Featured products', 'woocommerce' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => '',
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
							'id' => esc_html__( 'ID', 'elementor' ),
							'popularity'  => esc_html__( 'Popularity (sales)', 'woocommerce' ),
							'rating'  => esc_html__( 'Rating', 'elementor' ),
							'title'  => esc_html__( 'Title', 'elementor' ),
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
	}

	protected function register_layout_controls(){
		$this->add_control(
			'limit',
			[
				'label' => esc_html__( 'Per Page', 'elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -1,
				'max' => 32,
				'step' => 1,
				'default' => 8
			]
		);

		$this->add_control(
			'important_note',
			[
				'label' => esc_html__( '', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'All products, Per Page = -1', 'elementor' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => esc_html__( 'Column', 'elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 12,
				'step' => 1,
				'default' => 4,
			]
		);

		$this->add_control(
			'paginate',
			[
				'label' => esc_html__( 'Pagination', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
					'paginate_align',
					[
						'label' => 'Pagination '.esc_html__( 'Alignment', 'elementor' ),
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
							'{{WRAPPER}} .woocommerce-pagination' => 'text-align: {{VALUE}};',
						],
					]
				);
	}

	protected function register_slider_controls(){
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
				'default' => 4,
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
			'autoplay_note',
			[
				'label' => esc_html__( '', 'elementor' ),
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Stop Autoplay = 0', 'elementor' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
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

	protected function register_tab_query_section(){
		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__( 'Query', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT, //TAB_ADVANCED
			]
		);
			$this->register_query_controls();

		$this->end_controls_section();
	}

	protected function register_tab_layout_section(){
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT, //TAB_ADVANCED
			]
		);
			$this->register_layout_controls();

		$this->end_controls_section();
	}

	protected function register_tab_slider_section(){
		$this->start_controls_section(
			'section_slider',
			[
				'label' => esc_html__( 'Slideshow', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT, //TAB_ADVANCED
			]
		);
			$this->register_slider_controls();

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
						'selector' => '{{WRAPPER}} .product .woocommerce-loop-product__link img',
					]
				);

				$this->add_control(
					'img_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .product .woocommerce-loop-product__link img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .product:hover .woocommerce-loop-product__link img' => 'transform: scale({{SIZE}});',
						],
					]
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
	}

	protected function register_onsale_controls(){
		$this->add_control(
					'onsale_style_color',
					[
						'label' => esc_html__( 'Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} ul.products li.product .ws247-ea-img-wrapper .onsale' => 'color: {{VALUE}}',
						],
					]
				);

		$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'onsale_bg',
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} ul.products li.product .ws247-ea-img-wrapper .onsale',
				]
			);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'onsale_border',
				'selector' => '{{WRAPPER}} ul.products li.product .ws247-ea-img-wrapper .onsale',
			]
		);

		$this->add_control(
			'onsale_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} ul.products li.product .ws247-ea-img-wrapper .onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
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
							'{{WRAPPER}} .product .woocommerce-loop-product__title' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'title_style_typography',
						'selector' => '{{WRAPPER}} .product .woocommerce-loop-product__title',
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
							'{{WRAPPER}} .product:hover .woocommerce-loop-product__title' => 'color: {{VALUE}}',
						],
					]
				);
				
			$this->end_controls_tab();
		$this->end_controls_tabs();
	}

	protected function register_price_controls(){
		$this->add_control(
					'price_style_color',
					[
						'label' => esc_html__( 'Color', 'elementor' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} ul.products li.product .price' => 'color: {{VALUE}}',
						],
					]
				);

		$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'price_typography',
						'selector' => '{{WRAPPER}} ul.products li.product .price',
					]
				);
	}

	protected function register_addtocart_controls(){
		$this->add_control(
			'addtocart_icon',
			[
				'label' => esc_html__( 'Icon', 'elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-cart-arrow-down',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'cart-arrow-down',
						'cart-plus',
						'shopping-cart'
					]
				],
			]
		);

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
							'{{WRAPPER}} .product .button' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'title_readmore_bg',
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .product .button',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'title_readmore_typography',
						'selector' => '{{WRAPPER}} .product .button',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'title_readmore_border',
						'selector' => '{{WRAPPER}} .product .button',
					]
				);

				$this->add_control(
					'title_readmore_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .product .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .product .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .product .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				
				$this->add_control(
					'addtocart_align',
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
							'{{WRAPPER}} .product .ws247-ea-atc-wrapper' => 'text-align: {{VALUE}};',
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
							'{{WRAPPER}} .product:hover .button' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'title_readmore_bg_hover',
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .product:hover .button',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'title_readmore_typography_hover',
						'selector' => '{{WRAPPER}} .product:hover .button',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'title_readmore_border_hover',
						'selector' => '{{WRAPPER}} .product:hover .button',
					]
				);

				$this->add_control(
					'title_readmore_border_radius_hover',
					[
						'label' => esc_html__( 'Border Radius', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .product:hover .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .product:hover .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .product:hover .ws247-ea-atc-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				
			$this->end_controls_tab();
		$this->end_controls_tabs();
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
						'selector' => '{{WRAPPER}} .product',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'box_border',
						'selector' => '{{WRAPPER}} .product',
					]
				);

				$this->add_control(
					'box_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'box_align',
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
							'{{WRAPPER}} .product' => 'text-align: {{VALUE}};',
							'{{WRAPPER}} .ws247-ea-atc-wrapper' => 'text-align: {{VALUE}};',
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
						'selector' => '{{WRAPPER}} .product:hover',
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
							'{{WRAPPER}} .product:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
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

	protected function register_content_controls(){
		$this->add_control(
			'content_count_on',
			[
				'label' => esc_html__( 'Result Count', 'woocommerce' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'content_ordering_on',
			[
				'label' => esc_html__( 'Ordering', 'woocommerce' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'product_options',
			[
				'label' => esc_html__( 'Products', 'woocommerce' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'product_img_on',
			[
				'label' => esc_html__( 'Image', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'product_saleoff_on',
			[
				'label' => esc_html__( 'Sale!', 'woocommerce' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'product_title_on',
			[
				'label' => esc_html__( 'Title', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'product_rating_on',
			[
				'label' => esc_html__( 'Product ratings', 'woocommerce' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'product_price_on',
			[
				'label' => esc_html__( 'Price', 'woocommerce' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'product_atc_on',
			[
				'label' => esc_html__( 'Add to cart', 'woocommerce' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

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
			'section_onsale_style',
			[
				'label' => esc_html__( 'Sale!', 'woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_onsale_controls();

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
			'section_price_style',
			[
				'label' => esc_html__( 'Price', 'woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_price_controls();

		$this->end_controls_section();

		//----------------------
		$this->start_controls_section(
			'section_readmore_style',
			[
				'label' => esc_html__( 'Add to cart', 'woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_addtocart_controls();

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

	protected function register_tab_content_section(){
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT, //TAB_ADVANCED
			]
		);
			$this->register_content_controls();

		$this->end_controls_section();
	}

	protected function register_controls() {

		$this->register_tab_query_section();

		$this->register_tab_layout_section();

		$this->register_tab_slider_section();

		$this->register_tab_content_section();

		$this->register_tab_style_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$type = $settings['type'];
		$orderby = $settings['orderby'];
		$order = $settings['order'];
		$limit = $settings['limit'];
		$columns = $settings['columns'];
		$paginate = ($settings['paginate']==='yes') ? 'true' : 'false';
		$featured = ($settings['featured']==='yes') ? true : false; 
		$category = $settings['category'];
		$cat_operator = $settings['cat_operator'];
		$tag = $settings['tag'];
		$tag_operator = $settings['tag_operator'];

		$slider_on = ($settings['slider_on']==='yes') ? true : false;
		$slidesPerView = $settings['slidesPerView']; 
		$autoplay = (int)$settings['autoplay'];
		$slider_pagination = ($settings['slider_pagination']==='yes') ? true : false; 
		$slider_arrows = ($settings['slider_arrows']==='yes') ? true : false;

		$content_count_on = ($settings['content_count_on']==='yes') ? true : false;
		$content_ordering_on = ($settings['content_ordering_on']==='yes') ? true : false;
		$product_img_on = ($settings['product_img_on']==='yes') ? true : false;
		$product_saleoff_on = ($settings['product_saleoff_on']==='yes') ? true : false;
		$product_title_on = ($settings['product_title_on']==='yes') ? true : false;
		$product_rating_on = ($settings['product_rating_on']==='yes') ? true : false;
		$product_price_on = ($settings['product_price_on']==='yes') ? true : false;
		$product_atc_on = ($settings['product_atc_on']==='yes') ? true : false;
		

		
		$addtocart_icon = $settings['addtocart_icon'];
		$addtocart_fa = '';
		if($addtocart_icon){
			$addtocart_fa = '<i class="'.$addtocart_icon['library'].' '.$addtocart_icon['value'].'"></i>';
		}
		
		Ws247_EA_Woocommerce::woo_remove_result_count($content_count_on);
		Ws247_EA_Woocommerce::woo_remove_ordering($content_ordering_on);
		Ws247_EA_Woocommerce::woo_remove_thumbnail($product_img_on);
		Ws247_EA_Woocommerce::woo_remove_sale_flash($product_saleoff_on);
		Ws247_EA_Woocommerce::woo_remove_title($product_title_on);
		Ws247_EA_Woocommerce::woo_remove_rating($product_rating_on);
		Ws247_EA_Woocommerce::woo_remove_price($product_price_on);
		Ws247_EA_Woocommerce::woo_remove_addtocart($product_atc_on);

		$woo_shortcode = '[products ';

		if($type){
			$woo_shortcode .= $type.'="true" ';
		}

		if(!empty($category)){
			$s_category = implode($category, ', ');
			$woo_shortcode .= ' category="'.$s_category.'" ';

			if($cat_operator){
				$woo_shortcode .= ' cat_operator="'.$cat_operator.'" ';
			}
		}

		if(!empty($tag)){
			$s_tag = implode($tag, ', ');
			$woo_shortcode .= ' tag="'.$s_tag.'" ';

			if($tag_operator){
				$woo_shortcode .= ' tag_operator="'.$tag_operator.'" ';
			}
		}

		if($featured){
			$woo_shortcode .= ' visibility="featured" ';
		}

		if($slider_on){ $paginate = 'false'; }

		$woo_shortcode .= '	limit="'.$limit.'" 
							columns="'.$columns.'" 
							paginate="'.$paginate.'"
							orderby="'.$orderby.'"
							order="'.$order.'"
						]';

		$container_id = esc_html__(uniqid('wpshare247-products-container-'));
	?>
		<section id="<?php echo $container_id; ?>" class="wpshare247-elementor-addon">
			<?php echo do_shortcode($woo_shortcode); ?>
		</section>

		<?php 
		if($addtocart_fa){
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				jQuery("#<?php echo $container_id; ?> .products .ws247-ea-atc-wrapper .button").prepend('<?php echo $addtocart_fa; ?> ');
			});
		</script>
		<?php 
		}
		?>

		<?php
		if($slider_on){
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					jQuery("#<?php echo $container_id; ?> .products")
					.wrap( "<div class='wpshare247-swiper-slider swiper'></div>" );
					jQuery("#<?php echo $container_id; ?> .products").addClass('swiper-wrapper');
					jQuery("#<?php echo $container_id; ?> .products>.product").addClass('swiper-slide');

					<?php 
					 if($slider_pagination){
					 ?>

					 	jQuery("#<?php echo $container_id; ?> .products").after('<div class="swiper-pagination"></div>');
					 <?php
					 }
					?>

					<?php 
					 if($slider_arrows){
					 ?>

					 	jQuery("#<?php echo $container_id; ?> .products").after('<div class="swiper-button-prev"></div><div class="swiper-button-next"></div>');
					 <?php
					 }
					?>

					const wpshare247_swiper = new Swiper('#<?php echo $container_id;?> .swiper', {
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
		}
	}
}