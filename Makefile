up:
	cd laradock && docker-compose up -d nginx mysql phpmyadmin redis workspace
down:
	cd laradock && docker-compose down
ssh:
	cd laradock && docker-compose exec workspace bash