<?php

use OpenApi\Annotations as OA;


/**
* @OA\Get(
*     path="/user",
*     tags={"User"},
*     @OA\Response(response="200", description="Returns all users.")
* )
*/
Flight::route("GET /user", function(){
    Flight::json(Flight::user_service()->get_all());
});


/**
* @OA\Get(
*     path="/user/{id}",
*     tags={"User"},
*     @OA\Parameter(
*         name="id",
*         in="path",
*         description="User ID",
*         required=true,
*         @OA\Schema(type="integer")
*     ),
*     @OA\Response(response="200", description="Returns a user by ID.")
* )
*/
Flight::route("GET /user/@id", function($id){
    Flight::json(Flight::user_service()->get_by_id($id));
});
 
/**
* @OA\Delete(
*     path="/user/{id}",
*     tags={"User"},
*     @OA\Parameter(
*         name="id",
*         in="path",
*         description="User ID",
*         required=true,
*         @OA\Schema(type="integer")
*     ),
*     @OA\Response(response="200", description="User deleted successfully.")
* )
*/
Flight::route("DELETE /user/@id", function($id){
    Flight::user_service()->delete($id);
    Flight::json(['message' => "User deleted successfully"]);
});

/**
* @OA\Post(
*     path="/user",
*     tags={"User"},
*     @OA\RequestBody(description="Student info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="firstName", type="string", example="Fatima",	description="User first name"),
*    				@OA\Property(property="lastName", type="string", example="Ademovic",	description="User last name" ),
*                   @OA\Property(property="email", type="string", example="email@gmail.com",	description="User email" ),
*                   @OA\Property(property="type", type="string", example="USER",	description="tzpe" ),
*        )
*     )),
*     @OA\Response(response="200", description="User added successfully.")
* )
*/
Flight::route("POST /user", function(){
    $request = Flight::request()->data->getData();
    Flight::json(['message' => "User added successfully",
                  'data' => Flight::user_service()->add($request)
                 ]);
});
 

/**
* @OA\Put(
*     path="/user/{id}",
*     tags={"User"},
*     @OA\Parameter(
*         name="id",
*         in="path",
*         description="User ID",
*         required=true,
*         @OA\Schema(type="integer")
*     ),
*     @OA\RequestBody(description="Student info", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*    				@OA\Property(property="firstName", type="string", example="Fatima",	description="User first name"),
*    				@OA\Property(property="flastName", type="string", example="Ademovic",	description="User last name" ),
*                   @OA\Property(property="email", type="string", example="email@gmail.com",	description="User email" ),
*                   @OA\Property(property="type", type="string", example="USER",	description="tzpe" ),
*        )
*     )),
*     @OA\Response(response="200", description="User edited successfully.")
* )
*/
Flight::route("PUT /user/@id", function($id){
    $user = Flight::request()->data->getData();
    Flight::json(['message' => "User edited successfully",
                  'data' => Flight::user_service()->update($user, $id)
                 ]);
});

Flight::route("POST /login", function(){
    $request = Flight::request()->data->getData();
    Flight::json(Flight::user_service()->login($request));
 });
