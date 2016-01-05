<?php  
namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use AppBundle\Entity\ContentValidate;


class formController extends Controller
{
    /**
     * @Route("/form")
     */
    public function form()
    {
  
        return $this->render('default/form.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);

  
    }

    /**
     * @Route("/processForm")
     */
    public function processForm(Request $request)
    {

        // Form Data
        $email = $request->request->get('email');
        $gender = $request->request->get('gender');
        $comments = $request->request->get('comments');

        // use ContentValiadate Class to check parameters
        $content = new ContentValidate();
        $content->email = $email;
        $content->gender = $gender;
        $content->comments = $comments;

        // validator set up
        $validator = $this->get('validator');
        $errors = $validator->validate($content);

        // Check for any errors 
        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;

            // return to form page if any errors
            return $this->render('default/form.html.twig', [
                'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            ]);
        }

        // User class method to insert into DB
        $content->insertDB($content->email, $content->gender, $content->comments);

        return $this->render('default/form.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);

  
    }

}
?>