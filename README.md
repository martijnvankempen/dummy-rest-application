# dummy-rest-application

## Docker
### Build
docker-compose build --force-rm

### Compose (start applications)
docker-compose up -d --force-recreate

### Enter docker php container
docker exec -it dummy-php bash and update the dependencies and migrate the database

## Update dependencies
composer update

## Database
php bin/console doctrine:database:create --if-not-exists 
php bin/console doctrine:migrations:migrate -n 