<?php
/*
 * Update from
 * https://github.com/tekkie/crud-php/blob/master/Tc/Crud/CrudInterface.php
 */

namespace Database;

/**
 * Describes a data accessor API.
 */
interface CrudInterface
{
    /**
     * Create new item
     *
     * @param array $item
     * @param array $criteria
     *
     * @return int
     */
    public function create($item = null, array $criteria = []) : int ;

    /**
     * Retrieve existing item
     *
     * @param array $criteria
     * @param array $item
     *
     * @return object|null
     */
    public function read($item = null, array $criteria = []) : ?object;

    /**
     * Changes existing item
     *
     * @param object $item
     * @param array  $criteria
     *      *
     * @return bool
     */
    public function update($item, array $criteria = []) : bool;

    /**
     * Remove existing item
     *
     * @param object $item
     * @param array $criteria
     *
     * @return bool
     */
    public function delete($item, array $criteria = []) : bool;

}