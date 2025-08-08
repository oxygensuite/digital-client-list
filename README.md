# Digital Client List (DCL) Package

A comprehensive package for seamlessly interacting with Greece's Digital Client List (DCL) system, enabling automated submissions.

## Description

This PHP package provides a simple and efficient way to interact with the Digital Client List (DCL) system in Greece. It allows you to create, update, correlate, and cancel digital clients in compliance with the AADE (Independent Authority for Public Revenue) requirements.

## Documentation

- myDATA webpage: [AADE myDATA](https://www.aade.gr/mydata)
- DCL documentation (PDF): [AADE DCL REST API v1.1](https://www.aade.gr/sites/default/files/2025-06/DCL%20API%20Documentation%20v1.1_official_erp.pdf)

## Requirements

To use this package, you will need first a `aade id` and a `Subscription key`. You can get these credentials by signing up to myDATA rest api.

- Development: [Sign up to myDATA development api](https://mydata-dev-register.azurewebsites.net/)
- Production: [Sign up to myDATA production api](https://www.aade.gr/mydata)
- PHP 8.1 or higher
- ext-dom extension
- GuzzleHttp 7.9 or higher


| Version | PHP | myDATA | Support |
|---------|-----|--------|---------|
| ^v2.x   | 8.1 | v1.1.0 | Active  |
| ^v1.x   | 8.1 | v1.0.0 | Ended   |


## Installation

You can install the package via composer:

```bash
composer require oxygensuite/digital-client-list
```

## Usage

### Initialization

Before using any functionality, you need to initialize the DCL client with your credentials:

```php
use OxygenSuite\DigitalClient\Http\DCLRequest;

// Initialize with your credentials
$env = 'dev'; // 'production' for production environment
$userId = 'your-user-id';
$subscriptionKey = 'your-subscription-key';

DCLRequest::init($userId, $subscriptionKey, $env);
```

### Create a Digital Client

To create a new digital client:

```php
use OxygenSuite\DigitalClient\Enums\ClientServiceType;
use OxygenSuite\DigitalClient\Http\SendClient;
use OxygenSuite\DigitalClient\Models\DigitalClient;
use OxygenSuite\DigitalClient\Models\Workshop;

// Create a new digital client
$dcl = DigitalClient::create()
    ->setClientServiceType(ClientServiceType::WORKSHOP)
    ->setBranch(1)
    ->setComments('Your comments here')
    ->setUseCase(
        (new Workshop())
            ->setVehicleRegistrationNumber('REGISTRATION_NUMBER')
            ->setVehicleCategory('CATEGORY')
            ->setVehicleFactory('FACTORY'),
    );

// Send the client to DCL
$request = new SendClient();
try {
    $responses = $request->handle($dcl);

    foreach ($responses as $response) {
        if ($response->isSuccessful()) {
            // Get the new client DCL ID
            $dclId = $response->getNewClientDclID();
            // Process successful response
        } else {
            // Handle errors
            foreach ($response->getErrors() as $error) {
                // Process error
            }
        }
    }
} catch (DCLException $e) {
    // Handle communication error
    echo "Communication error: " . $e->getMessage();
}
```

### Update a Digital Client

To update an existing digital client:

```php
use OxygenSuite\DigitalClient\Enums\ClientServiceType;
use OxygenSuite\DigitalClient\Enums\InvoiceType;
use OxygenSuite\DigitalClient\Enums\ProvidedCategoryServiceType;
use OxygenSuite\DigitalClient\Http\UpdateClient;
use OxygenSuite\DigitalClient\Models\DigitalClient;

// Update an existing digital client
$updateClient = DigitalClient::update()
    ->setInitialDclId('your-dcl-id')
    ->setClientServiceType(ClientServiceType::WORKSHOP)
    ->setEntryCompletion(true)
    ->setAmount(150.25)
    ->setIsDiffVehReturnLocation(false)
    ->setProvidedServiceCategory(ProvidedCategoryServiceType::WORK_WITH_PARTS)
    ->setInvoiceKind(InvoiceType::RETAIL)
    ->setComments('Update comments');

// Send the update request
$request = new UpdateClient();
try {
    $responses = $request->handle($updateClient);

    foreach ($responses as $response) {
        if ($response->isSuccessful()) {
            // Get the updated client DCL ID
            $updatedDclId = $response->getUpdatedClientDclID();
            // Process successful response
        } else {
            // Handle errors
            foreach ($response->getErrors() as $error) {
                // Process error
            }
        }
    }
} catch (DCLException $e) {
    // Handle communication error
    echo "Communication error: " . $e->getMessage();
}
```

### Correlate a Digital Client with an invoice

To correlate a digital client with another entity:

```php
use OxygenSuite\DigitalClient\Http\ClientCorrelations;
use OxygenSuite\DigitalClient\Models\ClientCorrelation;

// Create a correlation
$correlateClient = (new ClientCorrelation())
    ->setMark('your-mark-number')
    ->addCorrelatedDCLid('your-dcl-id');

// Send the correlation request
$request = new ClientCorrelations();
try {
    $responses = $request->handle($correlateClient);

    if ($responses->isSuccessful()) {
        // Process successful response
        $correlateId = $response->getClientCorrelationId();
    } else {
        // Handle errors
    }
} catch (DCLException $e) {
    // Handle communication error
    echo "Communication error: " . $e->getMessage();
}
```

### Cancel a Digital Client

To cancel a digital client:

```php
use OxygenSuite\DigitalClient\Http\CancelClient;

// Create a cancel request
$request = new CancelClient();
try {
    $responses = $request->handle('your-dcl-id');
    $response = $responses->first(); //There is only one response

    if ($response->isSuccessful()) {
        // Get the cancellation ID
        $cancellationId = $response->getCancellationID();
        // Process successful response
    } else {
        // Handle errors
        foreach ($response->getErrors() as $error) {
            // Process error
        }
    }
} catch (DCLException $e) {
    // Handle communication error
    echo "Communication error: " . $e->getMessage();
}
```

### Retrieve Digital Clients

To retrieve sent data:

```php
use OxygenSuite\DigitalClient\Http\RequestClients;

$request = new RequestClients();

try {
    $response = $request->handle(100000000028013);

    print_r($response->toArray());
} catch (DCLException $e) {
    echo $e->getMessage();
}
```


## Available methods

| Method                                                                                     | Availability       |
|--------------------------------------------------------------------------------------------|--------------------|
| **SendClient** - New Digital Client List registration                                      | :white_check_mark: |
| **UpdateClient** - Change a Digital Client List Registration                               | :white_check_mark: |
| **CancelClient** - Cancel a Digital Client List registration                               | :white_check_mark: |
| **ClientCorrelations** - Correlate a Digital Client List Registration(s) with Tax Document | :white_check_mark: |
| **RequestClients** - Retrieve transmitted  registrations                                   | :white_check_mark: |

## Upgrading

When upgrading from v1.x to v2.x, please be aware of breaking changes. The most significant change is in the `ClientServiceType` enum, where `LEASING` has been renamed to `RENTAL`.

For detailed upgrade instructions, please refer to the [UPGRADE.md](UPGRADE.md) file.

## Special Thanks

This package was inspired by the excellent work done in the [firebed/aade-mydata](https://github.com/firebed/aade-mydata) package. I would like to express my gratitude to the developers of that project, as some of the core code and concepts from their implementation have been adapted and utilized in this package.

## License

This package is open-sourced software licensed under the MIT license.
