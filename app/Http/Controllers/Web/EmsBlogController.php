<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\Companies;
use Vanguard\Http\Controllers\Controller;

use Vanguard\Station;
use Vanguard\TrainingBlog;
use Vanguard\EmployeePositions;
use Vanguard\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Vanguard\Mail\NewBlogMail;


use Carbon;

class EmsBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = TrainingBlog::orderBy('date_to_send', 'DESC')->get();

        return view('blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ep = EmployeePositions::orderBy('label')->get();
        $stations = Station::get();
        $companies = Companies::get();

        return view('blog.create', compact('ep', 'stations', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->hasFile('pdf'));

        $send = $request->input('send_to)');

        $blog = new TrainingBlog;

        $blog->date_to_send = $request->date_to_send_submit;
        $blog->author = $request->author;
        $blog->title = $request->title;
        $blog->content = $request->blog;
        $blog->uploaded_by = auth()->User()->id;
        $blog->status = 1;
        $blog->send_to = json_encode($request->send_to);
        $blog->companies = json_encode($request->companies);
        $blog->stations = json_encode($request->stations);

        $blog->save();

        if ($request->hasFile('pdf')) {
          //  dd('has file');
            $allowedfileExtension = ['jpg', 'png', 'PNG', 'pdf', 'PDF'];

            $files = $request->file('pdf');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);

//dd($check);

                if ($check) {


                    foreach ($request->pdf as $attachment) {


                        $filename = $attachment->storeAs('blogAttachment', $blog->id . '.pdf');

                        $attachment = TrainingBlog::findorfail($blog->id);
                        $attachment->file = $filename;
                        $attachment->save();


                    }


                } else {
                    return back()->with('error', 'Sorry your attachment did not attach you can only attach a PDF, PNG, or JPG file.');


                }

            }

        }

        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $training_blog = TrainingBlog::find($id);

        // dd($blog);

        return view('blog.show', compact('training_blog'));
    /*
        if ($blog) {
            foreach ($blog as $row) {

                $groups = json_decode($row->send_to, TRUE);

                //dd($groups);

                foreach ($groups as $key => $group) {
                    $users = Employee::where('primary_position', $group)->get()->toArray();


                    Mail::to($users)->send(new NewBlogMail($row));

                }
            }
        }
    */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
