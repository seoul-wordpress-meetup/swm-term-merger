<?php
/**
 * Continy configuration file
 */

use SWPMU\TermMerger\Modules;
use SWPMU\TermMerger\Vendor\Bojaghi\Continy\Continy;
use SWPMU\TermMerger\Vendor\Psr\Container\ContainerInterface as CIFace;

if (!defined('ABSPATH')) {
    exit;
}

return [
    'main_file' => SWPMU_TERM_MERGER_MAIN,
    'version'   => SWPMU_TERM_MERGER_VERSION,

    // Hooks
    'hooks'     => [
        'admin_menu'     => 0,
        'init'           => 0,
        'plugins_loaded' => 0,
    ],

    // Binding
    'bindings'  => [
        CIFace::class        => Continy::class,
        'bojaghi/adminAjax'  => \SWPMU\TermMerger\Vendor\Bojaghi\AdminAjax\AdminAjax::class,
        'bojaghi/cpt'        => \SWPMU\TermMerger\Vendor\Bojaghi\Cpt\CustomPosts::class,
        'bojaghi/viteScript' => \SWPMU\TermMerger\Vendor\Bojaghi\ViteScripts\ViteScript::class,
        'tmgr/adminMenu'     => Modules\AdminMenu::class,
        'tmgr/ajaxHandler'   => Modules\AjaxHandler::class,
    ],

    // Arguments
    'arguments' => [
        'bojaghi/adminAjax'  => __DIR__ . '/admin-ajax.php',
        'bojaghi/cpt'        => __DIR__ . '/cpt.php',
        'bojaghi/viteScript' => __DIR__ . '/vite-script.php',
    ],

    // Modules
    'modules'   => [
        'admin_menu' => [
            Continy::PR_LAZY => [
                'tmgr/adminMenu',
            ]
        ],
        'init'       => [
            Continy::PR_DEFAULT => [
                'bojaghi/adminAjax',
                'bojaghi/cpt',
                'bojaghi/viteScript',
            ],
        ],
    ],
];
