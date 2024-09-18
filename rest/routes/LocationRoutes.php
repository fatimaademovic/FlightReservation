<?php

/**
* @OA\Get(
*     path="/location",
*     tags={"Location"},
*     summary="Get all locations",
*     @OA\Response(
*         response=200,
*         description="Return all locations.",
*     )
* )
*/
Flight::route("GET /location", function(){
   Flight::json(Flight::location_service()->get_all());
});

/**
* @OA\Get(
*     path="/location/{id}",
*     tags={"Flight"},
*     summary="Get location by ID",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of the location",
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



Flight::route("GET /location/@id", function($id){
   Flight::json(Flight::location_service()->get_by_id($id));
});

/**
* @OA\Delete(
*     path="/location/{id}",
*     tags={"Location"},
*     summary="Delete location by ID",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of the location",
*         @OA\Schema(
*             type="integer"
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Location deleted successfully"
*     )
* )
*/
Flight::route("DELETE /location/@id", function($id){
   Flight::location_service()->delete($id);
   Flight::json(['message' => "location deleted successfully"]);
});

/**
 * @OA\Post(
 *     path="/location",
 *     tags={"Location"},
 *     summary="Add a new location",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="city", type="string"),
 *                 @OA\Property(property="country", type="string"),
 *                 @OA\Property(property="airport", type="string")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Location added successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Location added successfully"),
 *             @OA\Property(property="data", type="object")
 *         )
 *     )
 * )
 */
Flight::route("POST /location", function(){
   $request = Flight::request()->data->getData();
   Flight::json(['message' => "location added successfully",
               'data' => Flight::location_service()->add($request)
               ]);
});

/**
 * @OA\Put(
 *     path="/location/{id}",
 *     tags={"Location"},
 *     summary="Update a location by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID of the location to update",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="city", type="string"),
 *                 @OA\Property(property="country", type="string"),
 *                 @OA\Property(property="airport", type="string")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Location updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Location updated successfully"),
 *             @OA\Property(property="data", type="object")
 *         )
 *     )
 * )
 */
Flight::route("PUT /location/@id", function($id){
   $location = Flight::request()->data->getData();
   Flight::json(['message' => "location edit successfully",
               'data' => Flight::location_service()->update($location, $id)
               ]);
});
?>