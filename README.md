# Sites sample app

## Up and running

Here I describe how to get the project up and running via `docker compose`.

1. Make sure you have Docker Desktop application running
2. Open the terminal and navigate to the project root directory
3. Copy and run the following command to install required composer dependencies
```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```
4. Run the following command to get the project up and running:

```shell
vendor/bin/sail up 
```

5. Once the app is up and running, open new terminal, navigate to project root 
and run command `vendor/bin/sail artisan migrate --seed`. 
It will create the DB table and add Root User (root@sites.app) . We need at least one user to be able to generate API key, user is tokenable by default.


Next you can start testing the app.

## Curl queries

### Create site

The following command creates new site:

```shell
curl -X POST --location "http://localhost/api/v1/site" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d "{
          \"name\": \"Test store\",
          \"type\": \"shpp\",
          \"address\": {
            \"street\": \"Fake street\",
            \"city\": \"New York\",
            \"state\": \"NY\",
            \"zip\": \"00000\",
            \"country\": \"USA\"
          }
        }"
```

### Update site

The following command updates the site by ID (change the ID in the path):

```shell
curl -X PUT --location "http://localhost/api/v1/site/37" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d "{
          \"name\": \"Test store edited\",
          \"type\": \"shop (edited))\",
          \"address\": {
            \"street\": \"Fake street\",
            \"city\": \"New York\",
            \"state\": \"NY\",
            \"zip\": \"22222\",
            \"country\": \"USA\"
          }
        }"
```

### Get site

The following command retrieves site by ID:

```shell
curl -X GET --location "http://localhost/api/v1/site/37" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

### Find site by type

The following command searches site by type (change `type` parameter in query string):

```shell
curl -X GET --location "http://localhost/api/v1/site/find-by-type?type=market" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

### Delete site

The following command deletes site by ID:

```shell
curl -X DELETE --location "http://localhost/api/v1/site/36" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

Actually there is more to refactor and improve in the app, but it requires more time to spend.
E.g. I could define messages in lang/ directory or could add more integration tests for components like SiteHelper for test coverage.
