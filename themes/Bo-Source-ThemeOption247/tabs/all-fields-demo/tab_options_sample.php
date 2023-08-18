<?php
$section_id = basename(__FILE__, ".php"); // auto create ID, you can name too
$arr_section[ $section_id ] = 
	array(
			'title' => __( 'Tên tab 1', OPTIONS_TEXTDOMAIN ),
			'description' => __( 'Mô tả tab', OPTIONS_TEXTDOMAIN ),
			'fields' => array(
								//only declare array fields here............./
								/*
									array(  'id' => 'demo_field_1',
											'type' => 'text',
											'label' => __( 'Field 1', OPTIONS_TEXTDOMAIN ),
											'default' => '',
											'placeholder' => __( 'htpps://', OPTIONS_TEXTDOMAIN ),
											'note' => ''
										),
									array(  'id' => 'demo_field_2',
											'type' => 'text',
											'label' => __( 'Field 2', OPTIONS_TEXTDOMAIN ),
											'default' => '',
											'placeholder' => __( 'htpps://', OPTIONS_TEXTDOMAIN ),
											'note' => ''
										),
								*/
								
							)
		);
