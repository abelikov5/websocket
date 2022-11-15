## WebSocket Chat on Laravel

Project works with Laravel Sail, please make sure you have all neccessary to work on [this](https://laravel.com/docs/9.x/installation). 

## Start project

Download [project](https://github.com/abelikov5/websocket.git) and follow to folder project.
Make sure you have Docker [installed](https://docs.docker.com/engine/install/ubuntu/) and run at your terminal the following

```
# start docker and install the application's dependencies:
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

# allias for Sail
alias sail="bash vendor/bin/sail"

# build project at Docker environment
sail up -d 

# run all migrations
sail artisan migrate

# start websocket server on :6001
sail artisan websockets:serve

# finaly 
sail npm run dev

```

## Project ScreenCast
[YouTube](https://youtu.be/vtupNdpTn-s)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
