<?php

namespace Model;

use Database\Conection;
use Helper\BodyMail;
use Helper\Data;
use Helper\Mail;
use Helper\Response;

class Appointment{

    private array $columnsDB = [ 'id', 'user', 'date', 'symptoms', 'created_at', 'updated_at' ];
    private string $table = 'appointment';

    public function __construct()
    {
        
    }

    public function index() {
        $sql = 'SELECT a.id AS id, a.user AS user, a.date AS date, a.symptoms AS symptoms, a.created_at AS create_at, a.updated_at AS updated_at, u.name AS name, u.email AS email, u.phone AS phone, u.type AS type FROM appointment AS a JOIN users AS u ON a.user = u.id ORDER BY DATE';
        $response = Conection::query( $sql );
        return $response;
    }

    public function find( $id ) {
        $sql = 'SELECT a.id AS id, a.user AS user, a.date AS date, a.symptoms AS symptoms, a.created_at AS create_at, a.updated_at AS updated_at, u.name AS name, u.email AS email, u.phone AS phone, u.type AS type FROM appointment AS a JOIN users AS u ON a.user = u.id WHERE u.id = ' . $id  .' ORDER BY DATE';
        $response = Conection::query( $sql );
        return $response;
    }

    public function store( $arrData ) {
        $columns = Data::removeDates( $this->columnsDB, true );
        //Insert row
        $lastId = Conection::store( $this->table, $columns, $arrData );
        //Return response
        $response = [ 'id inserted' => $lastId ];
        return $response;
    }

    public function update( $arrData ) {
        $columns = Data::removeDates( $this->columnsDB, true );
        $removeColumns = [ 'id' ];
        $columns = Data::removeColumns( $columns, $removeColumns );
        $response = Conection::update( $this->table, $columns, $arrData );
        $response = ( $response === true ) ? 'Register updated' : 'Register not updated';
        return $response;
    }

    public function destroy( $id ) {
        $response = Conection::destroy( $this->table, $id );
        if( $response[ 'status' ] === 200 ){ $response = [ 'msg' => 'Register deleted' ]; }
        else { $response = [ 'msg' => 'Register not deleted' ]; }
        return $response;
    }

}
