<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'menu' => [
 
        [
		'icon' => 'fa fa-th-large',
		'title' => 'Dashboard',
		'url' => 'javascript:;',
		'caret' => true,

		'sub_menu' => [[
			'url' => '/dashboard',
			'title' => 'My Dashboard',
		
		],[
			'url' => '/hrr/admin',
			'title' => 'Admin Dashboard',
			'permission' => 'admin.menu',
		]]
	],
	[
		'icon' => 'fa fa-lock',
    		'title' => 'Administration',
		'url' => 'javascript:;',
		'caret' => true,
		'permission' => 'admin.menu',
		'sub_menu' => [[
			'url' => '/administration',
			'title' => 'Daily Statistics',
			'permission' => 'admin.menu',
		],[
			'url' => '/unitreview',
			'title' => 'Camera Review',
			'permission' => 'admin.menu',
		],
		[
			'url' => '/scholarship',
			'title' => 'EMT Scholarships',
			'permission' => 'view.eduadmin',
		]]
	],[
		'icon' => 'fa fa-lock',
    		'title' => 'Asset Management',
		'url' => 'javascript:;',
		'caret' => true,
		'permission' => 'admin.menu',
		'sub_menu' => [[
			'url' => '/assetDashboard',
			'title' => 'Asset Table',
			'permission' => 'admin.menu',
		],[
			'url' => '/supportTickets',
			'title' => 'Support Tickets',
			'permission' => 'admin.menu',
		]]
	],[
		'icon' => 'fa fa-money',
    		'title' => 'Billing',
		'url' => 'javascript:;',
		'caret' => true,
		'permission' => 'view.badrunsheets',
		'sub_menu' => [[
			'url' => '/badrunsheets',
			'title' => 'Bad Run Sheet List',
			'permission' => 'view.badrunsheets',
		],[
			'url' => '/patient/dashboard',
			'title' => 'Dashboard',
			'permission' => 'view.badrunsheets',
		],[
			'url' => '/patients',
			'title' => 'Patients List',
			'permission' => 'view.badrunsheets',
		]]
	],[
		'icon' => 'fas fa-users',
    		'title' => 'Employees',
		'url' => 'javascript:;',
		'caret' => true,
		'permission' => 'view.employees',
		'sub_menu' => [[
			'url' => '/employees',
			'title' => 'Active Employees',
			'permission' => 'view.employees',
		]]
	],[
		'icon' => 'fas fa-car-mechanic',
    		'title' => 'Company Online Forms',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/mvc/create',
			'title' => 'Crash Report'
		],[
			'url' => '/incidentreport',
			'title' => 'Incident Report'
		],[
			'url' => '/incidentreport',
			'title' => 'Improper Transport'
		],[
			'url' => '/maintanance/create',
			'title' => 'Vehicle Maintanance Request'
		]]
	],
	[
		'icon' => 'far fa-bomb',
    		'title' => 'Compliance',
		'url' => 'javascript:;',
		'caret' => true,
		'permission' => 'menu.compliance',
		'sub_menu' => [[
			'url' => '/compliance',
			'title' => 'Compliance Dashboard',
			'permission' => 'view.employees',
		],
		[
			'url' => '/attend/list',
			'title' => 'Attendance List',
			'permission' => 'view.attend',
		],
		[
			'url' => '#',
			'title' => 'Add New Policy',
			'permission' => 'add.plicy',
		],
		[
			'url' => '/unitreview',
			'title' => 'Camera Review',
			'permission' => 'menu.compliance',
		],
		[
			'url' => '/policies',
			'title' => 'Policy List',
			'permission' => 'view.policies',
		]]
	],
	[
		'icon' => 'far fa-cars',
    		'title' => 'Dispatch',
		'url' => 'javascript:;',
		'caret' => true,
		'permission' => 'menu.compliance',
		'sub_menu' => [[
			'url' => '/dispatch/units',
			'title' => 'Unit Screen',
			'permission' => 'admin.menu',
		],
		[
			'url' => '/dispatch/active',
			'title' => 'Active Incidents',
			'permission' => 'admin.menu',
		],
		[
			'url' => '/dispatch/pending',
			'title' => 'Pending Incidents',
			'permission' => 'admin.menu',
		],
		[
			'url' => '/patients',
			'title' => 'Patient List',
			'permission' => 'admin.menu',
		]]
	],[
		'icon' => 'fas fa-book',
    		'title' => 'Education',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/courses',
			'title' => 'Available Courses',
		],
		[
			'url' => '/cprclasses',
			'title' => 'CPR Classes',
			'permission' => 'view.cpr',
		],
		[
			'url' => '/classes',
			'title' => 'Instructed Classes',
			'permission' => 'view.classes',
		],
		[
			'url' => '/qaqi',
			'title' => 'PCR Quality Assurance',
			'permission' => 'view.qa',
		]]
	],[
		'icon' => 'fa fa-th-large',
		'title' => 'Logistics',
		'url' => 'javascript:;',
		'caret' => true,

		'sub_menu' => [[
			'url' => '/logistics',
			'title' => 'My Dashboard',
			'permission' => 'logistics'
		
		],[
			'url' => '/logistic.overview',
			'title' => 'Overview',
			'permission' => 'logistics',
		],[
			'url' => '/units',
			'title' => 'Unit Management',
			'permission' => 'logistics',
		]]
	],[
            'icon' => 'fas fa-bone-break',
            'title' => 'Risk Management',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [[
                'url' => '/covid',
                'title' => 'Covid Exposure'
            ]]
        ],[
		'icon' => 'fas fa-warehouse',
		'title' => 'Garage',
		'url' => 'javascript:;',
		'caret' => true,
        'permission' => 'users.manage',
		'sub_menu' => [[
			'url' => '/mechanic',
			'title' => 'Task Dashboard',
			'permission' => 'mechanic'
		
		],[
			'url' => '/garage/mechanic/dashboard',
			'title' => 'Mechanic Dashboard',
			'permission' => 'mechanic'
		
		],[
			'url' => 'javascript:;',
			'title' => 'Parts Inventory',
			'permission' => 'mechanic',
			'sub_menu' => [[
					'url' => 'javascript:;',
					'title' => 'Parts Inventory',
				],[
					'url' => 'javascript:;',
					'title' => 'Part Vendors'
				],[
					'url' => 'javascript:;',
					'title' => 'Part Locations'
				],[
					'url' => '/garage/available_parts',
					'title' => 'Available Parts'
				]]
		
		],]
	],[
		'icon' => 'fal fa-shipping-timed',
		'title' => 'Bucyrus',
		'url' => 'javascript:;',
		'caret' => true,
        'permission' => '',
		'sub_menu' => [[
			'url' => '/buc/list',
			'title' => 'Run Log',
			'permission' => ''
		
		],[
			'url' => '/bucyrus/create',
			'title' => 'Add New Incident',
			'permission' => ''
		
		]]
	],[
		'icon' => 'fa fa-th-large',
		'title' => 'Users',
		'url' => 'javascript:;',
		'caret' => true,
        'permission' => 'bucyrus',
		'sub_menu' => [[
			'url' => '/user',
			'title' => 'User List',
			'permission' => 'bucyrus'
		
		]]
	],
	
	
	]
];
