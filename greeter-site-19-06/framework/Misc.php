<?php


class Misc {
    
    
  private function __construct(){
      // 100% static
}


public static function crypter($table, $colPk, $colMdp){
  // Selectionner les "user" dont le mot de passe n'est pas NULL
    $db = DBMySQL::getInstance();
    $req = "SELECT * FROM {$table} WHERE {$colMdp} IS NOT NULL";
    
    $tab = $db->xeq($req)->tab();
    
     
    // ¨Pour chacun d'eux, le crypter et le mettre à jour en base.
    foreach($tab as $obj){
            $mdp = password_hash($obj->$colMdp, PASSWORD_DEFAULT);
            $req = "UPDATE {$table} SET {$colMdp}={$db->esc($mdp)} WHERE {$colPk}={$obj->$colPk}";  
            $db->xeq($req);  
    }
}
}
