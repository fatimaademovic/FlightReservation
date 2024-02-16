<?php
require_once 'BaseService.php';
require_once __DIR__."/../dao/TicketsDao.class.php";

class TicketService extends BaseService{
    public function __construct(){
        parent::__construct(new TicketsDao);
    } 
}
?>