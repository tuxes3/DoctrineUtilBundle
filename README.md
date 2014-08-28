DoctrineUtilBundle
==================

Simple way to translate your entities in forms. 

Installation:
add to you composer.json
https://packagist.org/packages/tuxes3/doctrine-util-bundle

Add to your project in your AppKernel.php:

	...
	new TX3\DoctrineUtilBundle\Tuxes3DoctrineUtilBundle(),
	...
    
Annotated your entities

	...
	use TX3\DoctrineUtilBundle\Annotations as TX3;
	...
	/**
	 * @var string
	 * @TX3\Translatable()
	 */
	protected $name;
	
	/**
	 * @TX3\Translatable(true)
	 */
	protected $translations = array();
	...

Use it in a FormType

	...
	$builder->add('translations', 'translation', array(
		'label' => 'Tag Name',
	));
	...
	
A form is rendered with an input for each defined languag in config.yml:

	tuxes3_doctrine_util:
 		locales: [de,en]

Searching by translated field:

	...
	$repo = $this->em->getRepository("XXXXBundle:Tag");
	$translationRepo = $this->em->getRepository("Tuxes3DoctrineUtilBundle:Translation");
	$tag = $repo->find($translationRepo->id('Tag', 'name', $name)); // 'Tag' ===> Classname of entity, 'name' ===> fieldname
	...
	
Saving a translation in code:

	$tag = new Tag();
	$tag->setName($name);
	$this->em->persist($tag);
	$this->em->flush(); // <-- flush is important as instead the id is not set... :/
	$translation = new Translation();
	$translation->setObjid($tag->getId());
	$translation->setField('name');
	$translation->setClass('Tag');
	$translation->setContent($name);
	$translation->setLocale('en');
	$this->em->persist($translation);
	
TODO:
 * Search with language
 * more options in formtype rendering
 * ...
