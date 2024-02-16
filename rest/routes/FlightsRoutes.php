<?php


/**
* @OA\Get(
*     path="/flights",
*     tags={"Flights"},
*     summary="Get all flights",
*     @OA\Response(
*         response=200,
*         description="Return all flights.",
*     )
* )
*/
Flight::route("GET /flights", function(){
   Flight::json(Flight::flight_service()->get_all());
});

/**
* @OA\Get(
*     path="/flights/{id}",
*     tags={"Flights"},
*     summary="Get flight by ID",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of the flight",
*         @OA\Schema(
*             type="integer"
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Successful operation."
*     )
* )
*/
Flight::route("GET /flights/@id", function($id){
   Flight::json(Flight::flight_service()->get_by_id($id));
});

/**
* @OA\Delete(
*     path="/flights/{id}",
*     tags={"Flights"},
*     summary="Delete flight by ID",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of the flight",
*         @OA\Schema(
*             type="integer"
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="flight deleted successfully"
*     )
* )
*/
Flight::route("DELETE /flights/@id", function($id){
   Flight::flight_service()->delete($id);
   Flight::json(['message' => "flight deleted successfully"]);
});

/**
 * @OA\Schema(
 *      schema="Flight",
 *      title="Flight",
 *      @OA\Property(
 *          property="id",
 *          type="integer",
 *          example=1
 *      ),
 *      @OA\Property(
 *          property="departureLocation",
 *          type="string",
 *          example="New York"
 *      ),
 *      @OA\Property(
 *          property="arrivalLocation",
 *          type="string",
 *          example="Los Angeles"
 *      ),
 *      @OA\Property(
 *          property="departureDate",
 *          type="string",
 *          format="date",
 *          example="2024-02-01"
 *      ),
 *      @OA\Property(
 *          property="arrivalDate",
 *          type="string",
 *          format="date",
 *          example="2024-02-02"
 *      ),
 *      @OA\Property(
 *          property="airline",
 *          type="string",
 *          example="Delta Airlines"
 *      ),
 *      @OA\Property(
 *          property="seatCapacity",
 *          type="integer",
 *          example=200
 *      ),
 *      @OA\Property(
 *          property="wifi",
 *          type="boolean",
 *          example=true
 *      ),
 *      @OA\Property(
 *          property="meals",
 *          type="boolean",
 *          example=true
 *      )
 * )
 */

/**
* @OA\Post(
*      path="/flight",
*      tags={"Flights"},
*      summary="Add a new flight",
*      @OA\RequestBody(
*          required=true,
*          @OA\JsonContent(ref="#/components/schemas/Flight")
*      ),
*      @OA\Response(
*          response=200,
*          description="Successful operation",
*          @OA\JsonContent(ref="#/components/schemas/Flight")
*      ),
*      @OA\Response(
*          response=400,
*          description="Bad request"
*      )
* )
*/
Flight::route("POST /flight", function(){
   $request = Flight::request()->data->getData();
   Flight::json(['message' => "flight added successfully",
               'data' => Flight::flight_service()->add($request)
               ]);
});

/**
* @OA\Put(
*      path="/flight/{id}",
*      tags={"Flights"},
*      summary="Update an existing flight",
*      @OA\Parameter(
*          name="id",
*          in="path",
*          required=true,
*          description="ID of the flight to update",
*          @OA\Schema(
*              type="integer"
*          )
*      ),
*      @OA\RequestBody(
*          required=true,
*          @OA\JsonContent(ref="#/components/schemas/Flight")
*      ),
*      @OA\Response(
*          response=200,
*          description="Successful operation",
*          @OA\JsonContent(ref="#/components/schemas/Flight")
*      ),
*      @OA\Response(
*          response=400,
*          description="Bad request"
*      )
* )
*/
Flight::route("PUT /flight/@id", function($id){
   $flight = Flight::request()->data->getData();
   Flight::json(['message' => "flight edit successfully",
               'data' => Flight::flight_service()->update($flight, $id)
               ]);
});

Flight::route("POST /search", function(){
   $request = Flight::request()->data->getData();
   Flight::json(Flight::flight_service()->search($request));
});


?>