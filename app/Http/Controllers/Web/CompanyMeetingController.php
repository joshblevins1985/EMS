<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Vanguard\CompanyMeeting;


class CompanyMeetingController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = date('Y-m-d', strtotime($request->date));
        $meeting = new CompanyMeeting;
        $meeting->date = $date;
        $meeting->title = $request->title;
        $meeting->save();

        if ($request->hasFile('pdf')) {
            //  dd('has file');
            $allowedfileExtension = ['jpg', 'png', 'PNG', 'pdf', 'PDF', 'mp4', 'MP4'];

            $files = $request->file('pdf');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);

//dd($check);

                if ($check) {


                    foreach ($request->pdf as $attachment) {


                        $filename = $attachment->storeAs('meeting', 'meeting_'.$request->id . '.mp4');

                        $meeting= CompanyMeeting::findorfail($meeting->id);
                        $meeting->file = $filename;
                        $meeting->save();


                    }


                } else {

                    return back()->with('error', 'Sorry your attachment did not attach you can only attach a PDF, PNG, or JPG file.');


                }

            }

        }

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meeting = CompanyMeeting::find($id);

        return view('dashboard.partials.meetingModalBody', compact('meeting'));
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
