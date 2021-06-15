<?php

namespace App\Http\Controllers\Donasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminModel\AktivitasDonasi;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DetailDonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = AktivitasDonasi::where('is_active', true)->get();
        return view('pages.donasi.detaildonasi', [
            'items' => $items
        ]);
    }


    public function getEventStream()
    {
        $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
        $random_string = chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90));


        $data = AktivitasDonasi::where('is_active', true)->get();


        $response = new StreamedResponse();

        $response->setCallback(function () use ($data, $time) {
            $data['execution_time'] = $time;
            echo 'data: ' . json_encode($data) . "\n\n";
            //echo "retry: 100\n\n"; // no retry would default to 3 seconds.
            //echo "data: Hello There\n\n";
            ob_flush();
            flush();
            //sleep(10);
            usleep(200000);
        });

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('X-Accel-Buffering', 'no');
        $response->headers->set('Cach-Control', 'no-cache');
        $response->send();
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
