<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/about' => [[['_route' => 'about', '_controller' => 'App\\Controller\\AboutController::index'], null, null, null, false, false, null]],
        '/admin' => [[['_route' => 'admin.property.index', '_controller' => 'App\\Controller\\Admin\\AdminPropertyController::index'], null, null, null, false, false, null]],
        '/admin/property/create' => [[['_route' => 'admin.property.new', '_controller' => 'App\\Controller\\Admin\\AdminPropertyController::new'], null, null, null, false, false, null]],
        '/contact' => [[['_route' => 'contact', '_controller' => 'App\\Controller\\ContactController::new'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'Home', '_controller' => 'App\\Controller\\HomeController::index'], null, null, null, false, false, null]],
        '/inscription' => [[['_route' => 'inscription', '_controller' => 'App\\Controller\\LoginController::new'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\LoginController::login'], null, null, null, false, false, null]],
        '/logout' => [
            [['_route' => 'app_logout', '_controller' => 'App\\Controller\\LoginController::logout'], null, null, null, false, false, null],
            [['_route' => 'logout'], null, null, null, false, false, null],
        ],
        '/offres' => [[['_route' => 'Offres', '_controller' => 'App\\Controller\\OfferController::index'], null, null, null, false, false, null]],
        '/offres/get' => [[['_route' => 'getOffer', '_controller' => 'App\\Controller\\OfferController::getOffer'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/admin/property/([^/]++)(?'
                    .'|(*:196)'
                .')'
                .'|/offres/([a-z0-9/-]*)\\.([^/]++)(*:236)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        196 => [
            [['_route' => 'admin.property.edit', '_controller' => 'App\\Controller\\Admin\\AdminPropertyController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null],
            [['_route' => 'admin.property.delete', '_controller' => 'App\\Controller\\Admin\\AdminPropertyController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        236 => [
            [['_route' => 'property.show', '_controller' => 'App\\Controller\\OfferController::show'], ['slug', 'id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
