<?php

namespace ContactsBundle\Controller;

use ContactsBundle\Entity\Address;
use ContactsBundle\Entity\Contact;
use ContactsBundle\Entity\Email;
use ContactsBundle\Entity\Phone;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends Controller
{
    /**
     * @Route("/new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $form = $this
            ->createFormBuilder($contact)
            ->setAction($this->generateUrl('contacts_contact_new'))
            ->add('name', 'text')
            ->add('surname', 'text')
            ->add('description', 'text')
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()){
            $em = $this
                ->getDoctrine()
                ->getManager();
            $em->persist($contact);
            $em->flush();
            return $this->redirectToRoute('contacts_contact_show', ['id' => $contact->getId()]);


        }
        return [ 'form' => $form->createView()];
    }

    /**
     * @Route("/{id}/modify")
     * @Template()
     */
    public function modifyAction($id, Request $request)
    {
        $contact = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Contact')
            ->find($id);

        if(!$contact){
            throw $this->createNotFoundException('Contact not found');
        }

        $form = $this
            ->createFormBuilder($contact)
            ->add('name', 'text')
            ->add('surname', 'text')
            ->add('description', 'text')
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

        return [ 'form' => $form->createView()];
    }

    /**
     * @Route("/{id}/delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $contact = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Contact')
            ->find($id);
        if(!$contact){
            throw $this
                ->createNotFoundException('Contact not found');
        }

        $em = $this
            ->getDoctrine()
            ->getManager();
        $em->remove($contact);
        $em->flush();

        return $this->redirectToRoute('contacts_contact_showall');
    }

    /**
     * @Route("/{id}")
     * @Template()
     */
    public function showAction($id)
    {
        $contact = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Contact')
            ->find($id);
        if(!$contact){
            throw $this->createNotFoundException('Contact not found');
        }

        return ['contact' => $contact];

    }

    /**
     * @Route("/")
     * @Template()
     */
    public function showAllAction()
    {
        $contacts = $this
            ->getDoctrine()
            ->getRepository("ContactsBundle:Contact")
            ->findAllContactsSortByName();

        return ['contacts' => $contacts];
    }


    /**
     * @Route("/{id}/addAddress")
     * @Template()
     *
     */
    public function addAddressAction($id, Request $request)
    {
        $contact = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Contact')
            ->find($id);

        if(!$contact){
            throw $this->createNotFoundException('Contact not found');
        }

        $addresses = new Address();

        $form = $this
            ->createFormBuilder($addresses)
            ->setAction($this->generateUrl('contacts_contact_addaddress', ['id' => $contact->getId()]))
            ->add('city', 'text')
            ->add('steet','text')
            ->add('houseNumber', 'text')
            ->add('floatNumber', 'text')
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if($form->isValid()){
            $contact->addAddress($addresses);
            $addresses->setContact($contact);
            $em = $this
                ->getDoctrine()
                ->getManager();
            $em->persist($contact);
            $em->persist($addresses);
            $em->flush();
            return $this->redirectToRoute('contacts_contact_show', ['id' => $contact->getId()]);

        }

        return [ 'form' => $form->createView()];
    }
    /**
     * @Route("/{id}/addEmailAddress")
     * @Template()
     *
     */
    public function addEmailAddressAction($id, Request $request)
    {
        $contact = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Contact')
            ->find($id);

        if(!$contact){
            throw $this->createNotFoundException('Contact not found');
        }

        $email = new Email();

        $form = $this
            ->createFormBuilder($email)
            ->setAction($this->generateUrl('contacts_contact_addemailaddress', ['id' => $contact->getId()]))
            ->add('address', 'text')
            ->add('type','text')
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if($form->isValid()){
            $contact->addEmailAdress($email);
            $email->setContact($contact);
            $em = $this
                ->getDoctrine()
                ->getManager();
            $em->persist($contact);
            $em->persist($email);
            $em->flush();
            return $this->redirectToRoute('contacts_contact_show', ['id' => $contact->getId()]);

        }

        return [ 'form' => $form->createView()];
    }
    /**
     * @Route("/{id}/addPhone")
     * @Template()
     *
     */
    public function addPhone($id, Request $request)
    {
        $contact = $this
            ->getDoctrine()
            ->getRepository('ContactsBundle:Contact')
            ->find($id);

        if(!$contact){
            throw $this->createNotFoundException('Contact not found');
        }

        $phone = new Phone();

        $form = $this
            ->createFormBuilder($phone)
            ->setAction($this->generateUrl('contacts_contact_addphone', ['id' => $contact->getId()]))
            ->add('number', 'text')
            ->add('type','text')
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if($form->isValid()){
            $contact->addPhone($phone);
            $phone->setContact($contact);
            $em = $this
                ->getDoctrine()
                ->getManager();
            $em->persist($contact);
            $em->persist($phone);
            $em->flush();
            return $this->redirectToRoute('contacts_contact_show', ['id' => $contact->getId()]);

        }

        return [ 'form' => $form->createView()];
    }

}
