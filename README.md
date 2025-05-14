# Digital Client List (DCL) Package

> ⚠️ **WARNING** ⚠️
> This package is currently in BETA. There might be breaking changes without notice.
> Use at your own risk. I am not responsible for blowing up your server.

A comprehensive package for seamlessly interacting with Greece's Digital Client List (DCL) system, enabling automated submissions.

## Description

This PHP package provides a simple and efficient way to interact with the Digital Client List (DCL) system in Greece. It allows you to create, update, correlate, and cancel digital clients in compliance with the AADE (Independent Authority for Public Revenue) requirements.

## Documentation

- myDATA webpage: [AADE myDATA](https://www.aade.gr/mydata)
- DCL documentation (PDF): [AADE DCL REST API v1.0.10](https://www.aade.gr/sites/default/files/2025-04/DCL_API_Documentation_v1.0_official_erp.pdf)

## Requirements

To use this package, you will need first a `aade id` and a `Subscription key`. You can get these credentials by signing up to mydata rest api.

- Development: [Sign up to mydata development api](https://mydata-dev-register.azurewebsites.net/)
- Production: [Sign up to mydata production api](https://www.aade.gr/mydata)
- PHP 8.2 or higher
- ext-dom extension
- GuzzleHttp 7.9 or higher


| Version | PHP | myDATA | Support       |
|---------|-----|--------|---------------|
| ^v1.x   | 8.2 | v1.0.0 | When released |


## Installation

You can install the package via composer:

```bash
composer require oxygensuite/digital-client-list
```

## Usage

### Initialization

Before using any functionality, you need to initialize the DCL client with your credentials:

```php
use OxygenSuite\OxygenDcl\Http\DCLRequest;

// Initialize with your credentials
$env = 'dev'; // 'production' for production environment
$userId = 'your-user-id';
$subscriptionKey = 'your-subscription-key';

DCLRequest::init($userId, $subscriptionKey, $env);
```

### Creating a Digital Client

To create a new digital client:

```php
use OxygenSuite\OxygenDcl\Enums\ClientServiceType;
use OxygenSuite\OxygenDcl\Http\SendClient;
use OxygenSuite\OxygenDcl\Models\DigitalClient;
use OxygenSuite\OxygenDcl\Models\Workshop;

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

### Updating a Digital Client

To update an existing digital client:

```php
use OxygenSuite\OxygenDcl\Enums\ClientServiceType;
use OxygenSuite\OxygenDcl\Enums\InvoiceType;
use OxygenSuite\OxygenDcl\Enums\ProvidedCategoryServiceType;
use OxygenSuite\OxygenDcl\Http\UpdateClient;
use OxygenSuite\OxygenDcl\Models\DigitalClient;

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

### Correlating a Digital Client

To correlate a digital client with another entity:

```php
use OxygenSuite\OxygenDcl\Http\ClientCorrelations;
use OxygenSuite\OxygenDcl\Models\ClientCorrelation;

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

### Canceling a Digital Client

To cancel a digital client:

```php
use OxygenSuite\OxygenDcl\Http\CancelClient;

// Create a cancel request
$request = new CancelClient();
try {
    $response = $request->handle('your-dcl-id');

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
## Available methods

| Method                                                                                     | Availability       |
|--------------------------------------------------------------------------------------------|--------------------|
| **SendClient** - New Digital Client List registration                                      | :white_check_mark: |
| **UpdateClient** - Change a Digital Client List Registration                               | :white_check_mark: |
| **CancelClient** - Cancel a Digital Client List registration                               | :white_check_mark: |
| **ClientCorrelations** - Correlate a Digital Client List Registration(s) with Tax Document | :white_check_mark: |
| **RequestClients** - Retrieve transmitted  registrations                                   | :white_check_mark: |

## Special Thanks

This package was inspired by the excellent work done in the [firebed/aade-mydata](https://github.com/firebed/aade-mydata) package. I would like to express my gratitude to the developers of that project, as some of the core code and concepts from their implementation have been adapted and utilized in this package.

## License

This package is open-sourced software licensed under the MIT license.
