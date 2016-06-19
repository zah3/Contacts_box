<?php

namespace ContactsBundle\Controller;

use ContactsBundle\Entity\Email;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route ("/Email")
 */
class EmailController extends Controller
{

    /**
     * @Route("/{id}")
     * @Template()
     */
    public function showAction($id)
    {
        $email = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Email')
            ->find($id);
        if(!$email){
            throw $this->createNotFoundException('Email not found');
        }

        return ['email' => $email];
    }

    /**
     * @Route("/{id}/modify")
     * @Template()
     */
    public function modifyAction($id, Request $request)
    {

        $email = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Email')
            ->find($id);

        if(!$email){
            throw $this->createNotFoundException('Email not found');
        }

        $form= $this
            ->createFormBuilder($email)
            ->setAction($this->generateUrl('contacts_email_modify', ['id' => $email->getId()]))
            ->add('address', 'text')
            ->add('type','text')
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->flush();

            return $this->redirectToRoute('contacts_contact_showall');
        }

        return [ 'form' => $form->createView()];}

    /**
     * @Route("/{id}/showAll")
     * @Template("ContactsBundle:Email:showAll.html.twig")
     */
    public function showAllAction($id)
    {
        $emails = $this
            ->getDoctrine()
            ->getRepository("ContactsBundle:Email")
            ->showAllByContact($id);

        return ['emails' => $emails];
    }

    /**
     * @Route("/{id}/deleteAddress")
     * @Template()
     */
    public function deleteAddressAction($id)
    {
        $email = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Email')
            ->find($id);
        if(!$email){
            throw $this
                ->createNotFoundException('Email not found');
        }

        $em = $this
            ->getDoctrine()
            ->getManager();
        $em->remove($email);
        $em->flush();

        return $this->redirectToRoute('contacts_contact_showall');
    }

}
