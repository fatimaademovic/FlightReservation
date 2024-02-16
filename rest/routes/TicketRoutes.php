<?php

/**
* @OA\Get(
*     path="/ticket",
*     tags={"Ticket"},
*     summary="Get all tickets",
*     @OA\Response(
*         response=200,
*         description="Return all tickets.",
*     )
* )
*/
Flight::route("GET /ticket", function(){
    Flight::json(Flight::ticket_service()->get_all());
 });

/**
* @OA\Get(
*     path="/ticket/{id}",
*     tags={"Ticket"},
*     summary="Get ticket by ID",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of the ticket",
*         @OA\Schema(
*             type="integer"
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Successful operation"
*     )
* )
*/
Flight::route("GET /ticket/@id", function($id){
    Flight::json(Flight::ticket_service()->get_by_id($id));
 });
 
/**
* @OA\Delete(
*     path="/ticket/{id}",
*     tags={"Ticket"},
*     summary="Delete ticket by ID",
*     @OA\Parameter(
*         name="id",
*         in="path",
*         required=true,
*         description="ID of the ticket",
*         @OA\Schema(
*             type="integer"
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Ticket deleted successfully"
*     )
* )
*/
Flight::route("DELETE /ticket/@id", function($id){
   Flight::ticket_service()->delete($id);
   Flight::json(['message' => "ticket deleted successfully"]);
});

/**
 * @OA\Post(
 *      path="/ticket",
 *      summary="Add a ticket",
 *      tags={"Ticket"},
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              required={"userID", "flightID", "seatNumber", "ticketPrice"},
 *              @OA\Property(property="userID", type="integer"),
 *              @OA\Property(property="flightID", type="integer"),
 *              @OA\Property(property="seatNumber", type="string"),
 *              @OA\Property(property="ticketPrice", type="number", format="float")
 *          )
 *      ),
 *      @OA\Response(
 *          response="200",
 *          description="Ticket added successfully"
 *      )
 * )
 */
Flight::route("POST /ticket", function(){
   $request = Flight::request()->data->getData();
   Flight::json(['message' => "ticket added successfully",
                 'data' => Flight::ticket_service()->add($request)
             ]); 
});

/**
 * @OA\Put(
 *      path="/ticket/{id}",
 *      summary="Edit a ticket",
 *      tags={"Ticket"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the ticket to edit",
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              required={"userID", "flightID", "seatNumber", "ticketPrice"},
 *              @OA\Property(property="userID", type="integer"),
 *              @OA\Property(property="flightID", type="integer"),
 *              @OA\Property(property="seatNumber", type="string"),
 *              @OA\Property(property="ticketPrice", type="number", format="float")
 *          )
 *      ),
 *      @OA\Response(
 *          response="200",
 *          description="Ticket edited successfully"
 *      )
 * )
 */
Flight::route("PUT /ticket/@id", function($id){
   $ticket = Flight::request()->data->getData();
   Flight::json(['message' => "ticket edit successfully",
               'data' => Flight::ticket_service()->update($ticket, $id)
               ]);
});
?>