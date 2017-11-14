<?php

namespace AddrBookBundle\Controller;

use AddrBookBundle\Entity\Email;
use AddrBookBundle\Entity\Person;
use AddrBookBundle\Entity\Address;
use AddrBookBundle\Entity\Phone;
use AddrBookBundle\Form\EmailType;
use AddrBookBundle\Form\PersonType;
use AddrBookBundle\Form\AddressType;
use AddrBookBundle\Form\PhoneType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends Controller
{
    /**
     * @Route("/new", name="new")
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $person = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();
            $lastPersonId = $person->getId();

            return $this->redirectToRoute("show_id", ['id' => $lastPersonId]);
        }

        return $this->render('AddrBookBundle::new_person.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/{id}/modify", name="modify_id")
     * @param Request $request
     * @param Person $person
     * @return Response
     */
    public function modifyAction(Request $request, Person $person)
    {

        $em = $this->getDoctrine()->getManager();
        $emails = $em->getRepository('AddrBookBundle:Email')
            ->findByPerson($person);
        $phones = $em->getRepository(Phone::class)
            ->findByPerson($person);
        $em = $this->getDoctrine()->getManager();
        $addresses = $em->getRepository('AddrBookBundle:Address')
            ->findByPerson($person);

        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $person = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute("show_id", ['id' => $person->getId()]);
        }


        $address = new Address();
        $address->setPerson($person);
        $form2 = $this->createForm(AddressType::class, $address);
        $form2->handleRequest($request);
        if ($form2->isSubmitted()) {

            $address = $form2->getData();

            $em = $this->getDoctrine()->getManager();


            $em->persist($address);
            $em->flush();

            return $this->redirectToRoute("show_id", ['id' => $person->getId()]);
        }


        $email = new Email();
        $email->setPerson($person);
        $form3 = $this->createForm(EmailType::class, $email);
        $form3->handleRequest($request);
        if ($form3->isSubmitted()) {

            $email = $form3->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($email);
            $em->flush();

            return $this->redirectToRoute("show_id", ['id' => $person->getId()]);
        }

        $phone = new Phone();
        $phone->setPerson($person);
        $form4 = $this->createForm(PhoneType::class, $phone);
        $form4->handleRequest($request);
        if ($form4->isSubmitted()) {

            $phone = $form4->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($phone);
            $em->flush();

            return $this->redirectToRoute("show_id", ['id' => $person->getId()]);
        }


        return $this->render(
            'AddrBookBundle::edit_person.html.twig',
            [
                'form' => $form->createView(),
                'form2' => $form2->createView(),
                'form3' => $form3->createView(),
                'form4' => $form4->createView(),
                'addresses' => $addresses,
                'emails' => $emails,
                'phones' => $phones,
            ]
        );

    }

    /**
     * @Route("/{id}/delete", name="delete")
     * @Method("GET")
     * @param Person $person
     * @return Response
     */
    public function deleteAction(Person $person)
    {
        $em = $this->getDoctrine()->getManager();
        if (!$person) {
            return $this->redirectToRoute("index");
        }
        $em->remove($person);
        $em->flush();

        return $this->redirectToRoute("index");
    }

    /**
     * @Route("/{id}", name="show_id")
     * @Method("GET")
     * @param Person $person
     * @return Response
     */
    public function showAction(Person $person)
    {
        if (!$person) {
            return $this->redirectToRoute("index");
        }

        $em = $this->getDoctrine()->getManager();
        $addresses = $em->getRepository('AddrBookBundle:Address')
            ->findByPerson($person);
        $emails = $em->getRepository('AddrBookBundle:Email')
            ->findByPerson($person);
        $phones = $em->getRepository(Phone::class)
            ->findByPerson($person);

        return $this->render(
            'AddrBookBundle::show_person.html.twig',
            [
                'person' => $person,
                'addresses' => $addresses,
                'emails' => $emails,
                'phones' => $phones,

            ]
        );
    }

    /**
     * @Route("/", name="index")
     * @Method("GET")
     * @return Response
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('AddrBookBundle:Person')
            ->findBy([], ['surname' => 'ASC']);

        return $this->render('AddrBookBundle::show_all_person.html.twig', ['person' => $person]);
    }


}
