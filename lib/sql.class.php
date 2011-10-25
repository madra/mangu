<?php

/**
*interface for all database or data storage function 
*/
interface Sql
{

/**
*the table to be accessed should be specified in the constructor
*/
public function __construct($table);

/**
*perform row sql queries
like find_by_sql('select * from database');
*/
public function find_by_sql($query);


/**
*delete data
*/
public function remove($args_parameters,$args_values);


/**
*search for data 
link find('name','id = 1')
*/
public  function  find($args_records = null,$args_conditions = null,$args_order = null);


/**
*add data
*/
public function insert($args_values,$args_parameters = null);


/**
*return a count of the values
*/
public function count($args_parameters = null );



}








?>
