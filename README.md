[![Typing SVG](https://readme-typing-svg.demolab.com?font=Fira+Code&size=25&pause=1000&center=true&vCenter=true&multiline=true&random=false&width=1000&height=50&lines=Laravel)](https://git.io/typing-svg)

Requirements
- `php 8.2`
- `composer`
- `make`
- `docker & docker-compose`

### GIT
```bash 
git clone https://github.com/Erzhh/lara11.git 
````

````bash
composer install | docker run --rm -v $(pwd):/app composer install
````

````bash
cp .env.example .env
chmod +x start.sh
./start.sh up
./start.sh down
````

````bash  
Open your browser :
    * http://localhost:80
    * http://localhost:80/docs

This project use the following ports :

| Server     |  Port |
|------------|-------|
| App        | 80    |
| DB         | 5432  |
| MongoDB    | 27070 |
| Redis      | 6379  |
| Elastic    | 9200  |
| Kibana     | 5601  |
