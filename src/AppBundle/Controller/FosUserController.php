<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FosUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fosuser controller.
 *
 * @Route("admin/fos_user")
 */
class FosUserController extends Controller
{
    /**
     * Lists all fosUser entities.
     *
     * @Route("/", name="admin_fos_user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fosUsers = $em->getRepository('AppBundle:FosUser')->findAll();

        return $this->render('fosuser/index.html.twig', array(
            'fosUsers' => $fosUsers,
        ));
    }

    /**
     * Creates a new fosUser entity.
     *
     * @Route("/new", name="admin_fos_user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fosUser = new Fosuser();
        $form = $this->createForm('AppBundle\Form\FosUserType', $fosUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fosUser);
            $em->flush();

            return $this->redirectToRoute('admin_fos_user_show', array('id' => $fosUser->getId()));
        }

        return $this->render('fosuser/new.html.twig', array(
            'fosUser' => $fosUser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fosUser entity.
     *
     * @Route("/{id}", name="admin_fos_user_show")
     * @Method("GET")
     */
    public function showAction(FosUser $fosUser)
    {
        $deleteForm = $this->createDeleteForm($fosUser);

        return $this->render('fosuser/show.html.twig', array(
            'fosUser' => $fosUser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fosUser entity.
     *
     * @Route("/{id}/edit", name="admin_fos_user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FosUser $fosUser)
    {
        $deleteForm = $this->createDeleteForm($fosUser);
        $editForm = $this->createForm('AppBundle\Form\FosUserType', $fosUser);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_fos_user_edit', array('id' => $fosUser->getId()));
        }

        return $this->render('fosuser/edit.html.twig', array(
            'fosUser' => $fosUser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fosUser entity.
     *
     * @Route("/{id}", name="admin_fos_user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FosUser $fosUser)
    {
        $form = $this->createDeleteForm($fosUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fosUser);
            $em->flush();
        }

        return $this->redirectToRoute('admin_fos_user_index');
    }

    /**
     * Creates a form to delete a fosUser entity.
     *
     * @param FosUser $fosUser The fosUser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FosUser $fosUser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_fos_user_delete', array('id' => $fosUser->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
