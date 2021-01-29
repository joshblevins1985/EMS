<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Certification;
use Vanguard\Http\Controllers\Controller;


use Illuminate\Http\Request;

class CertificateController extends Controller
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
        $issue_date = ($request->issue_date ? date('Y-m-d', strtotime($request->issue_date)) : Null);
        $expiration_date= ($request->expiration_date ? date('Y-m-d', strtotime($request->expiration_date)) : Null);

        $certificate = new Certification;

        $certificate->user_id = $request->user_id;
        $certificate->certificate_number = $request->certificate_number;
        $certificate->state = $request->state;
        $certificate->issue_date = $issue_date;
        $certificate->expiration_date = $expiration_date;
        $certificate->type = $request->type;
        $certificate->status = $request->status;
        $certificate->save();
        //dd($request->hasfile('cert'));
        if ($request->hasFile('cert')) {
            //  dd('has file');
            //$allowedfileExtension = ['jpg', 'JPG', 'png', 'PNG'];


            $file = $request->cert;

            $extension = 'png';
            $filename = 'empcert_'. time() . '.'.$extension;

            $publicfile = $file->storeAs('public/certificates', $filename);

            $attachment = Certification::findorfail($certificate->id);
            $attachment->file = $filename;
            $attachment->save();

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
