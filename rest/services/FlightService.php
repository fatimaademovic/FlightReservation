<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/FlightsDao.class.php";

class FlightService extends BaseService{
    public function __construct(){
        parent::__construct(new FlightsDao);
    } 
}
?>