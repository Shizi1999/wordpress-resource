<?php
$section_id = basename(__FILE__, ".php"); // auto create ID, you can name too
$arr_section[ $section_id ] = 
	array(
			'title' => __( 'Tên tab 1', OPTIONS_TEXTDOMAIN ),
			'description' => __( 'Mô tả tab', OPTIONS_TEXTDOMAIN ),
			'fields' => array(
								//only declare array fields here............./
								
								// Text
								array(  'id' => 'demo_text',
										'type' => 'text',
										'label' => 'Text box',
										'default' => '',
										'placeholder' => 'Enter your value here',
										'note' => 'Your note here......'
									),
								
								// Select
								array(  'id' => 'demo_select',
										'type' => 'select',
										'label' => 'Select',
										'options' => array('0'=>'--Select--', '1'=>'Val 1', '2'=>'Val 2'),
										'default' => '1',
										'note' => 'Your note here......'
									),
								
								// Textarea
								array(  'id' => 'demo_textarea',
										'type' => 'textarea',
										'rows' => 5,
										'label' => 'Textarea',
										'default' => 'Your default',
										'placeholder' => 'Enter your value here',
										'note' => 'Your note here......'
									),
								
								// Check Box 1
								array(  'id' => 'demo_check_one',
										'type' => 'checkbox',
										'label' => 'Checkbox',
										'default' => '1'
									),
								
								// Check Box Many
								array(  'id' => 'demo_check_many',
										'type' => 'checkbox_many',
										'label' => 'Checkbox (Many)',
										'options' => array(	//'Checkbox 1' => 1, { 1 =>checked ; else 0 }
															'Checkbox 1' => 1, 
															'Checkbox 8' => 1, 
															'Checkbox 6' => 1, 
															'Checkbox 22' => 1, 
															'Checkbox 4' => 0,
															'Checkbox 400' => 1,
															'Checkbox 100' => 1,
															'Checkbox 7' => 0, 
															'Checkbox 105' => 1, 
															'Checkbox 9' => 1,
															'Checkbox 12' => 0, 
															'Checkbox 20' => 0, 
															'Checkbox 5' => 0,
															)
									),
									
									array(  'id' => 'demo_check_many_2',
										'type' => 'checkbox_many',
										'label' => 'Do you like country?',
										'options' => array(	//'Checkbox 1' => 1, { 1 =>checked ; else 0 }
															'Việt Nam' => 1, 
															'Thái Lan' => 0,
															'Ấn độ' => 0, 
															'Hồng Kong' => 1 
															)
									),
								
								// Radio
								array(  'id' => 'demo_radio',
										'type' => 'radio',
										'label' => 'Radio',
										'options' => array(	'Việt Nam' => 0, 
															'Thái Lan' => 0,
															'Ấn độ' => 1, 
															'Hồng Kong' => 0  
															)
									),
								
								// Color Picker
								array(  'id' => 'demo_color_picker',
										'type' => 'color-picker',
										'label' => 'Color Picker',
										'default' => '#fff',
										'note' => 'Your note here......'
									),
								
								// Image: is_multiple = true 
								array(  'id' => 'demo_image_single',
										'type' => 'image',
										'is_multiple' => false,
										'hide_attribute' => false,
										'label' => 'Images (Single)',
										'default' => '',
										'note' => 'Your note here......',
										'btn_text' => 'Chọn hình',
										'media_upload_title' => 'Select or Upload Media Of Your Chosen Persuasion',
										'media_upload_btn_text' => 'Use this media',
										'no_photo_text' => 'No photos. Please click below button to upload photo'
									),
									
								// Image: is_multiple = true 
								array(  'id' => 'demo_image',
										'type' => 'image',
										'is_multiple' => true,
										'hide_attribute' => false,
										'label' => 'Images (Multiple)',
										'default' => '',
										'note' => 'Your note here......',
										'btn_text' => 'Chọn hình',
										'media_upload_title' => 'Select or Upload Media Of Your Chosen Persuasion',
										'media_upload_btn_text' => 'Use this media',
										'no_photo_text' => 'No photos. Please click below button to upload photo'
									),
								array(  'id' => 'demo_slider',
										'type' => 'slider',
										'attribute_placeholder' => array( 	'link'=>'Href http://', 
																			'desciption'=>'Desciption',
																			'target'=>'Open new tab'
																	),
										'label' => 'Top Slider',
										'default' => '',
										'note' => '',
										'btn_text' => 'Add slide',
										'media_upload_title' => 'Select or Upload Media Of Your Chosen Persuasion',
										'media_upload_btn_text' => 'Use this media',
										'no_photo_text' => 'No photos. Please click below button to upload photo'
									),
									
								// Editor
								array(  'id' => 'demo_editor',
										'type' => 'editor',
										'label' => 'Editor',
										'height' => '',
										'default' => 'Your default content',
										'note' => 'Your note here......'
									),
								
							)
		);
