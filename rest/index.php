<?php
require "../vendor/autoload.php";
require "services/UserService.php";
require "services/FlightService.php";
require "services/LocationService.php";
require "services/TicketService.php";

Flight::register('user_service', "UserService");
Flight::register('flight_service', "FlightService");
Flight::register('location_service', "LocationService");
Flight::register('ticket_service', "TicketService");

/* Add CORS headers */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

Flight::route('OPTIONS /*', function(){
  header('Allow: GET, POST, OPTIONS');
  header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
  header('Access-Control-Allow-Headers: Content-Type, Authorization');
  Flight::json([]);
});

/* REST API documentation endpoint */
Flight::route('GET /docs.json', function(){
    $openapi = \OpenApi\scan('routes');
    header('Content-Type: application/json');
    echo $openapi->toJson();
  });

require_once 'routes/UserRoutes.php';
require_once 'routes/FlightsRoutes.php';
require_once 'routes/LocationRoutes.php';
require_once 'routes/TicketRoutes.php';

Flight::start();
?>