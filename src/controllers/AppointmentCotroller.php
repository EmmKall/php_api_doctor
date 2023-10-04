<?php

namespace Controller;

use Helper\Data;
use Helper\Response;
use Helper\ValidData;
use Helper\Validjwt;
use Model\Appointment;
use Route\Routes;

class AppointmentCotroller{

    public static function index() {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $object = new Appointment();
        $response = $object->index();
        Response::response( 200, 'success', $response );
    }

    public static function find( Routes $request ) {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $id = $request->param;
        //Valid id is number
        ValidData::isNumeric( $id );
        $object = new Appointment();
        /* Create data */
        $response = $object->find( $id );
        Response::response( 200, 'success', $response );
    }

    public static function store( Routes $request ) {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $labelsIn = [ 'user', 'date', 'symptoms' ];
        $data = $request->data;
        ValidData::validIn( $data, $labelsIn );
        $object = new Appointment();
        //Valid unique email
        $arrData = Data::getDataQuery( $data );
        $response = $object->store( $arrData ) ?? [];
        //Send response
        Response::response( 200, 'success', $response );
    }

    public static function update( Routes $request ) {
        /* Valid user */
        Validjwt::confirmAuthentication();
        $labelsIn = [ 'id', 'user', 'date', 'symptoms' ];
        $data = $request->data;
        /* Valid data */
        ValidData::validIn( $data, $labelsIn );
        ValidData::isNumeric( $data->id );
        /* Valid id */
        $object = new Appointment();
        /* Updated */
        $arrData = Data::getDataQuery( $data );
        $response = $object->update( $arrData );
        Response::response( 200, 'success', [ 'resposne' => $response ] );
    }

    public static function destroy( Routes $request ) { 
        /* Valid user */
        Validjwt::confirmAuthentication();
        $id = $request->param;
        ValidData::isNumeric( $id );
        $object = new Appointment();
        /* Delete user */
        $response = $object->destroy( $id );
        Response::response( 200, 'success', $response );
    }

}
