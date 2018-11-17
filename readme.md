## Restful E-commerce Api

Restful E-commerce Api is an api system contains authentication system (Login - Registeration - Logout) and many route that makes you control the data. The system handle all different requests. You can use the system online by this route.

## System Routes

* Auth

1. /api/login
	* Method [Post]
	* Request [ email, password ]
	* Response [ user token ]

2. /api/register
	* Method [Post]
	* Request [ name, email, password, confirm_password ]
	* Response [ user token ]

3. /api/logout
	* Method [Get]

* Products

1. /api/products
	* Method [Get]
	* Response [ Paginate Collection Data ]

2. /api/products/category/{category-slug}
	* Method [Get]
	* Response [ Paginate Collection Data ]

3. /api/products/brand/{brand-slug}
	* Method [Get]
	* Response [ Paginate Collection Data ]

4. /api/products/{product-id}
	* Method [Get]
	* Response [ Single Product Data ]

* Categories

1. /api/categories
	* Method [Get]
	* Response [ Paginate Collection Data ]

* Brands

1. /api/brands
	* Method [Get]
	* Response [ Paginate Collection Data ]

* Product Reviews

1. /api/products/{product-slug}/reviews
	* Method [Get]
	* Response [ Paginate Collection Data ]

2. /api/products/{product-slug}/reviews/{review-id}
	* Method [Get]
	* Response [ Single Product Review Data ]

* Orders

1. /api/order
	* Method [Get]
	* Response [ Paginate Collection Data - User Logged in orders ]

2. /api/order
	* Method [Post]
	* Request [ Order, address, phone]
	* Response [ Status with order id ]
	* Note: Order in request must be an array with id, product, qty, price [ order[0][id], order[0][product], order[0][qty], order[0][price] ]

3. /api/order/{order-id}
	* Method [Get]
	* Response [ Single Order Data - User Logged in order ]

* Contact
1. /api/contact
	* Method [Post]
	* Request [ name, title, message ]
	* Response [ status ]

## Notes
This Api is case study only.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.
