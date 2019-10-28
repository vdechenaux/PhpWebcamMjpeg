# Php Webcam Mjpeg

Create a Mjpeg stream of a webcam using PHP

## Usage

### Local PHP 7.4

```
composer install
php -d ffi.enable=1 -S localhost:8000 -t public
```

### With Docker

```
docker build -t phpwebcam docker
docker run --rm -p 8000:80 -v "$PWD:/src" --device=/dev/video0 -it phpwebcam
```

### Use it !

http://localhost:8000/
