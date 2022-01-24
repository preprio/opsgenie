# Installation

```
...
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/preprio/opsgenie.git"
        }
    ],
...
```
```
composer update
```

```
php artisan vendor:publish --provider="Prepr\OpsGenie\OpsGenieServiceProvider"
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

## Usage

### Base

```php
Ops()->incident()
```

### Priority functions

Set incident priority.

|Priority|Function|
|---|---|
|Critical| `->P1()` or `->citical()`|
|High| `->P2()` or `->high()`|
|Moderate| `->P3()` or `->moderate()`|
|Low| `->P4()` or `->low()`|
|Informational| `->P5()` or `->informational()`|

### Message

Set incident title.

```php
->message('Import failed')
```

### Description

Set incident description.

```php
->description('Import failed')
```

### Details

Set incident details. (Key-Value list)

```php
->description([
        'environment' => 'xxx-xxx-xxx',
        'file' => 'xxx_x_xxxx_xxxx_xx.csv'
        'example' => true
    ])
```

### Tags

Set incident tags. (Simple list)

```php
->tags(['critical','import','micro-service'])
```

### Send

Send incident to Opsgenie.

```php
->send();
```

### Full example:

Function above combined.

```php
Ops()
    ->incident()
    ->critical()
    ->message('Import failed')
    ->description('The import script failed to import data from customer X.')
    ->details([
        'environment' => 'xxx-xxx-xxx',
        'file' => 'xxx_x_xxxx_xxxx_xx.csv'
        'example' => true
    ])
    ->tags(['critical','import','micro-service'])
    ->send();
```
