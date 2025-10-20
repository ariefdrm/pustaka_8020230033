## Repo ini ditujukan untuk tugas pemrogramman web 2

Project menampilkan list data "Student" atau "Mahasiswa" menggunakan laravel.
Dengan menggunakan laravel sebagai backend dan VueJs untuk frontend. 

## setup project

cloning project
```
git clone https://github.com/ariefdrm/pustaka_8020230033.git
```

rename env file
``` 
cp .env.example .env
```

installing packages and build frontend
``` 
composer install 
npm install && npm run build 
``` 

generate key 
```
php artisan key:generate
```

setup migration database 
```
php artisan migrate
```

run the project 
```
php artisan serve
```


