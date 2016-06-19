<?php

namespace ContactsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route ("/Phone")
 */
class PhoneController extends Controller
{

    /**
     * @Route("/{id}")
     * @Template()
     */
    public function showAction($id)
    {
        $phone = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Phone')
            ->find($id);
        if(!$phone){
            throw $this->createNotFoundException('Phone not found');
        }

        return ['phone' => $phone];
    }

    /**
     * @Route("/{id}/modify")
     * @Template()
     */
    public function modifyAction($id, Request $request)
    {

        $phone = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Phone')
            ->find($id);

        if(!$phone){
            throw $this->createNotFoundException('Phone not found');
        }

        $form= $this
            ->createFormBuilder($phone)
            ->setAction($this->generateUrl('contacts_phone_modify', ['id' => $phone->getId()]))
            ->add('number', 'text')
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
     * @Template("ContactsBundle:Phone:showAll.html.twig")
     */
    public function showAllAction($id)
    {
        $phones = $this
            ->getDoctrine()
            ->getRepository("ContactsBundle:Phone")
            ->showAllByContact($id);

        return ['phones' => $phones];
    }

    /**
     * @Route("/{id}/deleteAddress")
     * @Template()
     */
    public function deleteAddressAction($id)
    {
        $phone = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Phone')
            ->find($id);
        if(!$phone){
            throw $this
                ->createNotFoundException('Phone not found');
        }

        $em = $this
            ->getDoctrine()
            ->getManager();
        $em->remove($phone);
        $em->flush();

        return $this->redirectToRoute('contacts_contact_showall');
    }

}
