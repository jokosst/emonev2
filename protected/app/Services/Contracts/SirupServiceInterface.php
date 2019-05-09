<?php

namespace App\Services\Contracts;

interface SirupServiceInterface 
{
    /**
     * Login to SIRUP
     * 
     * @return response
     */
    public function login();

    /**
     * Get SKPD Data
     * 
     * @return response
     */
    public function getSKPD();

    /**
     * Get Program by SKPD ID
     * 
     * @param  $id
     * @return array
     */
    public function getProgramBySKPDId( $id);

    /**
     * Get activity by program ID
     * 
     * @param  $id
     * @return array
     */
    public function getActivityByProgramId( $id);

    /**
     * Get package by activity ID
     *  
     * @param  $idSKPD
     * @param  $idProgram
     * @param  $id
     * @return array
     */
    public function getPackage( $idSKPD,  $idProgram,  $id);
    
     /**
     * Get package list
     * 
     * @param $page
     * @return array
     */
    public function getPackageList($page = 1, $limit = 10, $search = '');

    /**
     * Get package detail
     * 
     * @param $id
     * @return array
     */
    public function getPackageDetail($id);
}