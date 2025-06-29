# Upgrade Guide

This document provides instructions for upgrading from one version of the Digital Client List package to another.

## Upgrading from v1.x to v2.x

### Breaking Changes

#### ClientServiceType Enum Change

In v2.0, the `ClientServiceType` enum has been updated to better reflect the actual service type terminology. The most significant change is:

- `LEASING` (value: 1) has been renamed to `RENTAL` (value: 1)

This means that any code using `ClientServiceType::LEASING` will need to be updated to use `ClientServiceType::RENTAL` instead.

**Before (v1.x):**
```php
use OxygenSuite\DigitalClient\Enums\ClientServiceType;

$dcl = DigitalClient::create()
    ->setClientServiceType(ClientServiceType::LEASING)
    // other settings...
```

**After (v2.x):**
```php
use OxygenSuite\DigitalClient\Enums\ClientServiceType;

$dcl = DigitalClient::create()
    ->setClientServiceType(ClientServiceType::RENTAL)
    // other settings...
```

### Other Changes

- Updated to support myDATA v1.1.0 (v1.x supported myDATA v1.0.0)
- PHP 8.1 is still the minimum required version

### Upgrade Steps

1. Update the package using Composer:
   ```bash
   composer require oxygensuite/digital-client-list:^2.0
   ```

2. Search your codebase for any instances of `ClientServiceType::LEASING` and replace them with `ClientServiceType::RENTAL`.

3. Test your application thoroughly to ensure all functionality works as expected with the new version.

## Need Help?

If you encounter any issues during the upgrade process, please open an issue on the GitHub repository.
