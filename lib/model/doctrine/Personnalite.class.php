<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Personnalite extends BasePersonnalite
{
  public function __tostring() {
    return $this->getNom();
  }

  /*  public function save(Doctrine_Connection $conn = null) {
    Doctrinue::getTable('Personnalite')->hasChanged();
    return parent::save($conn);
    }*/
  public function getPageLink() {
    return null;
  }
  public function getPhoto() {
    return null;
  }

  public function setDateNaissance($str) {
    if (preg_match('/(\d{2})\/(\d{2})\/(\d{4})/', $str, $m)) {
      $this->_set('date_naissance', $m[3].'-'.$m[2].'-'.$m[1]);
    }
  }

}
