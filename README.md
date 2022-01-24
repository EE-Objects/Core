# EE Objects Core
A set of generics and primitives for ExpressionEngine development. 

## Requirements
- ExpressionEngine >= 5.5
- PHP >= 7.1
 
## Installation

Add `ee-objects/core` as a requirement to your `composer.json`:

```bash
$ composer require ee-objects/core
```

### Implementation

There are a collection of stand-alone objects available:

#### `Config`

Converts your site config files into an object.

```php
$config = new Config();
$config = $config->load('ee_objects');
$config = $config->load('custom_addon');
```

#### `Str`

String Helper methods

```php
Str::studly('my-string-value);
```

#### `AbstractItem`

Treat all single entities with the same API

#### `Exceptions`

Treat errors as objects

#### Date Handling Service

Handy abstraction for handling dates

#### Fields Abstraction

A set of objects to make working with Field based data easier (Entries, Members, Categories, etc)