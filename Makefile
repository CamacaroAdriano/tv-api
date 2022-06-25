# Static ———————————————————————————————————————————————————————————————————————————————————————————————————————————————
LC_LANG = en_US

# Setup ————————————————————————————————————————————————————————————————————————————————————————————————————————————————
docker_exec := docker-compose exec
php_container := tv_app
sail := ./vendor/bin/sail
artisan := $(sail) artisan
args = $(filter-out $@,$(MAKECMDGOALS))

enter:
	$(docker_exec) $(php_container) bash
.SILENT: enter

sail:
	$(sail) $(call args)
.SILENT: sail

artisan:
	$(artisan) $(call args)
.PHONY: artisan

# Test —————————————————————————————————————————————————————————————————————————————————————————————————————————————————
test: export APP_ENV = testing
test:
	$(docker_exec) -e APP_ENV $(php_container) php artisan test --stop-on-failure $(call args);
.SILENT: test

# Quality ——————————————————————————————————————————————————————————————————————————————————————————————————————————————
security-check:
	$(docker_exec) $(php_container) php vendor/bin/security-checker security:check composer.lock
.SILENT: security-check

phpstan:
	$(docker_exec) $(php_container) vendor/bin/phpstan analyse -c phpstan.neon -vvv --memory-limit=2048M
.PHONY: phpstan

phpcs:
	$(docker_exec) $(php_container) vendor/bin/php-cs-fixer fix -vvv
.PHONY: phpcs
