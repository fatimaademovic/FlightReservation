<?php
require_once "BaseDao.class.php";

class FlightsDao extends BaseDao{

    public function __construct(){
        parent::__construct('flights');
    }



}

?>