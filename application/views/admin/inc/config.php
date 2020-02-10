<?php
/**
 * config.php
 */

/* Template variables */
$template = array(
   'name'              => 'CelosiaDesigns',
    'version'           => '1.0',
    'author'            => 'celosiadesings',
    'robots'            => 'noindex, nofollow',
    'title'             => 'Nyokas CallCenter Panel',
    'description'       => 'Nyokas CallCenter Panel, Powered by CelosiaDesigns',
    // true                         enable page preloader
    // false                        disable page preloader
    'page_preloader'    => true,
    // 'navbar-default'             for a light header
    // 'navbar-inverse'             for a dark header
    'header_navbar'     => 'navbar-inverse',
    // ''                           empty for a static header/main sidebar
    // 'navbar-fixed-top'           for a top fixed header/sidebars
    // 'navbar-fixed-bottom'        for a bottom fixed header/sidebars
    'header'            => 'navbar-fixed-top',
    // ''                           empty for the default full width layout
    // 'fixed-width'                for a fixed width layout (can only be used with a static header/main sidebar)
    'layout'            => '',
    // 'sidebar-visible-lg-mini'    main sidebar condensed - Mini Navigation (> 991px)
    // 'sidebar-visible-lg-full'    main sidebar full - Full Navigation (> 991px)
    // 'sidebar-alt-visible-lg'     alternative sidebar visible by default (> 991px) (You can add it along with another class - leaving a space between)
    // 'sidebar-light'              for a light main sidebar (You can add it along with another class - leaving a space between)
    'sidebar'           => 'sidebar-visible-lg-full',
    // ''                           Disable cookies (best for setting an active color theme from the next variable)
    // 'enable-cookies'             Enables cookies for remembering active color theme when changed from the sidebar links (the next color theme variable will be ignored)
    'cookies'           => '',
    // '', 'classy', 'social', 'flat', 'amethyst', 'creme', 'passion'
    'theme'             => '',
    // Used as the text for the header link - You can set a value in each page if you like to enable it in the header
    'header_link'       => '',
    // The name of the files in the inc/ folder to be included in page_head.php - Can be changed per page if you
    // would like to have a different file included (eg a different alternative sidebar)
    'inc_sidebar'       => 'page_sidebar',
    'inc_sidebar_alt'   => 'page_sidebar_alt',
    'inc_header'        => 'page_header',
    // The following variable is used for setting the active link in the sidebar menu
    'active_page'       => basename($_SERVER['PHP_SELF'])
);

/* Primary navigation array (the primary navigation will be created automatically based on this array, up to 3 levels deep) */
$userdata = $this->session->userdata('userdata');
if($userdata['userlevel'] == 2){
    $primary_nav = array(
        array(
            'name'  => 'Dashboard',
            'url'   => base_url('panel/index'),
            'icon'  => 'gi gi-compass'
        ),
        array(
            'url'   => 'separator',
        ),
        array(
            'name'  => 'Stocks',
            'url'   => base_url('panel/stocks'),
            'icon'  => 'fa fa-rocket'
        ),
        array(
            'name'  => 'Purchases',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'View',
                    'url'   => base_url("panel/purchases"),
                ),
                array(
                    'name'  => 'Add New',
                    'url'   => base_url("panel/purchase"),
                )
            )
        ),
        
        array(
            'name'  => 'Sales',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'View',
                    'url'   => base_url("panel/sales"),
                ),
                array(
                    'name'  => 'Add New',
                    'url'   => base_url("panel/sale"),
                )
            )
        ),
        
        array(
            'name'  => 'Old Stocks Entry',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'View',
                    'url'   => base_url("panel/oldStocks"),
                ),
                array(
                    'name'  => 'Add New',
                    'url'   => base_url("panel/oldStock"),
                )
            )
        ),
        
        array(
            'name'  => 'Complains',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'Pending',
                    'url'   => base_url("panel/complains"),
                ),
                array(
                    'name'  => 'Completed',
                    'url'   => base_url("panel/complains"),
                ),
                array(
                    'name'  => 'Deactivated',
                    'url'   => base_url("panel/complains"),
                ),
                array(
                    'name'  => 'Add New',
                    'url'   => base_url("panel/new_complain"),
                ),
                array(
                    'name'  => 'New Complain',
                    'url'   => base_url("panel/new_complain"),
                )
            )
        ),
        
        array(
            'name'  => 'Open Complains',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'Quick',
                    'url'   => base_url("panel/quick_open_complain"),
                ),
                array(
                    'name'  => 'Detailed',
                    'url'   => base_url("panel/detailed_open_complain"),
                )
            )
        ),
        
        array(
            'name'  => 'Clients',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'View',
                    'url'   => base_url("panel/clients"),
                ),
                array(
                    'name'  => 'Add New',
                    'url'   => base_url("panel/client"),
                )
            )
        ),
        
        array(
            'name'  => 'Prospects',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'View',
                    'url'   => base_url("panel/prospects"),
                ),
                array(
                    'name'  => 'Add New',
                    'url'   => base_url("panel/prospect"),
                )
            )
        ),
        
        array(
            'name'  => 'Settings',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'Product Types',
                    'url'   => base_url("setting/product_types"),
                ),
                array(
                    'name'  => 'Product Models',
                    'url'   => base_url("setting/product_models"),
                ),
                array(
                    'name'  => 'Loadshedding Group',
                    'url'   => base_url("setting/loadshedding_group"),
                )
            )
        ),
        
        array(
            'name'  => 'Sign Out',
            'icon'  => 'fa fa-rocket',
            'url'   => base_url("user/signOut")
        )
    );
}elseif($userdata['userlevel'] == 3){
    $primary_nav = array(
        array(
            'name'  => 'Dashboard',
            'url'   => base_url('panel/index'),
            'icon'  => 'gi gi-compass'
        ),
        array(
            'name'  => 'Calls',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'Call entry',
                    'url'   => base_url("panel/call/"),
                ),
                array(
                    'name'  => 'View Active Calls',
                    'url'   => base_url("panel/calls"),
                ),
                array(
                    'name'  => 'View Calls History',
                    'url'   => base_url("panel/calls_report"),
                )
            )
        ),
        
        array(
            'name'  => 'Complains',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'Pending',
                    'url'   => base_url("panel/complains"),
                ),
                array(
                    'name'  => 'Completed',
                    'url'   => base_url("panel/completed_complains"),
                ),
                array(
                    'name'  => 'Deactivated',
                    'url'   => base_url("panel/deactivated_complains"),
                ),
                array(
                    'name'  => 'Add New',
                    'url'   => base_url("panel/new_complain"),
                )
            )
        ),
        // array(
        //     'name'  => 'Re-opened',
        //     'url'   => base_url('panel/index'),
        //     'icon'  => 'fa fa-rocket'
        // ),
        array(
            'name'  => 'Clients',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'View',
                    'url'   => base_url("panel/clients"),
                ),
                array(
                    'name'  => 'Add New',
                    'url'   => base_url("panel/client"),
                )
            )
        ),
        array(
            'name'  => 'Account Request',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'New',
                    'url'   => base_url("account/new_request"),
                ),
                // array(
                //     'name'  => 'Add New',
                //     'url'   => base_url("panel/client"),
                // )
            )
        ),
        array(
            'name'  => 'Settings',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                
                // array(
                //     'name'  => 'Product Models',
                //     'url'   => base_url("setting/productModels"),
                // ),
                array(
                    'name'  => 'Brand',
                    'url'   => base_url("setting/property_brand"),
                ),
                array(
                    'name'  => 'AC Types',
                    'url'   => base_url("setting/ac_types"),
                ),array(
                    'name'  => 'Employees',
                    'url'   => base_url("setting/employees"),
                ),
                array(
                    'name'  => 'Loadshedding Group',
                    'url'   => base_url("setting/loadshedding_group"),
                )
                
            )
        ),
        array(
            'name'  => 'Old Stocks Entry',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'View',
                    'url'   => base_url("stock/oldStocks"),
                ),
                array(
                    'name'  => 'Add New',
                    'url'   => base_url("stock/oldStock"),
                )
            )
        ),
        array(
            'name'  => 'Accounting',
            'icon'  => 'fa fa-rocket',
            'sub'   => array(
                array(
                    'name'  => 'DB Entry',
                    'url'   => base_url("accounting/db_entry"),
                ),
                array(
                    'name'  => 'DB Summary',
                    'url'   => base_url("accounting/db_summary"),
                ),
                array(
                    'name'  => 'Account Head',
                    'url'   => base_url("accounting/account_head"),
                )
            )
        ),
        
    );
}