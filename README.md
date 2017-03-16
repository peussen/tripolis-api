# Tripolis API PHP Library

This library is a spin-off of the [wptripolis plugin](https://github.com/HarperJones/wp-tripolis) for wordpress that was 
developed by harperjones. It contains only the library built to connect to the SOAP API, and no wordpress specific 
information.

for information about the API, please contact Tripolis.

## Prerequisits
To work with the API you will need an API user in Tripolis. Depending on which calls you will need, your used may need 
a specific set of rights. I found that most of the time this means the API used will have to become administrator, but 
you will have to check for yourself

## Notice
Not all functions in the API document are fully implemented. I only focussed on the ones needed to add contacts and send
newsletters/directmails.

## Usage
First you create a tripolis provider:

```php

$provider = new MartyBel\Tripolis\TripolisProvider('client_name','api_user','api_password','https://td50.tripolis.com/');
```

You can then start using the APi, by simply calling api calls using the provider:

```php
$provider->contact()->database('your db id')->getById('theID');
```

Every "service" described in the API document has their own "Service" Implementation. which you can obtain by invoking
it from the provider. So if you need a function in the Subscription subsystem. you call
`$provider->subscription()` and so on.

There are two shortcut classes: Contact and DirectMail. These take away some of the ID hassle by working as somewhat of 
a wrapper around common Contact and DirectMail actions.

For example: to get a user on a specific field you can use:

```php
$contact    = new Contact($provider,'databaseId');
$recipient  = $contact->find('email','your@email.com');
```

