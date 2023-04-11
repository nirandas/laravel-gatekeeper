## Installation

````composer require nirandas/laravel-gatekeeper````

## Usage

In your form validation rules add:

````
$request->validate([
//...
'gatekeeper_session_key' => ['required', \Nirandas\LaravelGatekeeper\Verifier::rule('Gatekeepre validation failed')],
]);
````

Add 2 entries in the .env file
````
GATEKEEPER_CLIENT_ID = "your client id"
GATEKEEPER_CLIENT_SECRET = "your gatekeeper secret"
````

The argument to LaravelGatekeeper::rule() is optional and is the error message to use if the validation failed.

