<?php

use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Location;

add_action('acf/init', function() {
    register_extended_field_group([
        'title'  => 'Produtos',
        'fields' => [
            Repeater::make('Produtos')
                ->fields([
                    Image::make('Foto')->required(),
                    Textarea::make('Nome')->required(),
                    Text::make('Tipo')->required(),
                    Text::make('Quantidade')->required(),
                    Textarea::make('Descrição')->required(),
                ])
                ->layout('row'),
        ],
        'location' => [
            Location::if('page', 14),
        ],
        'style'          => 'default',
        'menu_order'     => 10,
        'hide_on_screen' => ['the_content'],
        'key'            => basename(__FILE__, '.php'),
    ]);
});
