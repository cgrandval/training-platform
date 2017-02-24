<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\PoolVideo;
use AppBundle\Form\PoolVideoType;


class BackendController extends Controller
{
	public function managePoolVideoAction()
	{

		$listPoolVideo = $this->getDoctrine()->getManager()->getRepository('AppBundle:PoolVideo')->findAll();

		return $this->render('Backend/listePoolVideo.html.twig',array(
						'listPoolVideo' => $listPoolVideo,
					));
	}



	public function addPoolVideoAction(Request $request)
	{
		$poolVideo = new PoolVideo();

		$form = $this->createForm(PoolVideoType::class, $poolVideo);

		if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($poolVideo);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Pool Video bien enregistrée');
            }

            return $this->redirectToRoute('pool_video_manage');
        }

		return $this->render('Backend/addPoolVideo.html.twig', array('form' => $form->createView()));
	}



	public function modifPoolVideoAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$poolVideo = $em->getRepository('AppBundle:PoolVideo')->find($id);

		if (null == $poolVideo) {
			throw new NotFoundHttpException("Error Pool Video with id ".$id." don't exist.");
		}

		$form = $this->createForm(PoolVideoType::class, $poolVideo);

		if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                //$em = $this->getDoctrine()->getManager();
                $em->persist($poolVideo);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Pool Video bien enregistrée');
            }

            return $this->redirectToRoute('pool_video_manage');
        }

		return $this->render('Backend/modifPoolVideo.html.twig', array('form' => $form->createView()));
	}



	public function deletePoolVideoAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$poolVideo = $em->getRepository('AppBundle:PoolVideo')->find($id);

		if (null == $poolVideo) {
			throw new NotFoundHttpException("Error Pool Video with id ".$id." don't exist.");
		}


		$em->remove($poolVideo);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info',"l'annonce est bien supprimée.");

        return $this->redirectToRoute('pool_video_manage');  
	}




}