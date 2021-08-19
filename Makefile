install:
	@docker-compose up -d --build;
	@docker exec -it app composer install;
	@docker exec -it app bin/console doctrine:database:create;
	@docker exec -it app bin/console doctrine:migrations:migrate;
	@docker exec -it app bin/console doctrine:fixtures:load;

run:
	@docker exec -it app symfony server:start;

clean:
	@docker-compose down;
	@docker system prune --all -f -a;
