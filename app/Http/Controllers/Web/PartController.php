<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\Part;

use Carbon;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach (range(1, $request->qty) as $i) {
            $part = new Part;

            $part->pid = $request->pid;
            $part->date_recieved = Carbon::now()->format('Y-m-d');

            $part->save();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //dd($request->pid);
        $parts = Part::whereNull('date_used')->where('pid', $request->pid)->take($request->qty)->get();

        //dd($parts);

        foreach ($parts as $i) {
            $part = Part::find($i->id);

            $part->date_used = Carbon::now()->format('Y-m-d');

            $part->save();
        }
        return back();

    }

    public function destroyMulti(Request $request)
    {
        //Get Task Id//

        $task = $request->used_on;

        // Check and see if request to remove part existis
        if ($request->part) {
            $part = $request->part;

            //Run over each part to remove//


            foreach ($request->part['pid'] as $key => $value) {
                //dd($part['qty'][0]);
                $parts = Part::whereNull('date_used')->where('pid', $value)->take($part['qty'][$key])->get();
                
                //Remove each part and update //
                
                foreach ($parts as $i) {
                    $part = Part::find($i->id);

                    $part->date_used = Carbon::now()->format('Y-m-d');
                    $part->used_on = $task;
                    $part->save();
                }
            }
        }

        return back();

    }
}
