<?php

namespace AddrBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    /**
     * @Route("/{id}/delete-address", name="delete_address_id")
     * @return Response
     */
    public function deleteAddressAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $address = $em->getRepository('AddrBookBundle:Address');
        if (!$address) {
            return $this->redirectToRoute("index");
        }
        $em->remove($address);
        $em->flush();

        return $this->redirectToRoute('modify_id', ['id' =>$id]);
    }
}
