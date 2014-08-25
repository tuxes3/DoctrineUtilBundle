<?php
/**
 * Created by PhpStorm.
 * User: nicolosinger
 * Date: 24.08.14
 * Time: 22:00
 */

namespace TX3\DoctrineUtilBundleEntity;


use Doctrine\ORM\EntityRepository;

class TranslationRepo extends EntityRepository
{

    public function id($class, $field, $content)
    {
        $trans = $this->createQueryBuilder('t')
            ->where('t.class = :class')
            ->andWhere('t.field = :field')
            ->andWhere('t.content = :content')
            ->setParameters(array(
                'class' => $class,
                'field' => $field,
                'content' => $content
            ))->getQuery()->getOneOrNullResult();
        if ($trans == null)
        {
            return -1;
        }
        else
        {
            return $trans->getObjid();
        }
    }

} 