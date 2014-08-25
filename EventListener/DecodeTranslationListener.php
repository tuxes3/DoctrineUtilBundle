<?php
/**
 * Created by PhpStorm.
 * User: nicolosinger
 * Date: 24.08.14
 * Time: 16:41
 */

namespace TX3\DoctrineUtilBundleEventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\Annotations\Reader;
use TX3\DoctrineUtilBundleAnnotations\Translatable;
use TX3\DoctrineUtilBundleEntity\Translation;


class DecodeTranslationListener
{

    private $reader;
    private $request;
    private $locales;

    public function __construct(Reader $reader, $param)
    {
        $this->reader = $reader;//get annotations reader
        $this->locales = $param['locales'];
    }

    public function postLoad(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();
        $em = $event->getEntityManager();
        $translationRepo = $em->getRepository('Tuxes3DoctrineUtilBundle:Translation');
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
        foreach ($names['props'] as $prop)
        {
            foreach ($this->locales as $locale)
            {
                $trans = $translationRepo->findOneBy(array(
                    'field' => $prop,
                    'class' => $this->getClassName($entity),
                    'locale' => $locale,
                    'objid' => $entity->getid()
                ));
                if ($trans == null)
                {
                    $trans = new Translation();
                    $trans->setLocale($locale);
                    $trans->setClass($this->getClassName($entity));
                    $trans->setField($prop);
                    $trans->setContent('');
                    $trans->setObjid($entity->getId());
                    $em->persist($trans);
                }
                if ($this->request != null && $trans->getLocale() === $this->request->getLocale())
                {
                    $entity->{'set'.$prop}($trans->getContent());
                }
                else if($this->request == null && $trans->getLocale() === 'en')
                {
                    $entity->{'set'.$prop}($trans->getContent());
                }
                $translations = $entity->{'get'.ucfirst($names['store'])}();
                $translations[] = $trans;
                $entity->{'set'.ucfirst($names['store'])}($translations);
            }
        }
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function getClassName($obj)
    {
        $path = explode('\\', get_class($obj));
        return array_pop($path);
    }

}
