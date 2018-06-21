<?php

namespace App\Persistence;

use App\Model\User;
use Doctrine\ORM\EntityManager;

class UserDAO extends BaseDAO
{

    public function __construct(EntityManager $db)
    {
        $this->em = $db;
    }

    /**
     * @param $id
     * @return User|null
     */
    public function getById($id)
    {
        try {
            $query = $this->em->createQuery("SELECT u FROM App\Model\User AS u WHERE u.id = :id");
            $query->setParameter('id', $id);
            $usuario = $query->getOneOrNullResult();
        } catch (\Exception $e) {
            $usuario = null;
        }

        return $usuario;
    }

}
