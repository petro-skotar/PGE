<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Модули сайта
    |--------------------------------------------------------------------------
    |
    | Список модулей, он же список меню в админке
	| Иконки взяты отсюда https://fontawesome.com/v5/search?o=r&m=free
    |
    */

	# Настройки модулей
	'modules' => [
		'articles' => [
			'name'=>'Site structure',
			'controller'=>'ArticlesController',
			'class-icon'=>'fas fa-list',
			'active'=>1,
			'display'=> 1,
			'module' => 'articles',
			'title' => 'Articles',
			'add_button' => 'New article',
			'list_pages' => 'List of articles',
			'fields' => [
				'name'=> [
					'title' => 'Name',
					'placeholder' => 'Tag &lt;H1&gt;',
				],
				'content'=> [
					'title' => 'Description',
				],
				'images'=> [
					'title' => 'Photo',
				],
			],
		],
		/*'team' => [
			'name'=>'Zespół',
			'controller'=>'ArticlesController',
			'class-icon'=>'fas fa-users',
			'active'=>1,
			'display'=> 1,
			'module' => 'team',
			'title' => 'Zespół',
			'add_button' => 'Добавить сотрудника',
			'list_pages' => 'Список сотрудников',
			'fields' => [
				'name'=> [
					'title' => 'Name',
					'placeholder' => '',
				],
				'content'=> [
					'title' => 'Description',
				],
				'images'=> [
					'title' => 'Photo',
				],
			],
		],*/
		'projects' => [
			'name'=>'Our projects',
			'controller'=>'ArticlesController',
			'class-icon'=>'fas fa-store-alt',
			'active'=>1,
			'display'=> 1,
			'module' => 'projects',
			'title' => 'Our projects',
			'add_button' => 'New project',
			'list_pages' => 'List of projects',
			'fields' => [
				'name'=> [
					'title' => 'Name',
					'placeholder' => 'Tag &lt;H1&gt;',
				],
				'content'=> [
					'title' => 'Description',
				],
				'images'=> [
					'title' => 'Photo',
				],
			],
		],
		'blog' => [
			'name'=>'Blog',
			'controller'=>'ArticlesController',
			'class-icon'=>'fas fa-blog',
			'active'=>1,
			'display'=> 1,
			'module' => 'blog',
			'title' => 'Blog',
			'add_button' => 'Create post',
			'list_pages' => 'List of posts',
			'fields' => [
				'name'=> [
					'title' => 'Name',
					'placeholder' => 'Tag &lt;H1&gt;',
				],
				'content'=> [
					'title' => 'Description',
				],
				'images'=> [
					'title' => 'Photo',
				],
			],
		],
		/*'services' => [
			'name'=>'services',
			'controller'=>'ArticlesController',
			'class-icon'=>'fas fa-briefcase',
			'active'=>1,
			'display'=> 1,
			'module' => 'services',
			'title' => 'services',
			'add_button' => 'Create post',
			'list_pages' => 'List of posts',
			'fields' => [
				'name'=> [
					'title' => 'Name',
					'placeholder' => 'Tag &lt;H1&gt;',
				],
				'content'=> [
					'title' => 'Description',
				],
				'images'=> [
					'title' => 'Photo',
				],
			],
		],*/
		/*'subscribe' => [
			'name'=>'Subscribers',
			'controller'=>'SubscribeController',
			'class-icon'=>'fa fa-envelope',
			'active'=>1,
			'display'=> 1,
			'module' => 'subscribe',
			'title' => 'Subscribers',
			'add_button' => 'Add',
			'list_pages' => 'ListList of emails',
		],*/
		/*'faq' => [
			'name'=>'FAQ',
			'controller'=>'ArticlesController',
			'class-icon'=>'fas fa-question-circle',
			'active'=>1,
			'display'=> 1,
			'module' => 'faq',
			'title' => 'FAQ',
			'add_button' => 'Создать вопрос',
			'list_pages' => 'Список вопросов',
			'fields' => [
				'name'=> [
					'title' => 'Вопрос',
				],
				'content'=> [
					'title' => 'Ответ',
				],
			],
		],
		'benefits' => [
			'name'=>'Преимущества',
			'controller'=>'ArticlesController',
			'class-icon'=>'fas fa-medal',
			'active'=>1,
			'display'=> 1,
			'module' => 'benefits',
			'title' => 'Преимущества',
			'add_button' => 'Создать новое преимущество',
			'list_pages' => 'Список преимуществ',
			'fields' => [
				'name'=> [
					'title' => 'Преимущество',
				],
				'content'=> [
					'title' => 'Description',
				],
			],
		],*/
		'sections' => [
			'name'=>'Static content',
			'controller'=>'ArticlesController',
			'class-icon'=>'fab fa-hive',
			'active'=>1,
			'display'=> 1,
			'module' => 'sections',
			'title' => 'Static content',
			'add_button' => 'Add',
			'list_pages' => 'List of sections',
			'categories' => [
				11 => [
					'templates' => ['main'],
					'fields' => [
						'name'=> [
							'title' => 'Name',
						],
					],
					'sub_fields' => [
						'name'=> [
							'title' => 'Title',
							'placeholder' => 'May contain Tags',
						],
						'annotation'=> [
							'title' => 'Small description',
						],
						'content'=> [
							'title' => 'Description',
						],
						'images'=> [
							'title' => 'Photo',
						],
					],
				],
				15 => [
					'templates' => ['main'],
					'fields' => [
						'name'=> [
							'title' => 'Name',
						],
					],
					'sub_fields' => [
						'name'=> [
							'title' => 'Name',
							'placeholder' => 'May contain Tags',
						],
						'annotation'=> [
							'title' => 'Description',
						],
						'images'=> [
							'title' => 'Photo',
						],
					],
				],
				21 => [
					'templates' => ['main'],
					'fields' => [
						'name'=> [
							'title' => 'Name',
						],
					],
					'sub_fields' => [
						'name'=> [
							'title' => 'Name',
							'placeholder' => 'May contain Tags',
						],
						'annotation'=> [
							'title' => 'Description',
						],
						'images'=> [
							'title' => 'Photo',
						],
					],
				],
				28 => [
					'templates' => ['main'],
					'fields' => [
						'name'=> [
							'title' => 'Name',
						],
						'images'=> [
							'title' => 'Photo',
						],
					],
				],
				29 => [
					'templates' => ['main', 'offer_for_investor'],
					'fields' => [
						'name'=> [
							'title' => 'Name',
						],
					],
					'sub_fields' => [
						'name'=> [
							'title' => 'File name',
						],
						'files'=> [
							'title' => 'File',
						],
					],
				],
				31 => [
					'templates' => ['*'],
					'fields' => [
						'name'=> [
							'title' => 'Name',
						],
					],
					'sub_fields' => [
						'name'=> [
							'title' => 'Title',
							'placeholder' => 'May contain Tags &lt;span&gt;, &lt;br&gt;, &lt;sup&gt;',
						],
						'annotation'=> [
							'title' => 'Small description',
						],
						'content'=> [
							'title' => 'Description',
						],
						'images'=> [
							'title' => 'Photo',
						],
					],
				],

			],
		],
        'config' => [
			'name'=>'Site settings',
			'class-icon'=>'fas fa-cogs',
			'active'=>1,
			'display'=> 1,
			'sub'=>[
				'managers' => [
					'name'=>'Administrators',
					'controller'=>'ManagersController',
					'class-icon'=>'far fa-user',
					'active'=>1,
					'display'=> 1
				],
				'roles' => [
					'name'=>'User Roles',
					'controller'=>'RolesController',
					'class-icon'=>'fa fa-tasks',
					'active'=>1,
					'display'=> 1
				],
				'setting' => [
					'name'=>'Other settings',
					'class-icon'=>'fas fa-cog',
					'active'=>1,
					'display'=> 1
				],
			],
		],
    ],
	# Другие настройки
	'sites' => [
		'production' => [
			'site_name' => 'PGE Construction',
			'site_url' => 'https://pgeconstruction.ca/',
			'system_email' => 'info@example.com',
		],
		'local' => [
			'site_name' => 'PGE Construction',
			'site_url' => 'http://pgeconstruction.loc/',
			'system_email' => 'peter.if.888@gmail.com',
		],
	],


];
