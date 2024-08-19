<?php

use WordPlate\Acf\Fields\GoogleMap;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Select;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\TrueFalse;

add_action('acf/init', function() {
    register_extended_field_group([
        'title' => 'Opções',
        'fields' => [
            // Analytics
            Tab::make('Analytics')->placement('left'),
            Text::make('Google Analytics', 'google_analytics'),
            Text::make('Google Tag Manager', 'google_gtm'),
            Text::make('Pixel Facebook', 'pixel_facebook'),

            // Aparencia
            Tab::make('Aparência')->placement('left'),
            Image::make('Logo branco', 'logo_branco')->library('uploadedTo')->returnFormat('url'),
            Image::make('Logo preto', 'logo_preto')->library('uploadedTo')->returnFormat('url'),
            Image::make('Favicon')->library('uploadedTo')->returnFormat('url'),

            // Contato
            Tab::make('Contato')->placement('left'),
            Text::make('WhatsApp', 'whatsapp')->placeholder('(xx) xxxxx-xxxx'),
            TrueFalse::make('Botão flutuante'),
            Textarea::make('Endereço', 'endereco'),

            // Redes sociais
            Tab::make('Redes sociais', 'tab_redes')->placement('left'),
            Repeater::make('Redes sociais', 'redes_sociais')
                ->fields([
                    Select::make('Nome')
                        ->choices([
                            'facebook' => 'Facebook',
                            'instagram' => 'Instagram',
                            'linkedin' => 'LinkedIn',
                            'twitter' => 'Twitter',
                            'youtube' => 'YouTube',
                        ]),
                    Text::make('Link')->placeholder('https://')->required(),
                    Text::make('Rótulo', 'rotulo')->required()
                ]),

            // SEO
            Tab::make('SEO')->placement('left'),
            Textarea::make('Descrição', 'meta_description')->rows(3)->characterLimit(160),
            Image::make('Imagem', 'meta_imagem')->library('uploadedTo')->returnFormat('url')
        ],
        'location' => [
            Location::if('options_page', 'acf-options')
        ],
        'style' => 'default',
        'menu_order' => 10,
    ]);
});
