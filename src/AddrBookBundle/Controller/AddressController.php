<?php

namespace AddrBookBundle\Controller;

use AddrBookBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    /**
     * @Route("/{id}/delete-address", name="delete_address_id")
     * @param Address $address
     * @return Response
     */
    public function deleteAddressAction(Address $address)
    {
        $em = $this->getDoctrine()->getManager();
        $addresses = $em->getRepository(Address::class);
        $addr = $addresses->find($address);
        $person = $address->getPersonId();
        $person = $person->getId();
        if (!$addr) {
            return $this->redirectToRoute("index");
        }
        $em->remove($addr);
        $em->flush();

        return $this->redirectToRoute('show_id', ['id' => $person]);
    }
}
