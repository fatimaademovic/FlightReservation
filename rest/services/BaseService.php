<?php
 
 class BaseService {
    private $dao;

    public function __construct($dao){
        $this->dao = $dao;
    }

    public function get_all(){
        return $this->dao->get_all();
    }

    public function get_by_id($id){
        return $this->dao->get_by_id($id);
    }

    public function add($entity){
        return $this->dao->add($entity);
    }

    public function update($entity, $id){
        return $this->dao->update($entity, $id);
    }
    
    public function delete($id){
        return $this->dao->delete($id);
    }

    public function search($entity){
        $departureLocation = isset($entity['departureLocation']) ? $entity['departureLocation'] : null;
        $arrivalLocation = isset($entity['arrivalLocation']) ? $entity['arrivalLocation'] : null;
        $departureDate = isset($entity['departureDate']) ? $entity['departureDate'] : null;
        $arrivalDate = isset($entity['arrivalDate']) ? $entity['arrivalDate'] : null;

        return $this->dao->search($departureLocation, $arrivalLocation, $departureDate, $arrivalDate);
    }

    public function login($entity){
        $email = isset($entity['email']) ? $entity['email'] : null;
        $password = isset($entity['password']) ? $entity['password'] : null;
        return $this->dao->login($email, $password);
    }
}








?>