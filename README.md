# LARAVEL API POSTS

## Các bước để chạy project:
1. composer install
2. php artisan key:generate
3. php artisan migrate
4. php artisan passport:install
5. php artisan db:seed
6. php artisan serve

## Sử dụng
1. Đăng nhập theo đường dẫn "/api/login" bằng method POST (cung cấp username và password).
    - username : u382t
    - password : 123
    - VD: Trong postman phần body chọn "raw" và loại "json" thì:
    {
        "username" : "u382t",
        "password" : "123"
    }

2. Lấy API-KEY
    - Lấy token sau khi đăng nhập để tạo API-KEY theo đường dẫn "/api/create-api-key" bằng method GET (Bearer Token).
3. Sử dụng API-KEY để truy cập API.
    - Cung cấp API-KEY ở Header với:
        + Key: "X-Authorization"
        + Value : api-key vừa tạo
## Đường dẫn
### Login
- https://api-laravel.viit.com.vn/api/login
### Tạo API-KEY
-https://api-laravel.viit.com.vn/api/create-api-key
### Link API
- https://api-laravel.viit.com.vn/api/posts
- https://api-laravel.viit.com.vn/api/categories
- https://api-laravel.viit.com.vn/api/tags
- https://api-laravel.viit.com.vn/api/authors
- https://api-laravel.viit.com.vn/api/advertises
- https://api-laravel.viit.com.vn/api/websites
- https://api-laravel.viit.com.vn/api/menus
- https://api-laravel.viit.com.vn/api/pages
- https://api-laravel.viit.com.vn/api/colors