<?php 
namespace AppBundle\Entity;
use AppBundle\Entity\Data;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

class ContentValidate extends Controller
{
	public function __construct(Doctrine $doctrine)
	{
	    $this->em = $doctrine->getEntityManager();
	}

	  /**
     * @Assert\NotBlank()
     */
    public $email;


     /**
     * @Assert\Choice({"male", "female", "other"})
     * @Assert\NotBlank()
     */
    public $gender;

     /**
     * @Assert\NotBlank()
     */

     public $comments;

	public function insertDB($email,$gender,$comments)
	{

		$em = $this->getDoctrine()->getManager();
		$products = $em->getRepository('AppBundle:Content')
		    ->findAllOrderedByName();

		// $this->getEntityManager()
  //           ->createQuery(
  //               'SELECT * FROM Content'
  //           )
  //           ->getResult();

	}

}

 ?>