<?php

use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Link;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Location;

add_action('acf/init', function() {
    register_extended_field_group([
        'title'  => 'Banners',
        'fields' => [
            Repeater::make('Fotos')
                ->fields([
                    Image::make('Foto')->required(),
                ])
                ->layout('row'),
        ],
        'location' => [
            Location::if('page', 2),
            Location::if('page', 13),
            Location::if('page', 14),
            Location::if('page', 15)
        ],
        'style'          => 'default',
        'menu_order'     => 10,
        'hide_on_screen' => ['the_content'],
        'key'            => basename(__FILE__, '.php'),
    ]);
});
