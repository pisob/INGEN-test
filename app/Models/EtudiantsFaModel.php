<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class EtudiantsFaModel extends Model
{
    protected $table      = 'etudiants';
    protected $primaryKey = 'etudiants_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['etudiant_gender', 'etudiant_nameFirst', 'etudiant_nameLast','etudiant_email', 'etudiant_phone'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
    protected $cleanValidationRules = true; 
}