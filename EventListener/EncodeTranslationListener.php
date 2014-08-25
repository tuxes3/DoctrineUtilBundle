<?php
/**
 * Created by PhpStorm.
 * User: nicolosinger
 * Date: 24.08.14
 * Time: 16:41
 */

namespace TX3\DoctrineUtilBundle\EventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\Annotations\Reader;
use TX3\DoctrineUtilBundle\Annotations\Translatable;


class EncodeTranslationListener
{

    private $reader;
    private $request;
    private $locales;

    public function __construct(Reader $reader, $param)
    {
        // initialise Doctrine Reader
        $this->reader = $reader;//get annotations reader
        $this->locales = $param['locales'];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();
    }



    public function preUpdate(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();
        $em = $event->getEntityManager();
        $reflectionProperties = new \ReflectionClass($entity);
        $properties = $reflectionProperties->getProperties();
        $names = array();
        $names['props'] = array();
        foreach ($properties as $prop)
        {
            $annotation = $this->reader->getPropertyAnnotation(
                $prop,
                get_class(new Translatable(array()))
            );
            $property = $prop->getName();
            if ($annotation != null && !empty($property))
            {
                if ($annotation->value)
                {
                    $names['store'] = $property;
                }
                else
                {
                    $names['props'][] = $property;
                }
            }
        }
        if (array_key_exists('store',$names))
        {
            foreach($entity->{'get'.ucfirst($names['store'])}() as $translation)
            {
                $em->persist($translation);
            }
            $em->flush();
        }
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
}
