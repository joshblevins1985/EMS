<?php

namespace Vanguard\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Vanguard\Employee;
use Vanguard\ItSupportTicket;
use Vanguard\Notifications\NewSupportRequest;

/**
 * Class CountriesController
 * @package Vanguard\Http\Controllers\Api
 */
class AssetController extends ApiController
{

    public function newSupportApi(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $employee = Employee::where('email', $data['sender'])->first();


        if ($request) {

            $tasks = ItSupportTicket::whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])->get();

            $task_id = Carbon::now()->format('y') . '-' . count($tasks);

            $support = new ItSupportTicket();
            $support->description = $data['content']['body'] ;
            $support->priority = 3;
            $support->status = 1;
            $support->task_id = $task_id;
            if($employee) {$support->reported_by = $employee->user_id;}
            $support->reported_by_email = $data['sender'];
            $support->save();

            $support->notify(new NewSupportRequest($support));

            return response('Hello World', 200)
                ->header('Content-Type', 'text/plain');
        } else {
            return response('Hello World', 406)
                ->header('Content-Type', 'text/plain');
        }

    }

}
