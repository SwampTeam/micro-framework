<?php
/*
 * Some code came from
 * https://github.com/tekkie/crud-php/blob/master/Tc/Crud/CrudInterface.php
 */

namespace Model;

/**
 * Describes a data accessor API.
 */
interface CrudInterface
{
    /**
     * Create new item
     *
     * @param array $fieldValues
     *
     * @return int
     */
    public function create(array $fieldValues) : int ;

    /**
     * Retrieve existing item
     *
     * @param int $id
     *
     * @return object|null
     */
    public static function read(int $id);


    /**
     * Retrieve all objects
     *
     * @return array
     */
    public static function findAll() : array ;

    /**
     * Changes existing item
     *
     * @param int $id
     * @param array  $fieldValues
     *
     * @return bool
     */
    public function update(int $id, array $fieldValues) : bool ;

    /**
     * Remove existing item
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id) : bool ;

}