<?php

use function Termwind\render;

return [
    [
        'icon'=>'nav-icon fas fa-tachometer-alt',
        'route'=>'dashboard',
        'title'=>'Dashboard',
        'active'=>'dashboard'
    ],
    [
        'icon'=>'far fa-circle nav-icon',
        'route'=>'dashboard.categories.index',
        'title'=>'Categories',
        'badge'=>'New',
        'active'=>'dashboard.categories.*'
    ],
    [
        'icon'=>'far fa-circle nav-icon',
        'route'=>'dashboard.products.index',
        'title'=>'Products',
        'badge'=>'New',
        'active'=>'dashboard.products.*'
    ],
    [
        'icon'=>'far fa-circle nav-icon',
        'route'=>'dashboard.categories.index',
        'title'=>'Orders',
        'badge'=>'New',
        'active'=>'dashboard.orders.*'
    ],
];
