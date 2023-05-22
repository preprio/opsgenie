# Prepr Laravel Opsgenie SDK

This SDK is used by the Prepr team to monitor Laravel projects in Atlassian Opsgenie.

## Installation

### Composer
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
composer require preprio/opsgenie
```
### Config
Publish `opsgenie.php` config
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

### Optional configuration

### Prefix
It's optional to add a prefix to the message that's send to Opsgenie, to clearify what service/repo. You can add a prefix by configuring the following line in your `.env` file.
```
OPSGENIE_PREFIX=preprio/mutation.prepr.io
```

Examples: 

| config                    | result                                |
|---------------------------|---------------------------------------|
| PREFIX                    | `[PREFIX] Message`                    |
| preprio/mutation.prepr.io | `[preprio/mutation.prepr.io] MESSAGE` |
| mutation-api              | `[mutation-api] MESSAGE`              |

### Default tags
It's optional to add default tags to the message that's send to Opsgenie. You can add a default tags by configuring the following line in your `.env` file. (comma-separated list)
```
OPSGENIE_TAGS=tagOne,tagTwo,etc.
```

## Docs OpsGenie

- [Overview](https://docs.opsgenie.com/docs/api-overview)
- [Create Alert](https://docs.opsgenie.com/docs/alert-api#create-alert)
- [Create Incident](https://docs.opsgenie.com/docs/incident-api#create-incident)

## Usage

### Base

#### For an incident
```php
Ops()->incident()
```

#### For an alert
```php
Ops()->alert()
```

### Priority functions (required)

Set incident priority.

|Priority|Function|
|---|---|
|Critical| `->P1()` or `->citical()`|
|High| `->P2()` or `->high()`|
|Moderate| `->P3()` or `->moderate()`|
|Low| `->P4()` or `->low()`|
|Informational| `->P5()` or `->informational()`|

### Message (required)

Set incident title.

```php
->message('Import failed')
```

### Description (optional)

Set incident description.

```php
->description('Import failed')
```

### Details (optional)

Set incident details. (Key-Value list)

```php
->description([
        'environment' => 'xxx-xxx-xxx',
        'file' => 'xxx_x_xxxx_xxxx_xx.csv'
        'example' => true
    ])
```

### Tags (optional)

Set incident tags. (Simple list)

```php
->tags(['critical', 'import', 'micro-service'])
```

### Send (required)

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
    ->tags(['critical', 'import', 'micro-service'])
    ->send();
```


## Alert attachments


### Attach Resource/Blob (optional)
You can add attachments to alerts like log files, exception files, renders, json, etc. 
By adding the following function(s) after `->send()`.


```php
Ops()
    ...
    ->send()
    ->attachBlob('RESOURCE/BLOB', 'filename_with.extension');
```

You can also attach multiple files
```php
Ops()
    ...
    ->send()
    ->attachBlob('RESOURCE/BLOB', 'filename_with.extension')
    ->attachBlob('<html><body><h1>Hello World!</h1></body></html', 'index.html');
    ->attachBlob('{"Hello":"World"}', 'export.json');
```

### Attach files (optional) ⚠️ NOT TESTED
```php
Ops()
    ...
    ->send()
    ->attachFile('/path/to/file');
```

### Attach example/combined
You can use attach-function multiple times, and mix them in random order.
For example 2x `->attachBlob()`, 1x `->attachFile()`.
```php
Ops()
    ...
    ->send()
    ->attachBlob('{"Hello":"World"}', 'export.json')
    ->attachFile('/path/to/file')
    ->attachBlob('<html><body><h1>Hello World!</h1></body></html', 'index.html');
```
