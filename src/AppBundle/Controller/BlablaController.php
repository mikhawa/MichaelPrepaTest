<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Blabla;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Blabla controller.
 *
 * @Route("admin/news")
 */
class BlablaController extends Controller
{
    /**
     * Lists all blabla entities.
     *
     * @Route("/", name="admin_news_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $blablas = $em->getRepository('AppBundle:Blabla')->findAll();

        return $this->render('blabla/index.html.twig', array(
            'blablas' => $blablas,
        ));
    }

    /**
     * Creates a new blabla entity.
     *
     * @Route("/new", name="admin_news_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $blabla = new Blabla();
        $form = $this->createForm('AppBundle\Form\BlablaType', $blabla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blabla);
            $em->flush();

            return $this->redirectToRoute('admin_news_show', array('id' => $blabla->getId()));
        }

        return $this->render('blabla/new.html.twig', array(
            'blabla' => $blabla,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a blabla entity.
     *
     * @Route("/{id}", name="admin_news_show")
     * @Method("GET")
     */
    public function showAction(Blabla $blabla)
    {
        $deleteForm = $this->createDeleteForm($blabla);

        return $this->render('blabla/show.html.twig', array(
            'blabla' => $blabla,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing blabla entity.
     *
     * @Route("/{id}/edit", name="admin_news_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Blabla $blabla)
    {
        $deleteForm = $this->createDeleteForm($blabla);
        $editForm = $this->createForm('AppBundle\Form\BlablaType', $blabla);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_news_edit', array('id' => $blabla->getId()));
        }

        return $this->render('blabla/edit.html.twig', array(
            'blabla' => $blabla,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a blabla entity.
     *
     * @Route("/{id}", name="admin_news_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Blabla $blabla)
    {
        $form = $this->createDeleteForm($blabla);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($blabla);
            $em->flush();
        }

        return $this->redirectToRoute('admin_news_index');
    }

    /**
     * Creates a form to delete a blabla entity.
     *
     * @param Blabla $blabla The blabla entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Blabla $blabla)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_news_delete', array('id' => $blabla->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
