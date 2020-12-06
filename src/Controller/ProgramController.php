<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/programs", name="program_")
 */

class ProgramController extends AbstractController
{
    /**
     * Show all rows from Program’s entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }

    /**
     * Getting a program by id
     *
     * @Route("/show/{program_id<^[0-9]+$>}", name="show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id": "id"}})
     * @return Response
     */
    public function show(Program $program): Response
    {

        $seasons = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findAll();


      //  if (!$program) {
          //  throw $this->createNotFoundException(
          //      'No program with id : '.$program.' found in program\'s table.'
         //   );
       // }
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }

    /**
     * Getting a program and season by id
     *
     * @Route("/{program_id<^[0-9]+$>}/season/{season_id<^[0-9]+$>}", methods={"GET"}, name="season_show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id": "id"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"season_id": "id"}})
     * @return Response
     */
    public function showSeason(Program $program, Season $season): Response
    {

        //if (!$program) {
           // throw $this->createNotFoundException(
             //   'No program with id : '.$program.' found in program\'s table.'
          //  );
      //  }

       // if (!$season) {
        //    throw $this->createNotFoundException(
         //       'No season with id : '.$season.' found for program with id ' .$program.' in season\'s table.'
          //  );
      //  }

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }

    /**
     * Getting a program and season by id
     *
     * @Route("/{program_id<^[0-9]+$>}/season/{season_id<^[0-9]+$>}/episode/{episode_id<[0-9]+$>}", methods={"GET"}, name="episode_show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id": "id"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"season_id": "id"}})
     * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"episode_id": "id"}})
     * @return Response
     */

    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
           'program' => $program,
           'season' => $season,
           'episode' => $episode,
        ]);
    }
}