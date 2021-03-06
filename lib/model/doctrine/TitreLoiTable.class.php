<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TitreLoiTable extends Doctrine_Table
{

  public function findLightLoi($id) {
    $loiarr = Doctrine_Query::create()
      ->select('t.titre, t.nb_articles, t.id')
      ->from('TitreLoi t')
      ->where('t.texteloi_id = ?', $id)
      ->andWhere('t.chapitre IS NULL')
      ->andWhere('t.section IS NULL')
      ->fetchOne();
    if (!$loiarr) return null;
    else {
       $loi = new TitreLoi();
       $loi->titre = $loiarr['titre'];
       $loi->nb_articles = $loiarr['nb_articles'];
       $loi->texteloi_id = $id;
       $loi->id = $loiarr['id'];
       return $loi;
    }
  }

  public function findLoi($numero) {
    $query = $this->createQuery('t')
      ->where('t.texteloi_id = ?', $numero)
      ->andWhere('t.chapitre IS NULL')
      ->andWhere('t.section IS NULL');
    return $query->fetchOne();
  }

  public function findLoiOrCreate($numero) {
    $loi = $this->findLoi($numero);
    if (!$loi) {
      $loi = new TitreLoi();
      $loi->texteloi_id = $numero;
      $loi->nb_articles = 0;
      $loi->save();
    }
    $loi->titre_loi_id = $loi->id;
    $loi->save();
    return $loi;
  }

  public function findChapitre($loi, $numero) {
    $query = $this->createQuery('t')
      ->where('t.texteloi_id = ?', $loi)
      ->andWhere('t.chapitre = ?', $numero)
      ->andWhere('t.section IS NULL');
    return $query->fetchOne();
  } 

  public function findChapitreOrCreate($loi, $numero) {
    $chap = $this->findChapitre($loi, $numero);
    if (!$chap) {
      $chap = new TitreLoi();
      $chap->texteloi_id = $loi;
      $chap->chapitre = $numero;
      $chap->nb_articles = 0;
    }
    $chap->titre_loi_id = $this->findLoiOrCreate($loi)->id;
    $chap->save();
    return $chap;
  }

  public function findSection($loi, $chapitre, $numero) {
    $query = $this->createQuery('t')
      ->where('t.texteloi_id = ?', $loi)
      ->andWhere('t.chapitre = ?', $chapitre)
      ->andWhere('t.section = ?', $numero);
    return $query->fetchOne();
  }

  public function findSectionOrCreate($loi, $chapitre, $numero) {
    $sect = $this->findSection($loi, $chapitre, $numero);
    if (!$sect) {
      $sect =  new TitreLoi();
      $sect->texteloi_id = $loi;
      $sect->chapitre = $chapitre;
      $sect->section = $numero;
      $sect->nb_articles = 0;
    }
    $sect->titre_loi_id = $this->findChapitreOrCreate($loi, $chapitre)->id;
    $sect->save();
    return $sect;
  }


}
