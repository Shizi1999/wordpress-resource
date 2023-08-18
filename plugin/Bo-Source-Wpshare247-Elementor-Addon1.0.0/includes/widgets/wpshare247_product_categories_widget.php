<?php
class wpshare247_product_categories_widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wpshare247-get-product-categories';
	}

	public function get_title() {
		return esc_html__( 'Ws247 Woo Categories', 'wpshare247-elementor-addon' );
	}

	public function get_icon() {
		return 'eicon-product-categories';
	}

	public function get_categories() {
		return [ 'wpshare247' ];
	}

	public function get_keywords() {
		return [ 'tbay', 'wpshare247', 'product', 'category', 'list', 'query', 'grid', 'carousel', 'slider' ];
	}

	protected function register_query_controls() {
		$this->add_control(
			'category',
			[
				'label' => esc_html__( 'Categories', 'woocommerce' ),
				//'show_label' => false,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => Ws247_EA_Helper::get_term_options_id_val('product_cat', false),
				'default' => [],
			]
		);

		$this->add_control(
			'parent_id',
			[
				'label' => esc_html__( 'By parent', 'woocommerce' ),
				//'show_label' => false,
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				//'multiple' => true,
				'options' => Ws247_EA_Helper::get_term_options_id_val('product_cat', true),
				'default' => [],
			]
		);

		$this->add_control(
			'hide_empty',
			[
				'label' => esc_html__( 'Hide empty', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		$this->add_control(
				'orderby',
					[
						'label' => esc_html__( 'Order By', 'elementor' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'id',
						'options' => [
							'id' => esc_html__( 'ID', 'elementor' ),
							'slug'  => esc_html__( 'Slug', 'woocommerce' )
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

	protected function register_layout_controls() {
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
			'limit',
			[
				'label' => esc_html__( 'Limit', 'elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 20,
				'step' => 1,
				'default' => 6,
				'description' => esc_html__( '0 is unlimit', 'elementor' )
			]
		);

		$this->add_control(
			'title_show',
			[
				'label' => esc_html__( 'Title show', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'elementor' ),
				'label_off' => esc_html__( 'Off', 'elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
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


	protected function register_style_box_controls() {
		$this->add_control(
			'box_style',
			[
				'label' => esc_html__( 'Style', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 's1',
				'options' => [
					'' => esc_html__( 'Default', 'elementor' ),
					's1' => esc_html__( 'Style 1', 'elementor' ),
					's2' => esc_html__( 'Style 2', 'elementor' )
				]
			]
		);

		//box tabs
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
							'{{WRAPPER}} .product' => 'text-align: {{VALUE}};'
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

	
	protected function register_style_img_controls() {
		//image tabs
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
						'selector' => '{{WRAPPER}} .product a img',
					]
				);

				$this->add_control(
					'img_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'elementor' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'custom' ],
						'selectors' => [
							'{{WRAPPER}} .product a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .product:hover a img' => 'transform: scale({{SIZE}});',
						],
					]
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
	}

	
	protected function register_style_title_controls() {

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
							'{{WRAPPER}} .product .woocommerce-loop-category__title' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'title_style_typography',
						'selector' => '{{WRAPPER}} .product .woocommerce-loop-category__title',
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
							'{{WRAPPER}} .product:hover .woocommerce-loop-category__title' => 'color: {{VALUE}}',
						],
					]
				);
				
			$this->end_controls_tab();
		$this->end_controls_tabs();
	}



	protected function register_tab_query_section() {

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

	protected function register_tab_layout_section() {

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

	protected function register_tab_slider_section() {

		$this->start_controls_section(
			'section_slider',
			[
				'label' => esc_html__( 'Slider', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT, //TAB_ADVANCED
			]
		);
			$this->register_slider_controls();

		$this->end_controls_section();

	}

	protected function register_tab_box_section() {

		$this->start_controls_section(
			'section_style_box',
			[
				'label' => esc_html__( 'Box', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_style_box_controls();

		$this->end_controls_section();

	}

	protected function register_tab_img_section() {

		$this->start_controls_section(
			'section_style_img',
			[
				'label' => esc_html__( 'Image', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_style_img_controls();

		$this->end_controls_section();

	}

	
	protected function register_tab_title_section() {

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE, //TAB_ADVANCED
			]
		);
			$this->register_style_title_controls();

		$this->end_controls_section();

	}

	

	protected function register_controls() {

		$this->register_tab_query_section();

		$this->register_tab_layout_section();

		$this->register_tab_slider_section();

		$this->register_tab_box_section();

		$this->register_tab_img_section();

		$this->register_tab_title_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$category = $settings['category']; 
		$parent_id = $settings['parent_id'];
		$columns = $settings['columns']; 
		$hide_empty = ($settings['hide_empty']==='true') ? 1 : 0;
		$orderby = $settings['orderby'];
		$order = $settings['order']; 
		$limit = $settings['limit'];

		$slider_on = ($settings['slider_on']==='yes') ? true : false;
		$slidesPerView = $settings['slidesPerView']; 
		$autoplay = (int)$settings['autoplay'];
		$slider_pagination = ($settings['slider_pagination']==='yes') ? true : false; 
		$slider_arrows = ($settings['slider_arrows']==='yes') ? true : false;

		
		$box_style = $settings['box_style'];
		

		$title_show = ($settings['title_show']==='yes') ? true : false;
		Ws247_EA_Woocommerce::woo_remove_category_title($title_show);
		

		$woo_shortcode = '[product_categories ';

		if($parent_id){
			$woo_shortcode .= ' parent="'.$parent_id.'" ';
		}else{
			if(!empty($category)){
				$ids = implode($category, ",");
				$woo_shortcode .= ' ids="'.$ids.'" ';
			}
		}

		$woo_shortcode .= ' limit="'.$limit.'" ';
		$woo_shortcode .= ' columns="'.$columns.'" ';
		$woo_shortcode .= ' hide_empty="'.$hide_empty.'" ';
		
		$woo_shortcode .= ' orderby="'.$orderby.'" '; // id, slug, menu_order
		$woo_shortcode .= ' order="'.$order.'" ';

		$woo_shortcode .= ']';

		$container_id = esc_html__(uniqid('wpshare247-products-container-'));
	?>
		<section id="<?php echo $container_id; ?>" class="wpshare247-elementor-addon wpshare247-box<?php echo '-'.esc_html__($box_style); ?>">
			<?php echo do_shortcode($woo_shortcode); ?>
		</section>

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