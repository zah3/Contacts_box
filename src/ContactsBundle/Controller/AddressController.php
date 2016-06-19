<?php

namespace ContactsBundle\Controller;

use ContactsBundle\Entity\Address;
use ContactsBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AddressController
 * @Route("/Address")
 */
class AddressController extends Controller
{

    /**
     * @Route("/{id}")
     * @Template()
     */
    public function showAction($id)
    {
        $address = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Address')
            ->find($id);
        if(!$address){
            throw $this->createNotFoundException('Address not found');
        }

        return ['address' => $address];
    }

    /**
     * @Route("/{id}/modify")
     * @Template()
     */
    public function modifyAction($id, Request $request)
    {

        $address = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Address')
            ->find($id);

        if(!$address){
            throw $this->createNotFoundException('Address not found');
        }

        $form= $this
            ->createFormBuilder($address)
            ->setAction($this->generateUrl('contacts_address_modify', ['id' => $address->getId()]))
            ->add('city', 'text')
            ->add('steet','text')
            ->add('houseNumber', 'text')
            ->add('floatNumber', 'text')
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
     * @Template("ContactsBundle:Address:showAll.html.twig")
     */
    public function showAllAction($id)
    {
        $addresses = $this
            ->getDoctrine()
            ->getRepository("ContactsBundle:Address")
            ->showAllByContact($id);

        return ['addresses' => $addresses];
    }

    /**
     * @Route("/{id}/deleteAddress")
     * @Template()
     */
    public function deleteAddressAction($id)
    {
        $address = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Address')
            ->find($id);
        if(!$address){
            throw $this
                ->createNotFoundException('Address not found');
        }

        $em = $this
            ->getDoctrine()
            ->getManager();
        $em->remove($address);
        $em->flush();

        return $this->redirectToRoute('contacts_contact_showall');
    }

}
