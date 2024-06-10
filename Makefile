ar:
	docker-compose -f docker-compose.yml exec app php artisan $(c)
up:
	docker-compose -f docker-compose.yml up -d
build:
	docker-compose -f docker-compose.yml up --build -d
stop:
	docker-compose -f docker-compose.yml stop $(c)
down:
	docker-compose -f docker-compose.yml down $(c)
restart:
	docker-compose -f docker-compose.yml restart

composer:
	docker-compose -f docker-compose.yml exec app composer $(c)

db-up:
	docker-compose -f docker-compose-db.yml up -d
db-build:
	docker-compose -f docker-compose-db.yml up --build -d
db-stop:
	docker-compose -f docker-compose-db.yml stop
db-down:
	docker-compose -f docker-compose-db.yml down
db-restart:
	docker-compose -f docker-compose-db.yml restart
