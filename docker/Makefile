default: help

build: ## Build docker compose
	@docker-compose build

up: ## Start containers
	docker-compose up -d

destroy: ## Destroys containers
	docker-compose down

stop: ## Stops containers
	docker-compose stop

help: ## This help message
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' -e 's/:.*#/: #/' | column -t -s '##'

bash: ## Bash in webserver container
	docker-compose exec webserver /bin/bash

start-worker: ## Starts the queue worker process
	docker-compose exec -T webserver /bin/bash -c "php artisan queue:work --queue phished"
