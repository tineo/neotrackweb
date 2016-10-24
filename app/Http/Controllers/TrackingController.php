<?php

namespace App\Http\Controllers;

use App\Entities\Tienda;
use App\Entities\Track;
use Illuminate\Http\Request;

use App\Http\Requests;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\EntityManager;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;


class TrackingController extends Controller
{

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        //$track = $this->em->find('App\Entities\Tienda', 1);
        //$this->em->find('App\Entities\Track');

        $tienda = new Tienda();

        $tienda->setName("prueba2");
        $tienda->setState("ok");
        //$this->em->persist($tienda);
        //$this->em->flush();

        $query =$this->em->createQuery("SELECT u FROM App\Entities\Track u");
        $data = $query->getResult();



        //return  $tienda->getIdTienda();
            //$name = $request->input('name');
        return view('tracking.listing', array("tracks" => $data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //$name = $request->input('name');

        Log::debug($request->get('codigo'));
        $track = $this->em->find('App\Entities\Tienda', 1);

        $m = new Track();

        $m->setCodigo($request->get('codigo'));
        $m->setIdTienda($track);
        $m->setObs($request->get('obs'));
        $m->setLat($request->get('lat'));
        $m->setLng($request->get('lng'));
        $m->setNum($request->get('num'));
        $m->setUsr($request->get('usr'));

        $this->em->persist($m);
        $this->em->flush();

        if($request->file('photo') != null){

            Log::debug('Se ha subido una imagen ');

            $request->file('photo')->getClientOriginalName();

            $imageName = $m->getId() . '_'.$request->file('photo')->getClientOriginalName()
                //.'.' .$request->file('photo')->getClientOriginalExtension()
            ;

            $request->file('photo')->move(
                base_path() . '/public/images/', $imageName
            );

        }
        //$this->em->detach($m);

        return response()->json(array('obs' => $m->getObs()));



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
