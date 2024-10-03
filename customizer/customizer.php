<?php

function custom_theme_customizer($wp_customize)
{
    $wp_customize->add_section(
        'theme_settings_section',
        array(
            'title' => 'Ustawienia ogólne',
            'priority' => 30,
        )
    );

    $wp_customize->add_setting(
        'custom_logo',
        array(
            'default' => '',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'custom_logo',
            array(
                'label' => 'Wgraj nowe logo',
                'section' => 'theme_settings_section',
                'settings' => 'custom_logo',
            )
        )
    );

    $wp_customize->add_setting(
        'phone_number',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'phone_number',
        array(
            'label' => 'Numer telefonu',
            'section' => 'theme_settings_section',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'email_address',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'email_address',
        array(
            'label' => 'Adres email',
            'section' => 'theme_settings_section',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'address',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'address',
        array(
            'label' => 'Adres schroniska',
            'section' => 'theme_settings_section',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'bank_account_number',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'bank_account_number',
        array(
            'label' => 'Numer konta bankowego',
            'section' => 'theme_settings_section',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'instagram_url',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'instagram_url',
        array(
            'label' => 'Instagram schroniska',
            'section' => 'theme_settings_section',
            'type' => 'text',
        )
    );

    $wp_customize->add_setting(
        'facebook_url',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'facebook_url',
        array(
            'label' => 'Facebook schroniska',
            'section' => 'theme_settings_section',
            'type' => 'text',
        )
    );

    $wp_customize->add_control(
        'volunteer_phone_number',
        array(
            'label' => 'Numer telefonu do wolontariusza',
            'section' => 'theme_settings_section',
            'type' => 'text',
        ),
    );

    $wp_customize->add_setting(
        'volunteer_phone_number',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ),
    );
}

add_action('customize_register', 'custom_theme_customizer');