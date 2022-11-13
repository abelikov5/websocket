## WebSocket Chat on Laravel

Project works with Laravel Sail, please make sure you have all neccessary to work on [this](https://laravel.com/docs/9.x/installation). 

## Start project

# Download [project](https://github.com/abelikov5/websocket.git)
# Make sure you have Docker [installed](https://docs.docker.com/engine/install/ubuntu/) and run at your terminal the following

```
# allias for Sail
alias sail="bash vendor/bin/sail"

# build project at Docker environment
sail up -d 

# run all migrations
sail artisan migrate

# start websocket server on :6001
sail artisan websockets:serve
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
