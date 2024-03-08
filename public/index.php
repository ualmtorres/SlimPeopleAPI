<?php

require dirname(__DIR__) . '/vendor/autoload.php';

include_once 'faker.php';

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Factory\AppFactory;

// Create the application
$app = AppFactory::create();

// Setup the prefix for the API paths
$prefix = '/api';

// Define the application routes
$app->get("/", function (RequestInterface $request, ResponseInterface $response, array $args) {
    echo file_get_contents('./index.html');

    return $response;
});

// Get faker data
$app->get("$prefix/people", function (RequestInterface $request, ResponseInterface $response, array $args) {
    // Access the imported fake data
    global $fakeData;

    // Set the response content type
    header('Content-Type: application/json; charset=utf-8');

    // Set the response status code
    $data['status'] = 200;

    // Set the response data
    $data['message'] = $fakeData;

    // Write the response
    $response->getBody()->write(json_encode($data));

    // Return the response
    return $response;
});

// Get faker data by id
$app->get("$prefix/people/{id}", function (RequestInterface $request, ResponseInterface $response, array $args) {
    // Access the imported fake data
    global $fakeData;

    // Set the response content type
    header('Content-Type: application/json; charset=utf-8');

    // Set the response status code
    $data['status'] = 200;

    // Set the response data
    $data['message'] = $fakeData[$args['id'] - 1];

    // Write the response
    $response->getBody()->write(json_encode($data));

    // Return the response
    return $response;
});

// Get faker data by email as query parameter
$app->get("$prefix/peopleByEmail", function (RequestInterface $request, ResponseInterface $response, array $args) {
    // Access the imported fake data
    global $fakeData;

    // Set the response content type
    header('Content-Type: application/json; charset=utf-8');

    try {
        // Get the email from the query parameters
        $email = $request->getQueryParams()['email'];

        // Find the record with the email
        $record = array_filter($fakeData, function ($record) use ($email) {
            return $record['email'] === $email;
        });

        // Set the response status code
        $data['status'] = 200;

        // Set the response data
        $data['message'] = array_values($record);
    } catch (Exception $e) {
        // Set the response status code
        $data['status'] = 400;

        // Set the response data
        $data['message'] = 'Bad request';
    }

    // Write the response
    $response->getBody()->write(json_encode($data));

    // Return the response
    return $response;
});

// Catch invalid routes
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function (RequestInterface $request, ResponseInterface $response) {
    // Set the response content type
    header('Content-Type: application/json; charset=utf-8');

    // Set the response status code
    $data['status'] = 404;

    // Set the response data
    $data['message'] = 'Not found';

    // Write the response
    $response->getBody()->write(json_encode($data));

    // Return the response
    return $response;
});

//Run the application
$app->run();
