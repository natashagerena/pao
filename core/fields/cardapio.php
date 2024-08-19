<?php

use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\File;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\RadioButton;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Location;

add_action('acf/init', function() {
    register_extended_field_group([
        'title'  => 'Cardápio',
        'fields' => [
            Text::make('Subtítulo', 'subtitulo_cardapio'),
            Repeater::make('Cardápio')
                ->fields([
                    Text::make('Categoria')->required(),
                    // Iitens
                    Repeater::make('Itens')
                        ->fields([
                            RadioButton::make('Pedido rápido')
                                ->choices(['Não', 'Sim']),
                            Text::make('Código'),
                            Text::make('Nome'),
                            Text::make('Preço'),
                        ]),

                    // Fotos
                    Repeater::make('Fotos')
                        ->fields([
                            Image::make('Foto')->required()
                        ])
                        ->layout('row'),
                ])
                ->layout('row'),
            Textarea::make('Legenda', 'legenda_cardapio'),
            File::make('Arquivo cardápio', 'arquivo_cardapio'),
        ],
        'location' => [
            Location::if('page', 13),
        ],
        'style'          => 'default',
        'menu_order'     => 10,
        'hide_on_screen' => ['the_content'],
        'key'            => basename(__FILE__, '.php'),
    ]);
});
