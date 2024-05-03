configure .env in root directory and www directory following .env.example
run "docker compose up --build"
run "docker exec -it project_app sh"
run "php artisan migrate:fresh --seed
You can authorize as a Admin with email: admin@example.com and password: Aa123456