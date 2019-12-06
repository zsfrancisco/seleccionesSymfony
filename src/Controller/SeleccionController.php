<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Jugador;
use App\Entity\Equipo;
use App\Entity\Pais;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

use App\Form\JugadorType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class SeleccionController extends AbstractController
{
    /**
     * @Route("/", name="seleccion")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Jugador::class);
        $jugadores = $repository->findAll();

        return $this->render('seleccion/index.html.twig', [
            'jugadores' => $jugadores
        ]);
    }

    /**
     * @Route("/agregar", name="agregar")
     */
    public function agregar(Request $request)
    {
        $jugador = new Jugador();

        $form = $this->createForm(JugadorType::class, $jugador);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $jugador = $form->getData();
            $entityManager->persist($jugador);
            $entityManager->flush();

            $this->addFlash('Exito', '¡El registro del juga$jugador se ha creado!');
    
            return $this->redirectToRoute('seleccion');
        }

        return $this->render('seleccion/agregar.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/editar/{id}", name="editar")
     */
    public function editar($id, Request $request)
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $jugador = $entityManager->getRepository(Jugador::class)->find($id);

        if (!$jugador) {
            throw $this->createNotFoundException(
                'No se encontro ningún jugador con el id '.$id
            );
        }

        $form = $this->createFormBuilder($jugador)
            ->add('nombre')
            ->add('edad')
            ->add('pais_jugador', EntityType::class,[
                'class' => Pais::class,
                'choice_label'=>'nombre_pais'
            ])
            ->add('equipo_jugador', EntityType::class,[
                'class' => Equipo::class,
                'choice_label'=>'nombre'
            ])
            ->add('editar', SubmitType::class)

            ->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $jugador = $form->getData();
            $entityManager->flush();
    
            $this->addFlash('Exito', '¡La información del jugador se ha actualizado!');

            return $this->redirectToRoute('seleccion');
        }
        
        return $this->render('seleccion/editar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/eliminar/{id}", name="eliminar")
     */
    public function eliminar($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $jugador = $entityManager->getRepository(Jugador::class)->find($id);

        if (!$jugador) {
            throw $this->createNotFoundException(
                'No se encontro ningún jugador con el id '.$id
            );
        }

        $entityManager->remove($jugador);

        $this->addFlash('Exito', '¡El registro del jugador se ha hecho!');

        $entityManager->flush();

        return $this->redirectToRoute('seleccion');
    }


}
