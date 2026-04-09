.PHONY: dev prod test down logs

## Start dev environment (default)
dev:
	docker compose --env-file .env.dev.local -f compose.yaml -f compose.override.yaml up --build

## Start prod environment
prod:
	docker compose --env-file .env.prod.local -f compose.yaml -f compose.prod.yaml up --build -d

## Start test environment
test:
	docker compose --env-file .env.test.local -f compose.yaml -f compose.test.yaml up --build -d

## Stop all containers
down:
	docker compose down

## Follow logs
logs:
	docker compose logs -f
