<?php


/*
|--------------------------------------------------------------------------
| MENUS SIDEBAR
|--------------------------------------------------------------------------
*/

return [
    'menu' => [

        [
            'text'  => 'Dashboard',
            'route' => 'dashboard.index',
            'icon'  => 'fa-home',
            'can'   => false,
        ],

        [
            'text'  => 'Chamados',
            'route' => 'supports.index',
            'icon'  => 'fa-receipt',
            'can'   => 'supports',
        ],

        [
            'text'  => 'Categorias',
            'route' => 'categories.index',
            'icon'  => 'fa-layer-group',
            'can'   => 'categories',
        ],

        [
            'text'  => 'Localidades',
            'route' => 'places.index',
            'icon'  => 'fa-map-marker-alt',
            'can'   => 'places',
        ],

        [
            'text'  => 'Departamentos',
            'route' => 'departments.index',
            'icon'  => 'fa-chair-office',
            'can'   => 'departments',
        ],

        [
            'text'  => 'Usuários',
            'route' => 'users.index',
            'icon'  => 'fa-users',
            'can'   => 'users',
        ],

        [
            'text'  => 'Configurações',
            'route' => 'settings.index',
            'icon'  => 'fa-cogs',
            'can'   => 'settings',
        ],
    ]
];
