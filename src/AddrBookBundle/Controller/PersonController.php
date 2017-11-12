<?php

namespace AddrBookBundle\Controller;

use AddrBookBundle\Entity\Person;
use AddrBookBundle\Entity\Address;
use AddrBookBundle\Form\PersonType;
use AddrBookBundle\Form\AddressType;
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
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $person = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute("show_id", ['id' => $person]);
        }

        $em = $this->getDoctrine()->getManager();
        $addresses = $em->getRepository('AddrBookBundle:Address')
            ->findByPerson($person);


        $address = new Address();
        $address->setPerson($person);
        $form2 = $this->createForm(AddressType::class, $address);
        $form2->handleRequest($request);
        if ($form2->isSubmitted()) {

            $address = $form2->getData();

            $em = $this->getDoctrine()->getManager();


            $em->persist($address);
            $em->flush();

            return $this->render(
                'AddrBookBundle::edit_person.html.twig',
                [
                    'form' => $form->createView(),
                    'addresses' => $addresses,
                    'form2' => $form2->createView(),
                ]
            );
        }


        return $this->render(
            'AddrBookBundle::edit_person.html.twig',
            [
                'form' => $form->createView(),
                'addresses' => $addresses,
                'form2' => $form2->createView(),
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
     * @param Request $request
     * @Method("GET")
     * @return Response
     */
    public function showAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('AddrBookBundle:Person')->find($id);
        if (!$person) {
            return $this->redirectToRoute("index");
        }

        $addresses = $em->getRepository('AddrBookBundle:Address')
            ->findByPerson($person);

        return $this->render(
            'AddrBookBundle::show_person.html.twig',
            [
                'person' => $person,
                'addresses' => $addresses,
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
