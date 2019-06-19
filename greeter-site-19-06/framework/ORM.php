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
interface ORM {
    
function charger();

function sauver();

function supprimer();

static function tab($where=1,$orderBy=1,$limit=null);

}
