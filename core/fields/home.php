<?php

use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Link;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Location;

add_action('acf/init', function() {
    register_extended_field_group([
        'title'  => 'Conteúdo',
        'fields' => [
            // Imagens Slider
            Tab::make('Seção: Imagens Slider')->placement('left'),
            Repeater::make('Imagens slider', 'imagens_slider')
                ->fields([
                    Image::make('Imagem')->required(),
                    Text::make('Texto 1'),
                    Text::make('Texto 2'),
                ])
                ->layout('row'),

            // Compromisso com a qualidade
            Tab::make('Seção: Compromisso com a qualidade')->placement('left'),
            Text::make('Subtítulo', 'subtitulo_compromisso'),
            Textarea::make('Texto', 'texto_compromisso'),

            // Destaques
            Tab::make('Seção: Destaques')->placement('left'),
            Text::make('Subtítulo', 'subtitulo_destaques'),
            Repeater::make('Destaques', 'destaques')
                ->fields([
                    Image::make('Imagem')->required(),
                    Textarea::make('Texto'),
                    Link::make('Botão'),
                ])
                ->layout('row'),

            // Nosso canal
            Tab::make('Seção: Nosso canal')->placement('left'),
            Text::make('Subtítulo', 'subtitulo_canal'),
            Repeater::make('Videos')
                ->fields([
                    Image::make('Imagem'),
                    Text::make('Link')->placeholder('http://')->required(),
                ])
                ->layout('row'),
        ],
        'location' => [
            Location::if('page', 2)
        ],
        'style'      => 'default',
        'menu_order' => 10,
        'key'        => basename(__FILE__, '.php'),
    ]);
});
