# Installation

```
composer require davydevries/opsgenie:dev-main
```

```
php artisan vendor:publish --provider="DavydeVries\OpsGenie\OpsGenieServiceProvider"
```

## Configuration
Update `.env` file with the api access token (API_ACCESS_TOKEN) and service id (SERVICE_ID).

Example:
```
OPSGENIE_KEY=API_ACCESS_TOKEN
OPSGENIE_SERVICE=SERVICE_ID
```


## Docs OpsGenie
- [Overview](https://docs.opsgenie.com/docs/api-overview)
- [Create Incident](https://docs.opsgenie.com/docs/incident-api#create-incident)
