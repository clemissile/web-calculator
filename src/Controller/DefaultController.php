<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    /**
     * Serve the frontend app
     * 
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('app.html.twig');
    }

    /**
     * Get all the results in the file
     * 
     * @Route("/api/history", name="getHistory", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns the results stored",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items()
     *     )
     * )
     * @SWG\Tag(name="history")
     * 
     * @return Response Array of JSON objects
     */
    public function history()
    {
        $data = array();

        $kernelCache = $this->container->get('kernel')->getCacheDir();
        try {
            $fichier = file($kernelCache . '/results.txt');
        } catch (\Exception $e) {
            return $this->json([]);
        }

        foreach ($fichier as $line_num => $line) {
            $tmp = explode(" ", $line);
            $res = array(
                "date"      => $tmp[0],
                "time"      => $tmp[1],
                "result"    => str_replace("\n", "", $tmp[2])
            );

            array_push($data, $res);
        }

        return $this->json($data);
    }

    /**
     * Store a new result in the file
     * 
     * @Route("/api/history", name="storeHistory", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a success message",
     *     @SWG\Schema(
     *         type="string"
     *     )
     * )
     * @SWG\Tag(name="history")
     * 
     * @param   Request     $request
     * @return  Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $filesystem = new Filesystem();
        $kernelCache = $this->container->get('kernel')->getCacheDir();
        $file = $kernelCache . '/results.txt';
        $res = date('d/m/Y H:i:s') . ' ' . $data['answer'] . "\n";

        $filesystem->touch($file);
        $filesystem->appendToFile($file, $res);

        return $this->json(['message' => 'Résultat stocké avec succès']);
    }

    /**
     * Delete the file containing the result history
     * 
     * @Route("/api/history", name="deleteHistory", methods={"DELETE"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a success message",
     *     @SWG\Schema(
     *         type="string"
     *     )
     * )
     * @SWG\Tag(name="history")
     * 
     * @return Response
     */
    public function deleteHistory()
    {
        $filesystem = new Filesystem();
        $kernelCache = $this->container->get('kernel')->getCacheDir();
        $file = $kernelCache . '/results.txt';

        $filesystem->remove($file);

        return $this->json(['message' => 'Fichier supprimé avec succès']);
    }

}
