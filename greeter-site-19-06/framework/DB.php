<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author STAGIAIRE
 */
interface DB {
function esc($exp);

function xeq($req);

function nb();

function tab($class='stdClass');

function prem($class='stdClass');

function ins($obj);

function pk();

function start();

function savepoint($label);

function rollback($label=null);

function commit();
}
