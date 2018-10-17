# constants
DOCKER_COMPOSE = docker-compose 
EXEC_PHP = $(DOCKER_COMPOSE) exec -T php /entrypoint 
EXEC_JS = $(DOCKER_COMPOSE) run --rm node

SYMFONY = $(EXEC_PHP) bin/console
COMPOSER = $(EXEC_PHP) composer
YARN = $(EXEC_JS) yarn

#assets: assets-framework
#	@echo "Assets built"
#.PHONY: assets

#assets-framework:
#	mkdir -p public/app/bootstrap
#	cp -rf ./node_modules/bootstrap/dist/ public/app/bootstrap
#.PHONY: assets-framework

##
## Project
## -------
##

build: ## Build docker env
	@$(DOCKER_COMPOSE) pull --parallel --quiet --ignore-pull-failures 2> /dev/null
	$(DOCKER_COMPOSE) build --pull

kill: ## Kill docker env
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

install: ## Install and start the project
install: .env build start assets db

reset: ## Stop and start a fresh install of the project
reset: kill install

start: ## Start the project
	echo "Start the containers"
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

stop: ## Stop the project
	$(DOCKER_COMPOSE) stop

clean: ## Stop the project and remove generated files
clean: kill
	rm -rf .env vendor node_modules

no-docker:
	$(eval DOCKER_COMPOSE := \#)
	$(eval EXEC_PHP := )
	$(eval EXEC_JS := )

.PHONY: build kill install reset start stop clean

##
## Utils
## -----
##
db: ## Reset the database and load fixture @TODO
db: .env vendor
	@$(EXEC_PHP) php -r 'echo "Wait database...\n"; set_time_limit(15); require __DIR__."/vendor/autoload.php"; (new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__."/.env"); $$u = parse_url(getenv("DATABASE_URL")); for(;;) { if(@fsockopen($$u["host"].":".($$u["port"] ?? 3306))) { break; }}'
	@$(SYMFONY) doctrine:database:drop --if-exists --force
	@$(SYMFONY) doctrine:database:create --if-not-exists

yarn.lock: ## update yarn dependencies
yarn.lock: package.json
	$(YARN) upgrade

node_modules: ## install yarn dependencies
node_modules: yarn.lock
	$(YARN) install
	@touch -c node_modules

.env: ##configure symfony app
.env: .env.dist
	@if [ -f .env ]; \
	then\
		echo '\033[1;41m/!\ The .env.dist file has changed. Please check your .env file (this message will not be displayed again).\033[0m';\
		touch .env;\
		exit 1;\
	else\
		echo cp .env.dist .env;\
		cp .env.dist .env;\
	fi

composer.lock: ## Update symfony dependencies
composer.lock: composer.json
	$(COMPOSER) update --lock --no-scripts --no-interaction

vendor: ## Install symfony dependencies
vendor: composer.lock
	$(COMPOSER) install

assets: ## Run Webpack Encore to compile assets
assets: node_modules
	$(YARN) run dev

watch: ## Run Webpack Encore in watch mode
watch: node_modules
	$(YARN) run watch

.PHONY: db assets watch


.DEFAULT_GOAL := help
help: ## Makefile help
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help