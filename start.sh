docker run -it --rm -v $(pwd):/app -p 8081:8081 my_php php -S 0.0.0.0:8081 -t public