<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; color: #74787E; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
<style>
    @media  only screen and (max-width: 800px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media  only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
        }
    }

    tr.border_bottom td {
        border-bottom:1pt solid black;
    }

    table {
        border-spacing: 2.5px;
    }
</style>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
    <tr>
        <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
            <table class="content" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                <tr>
                    <td class="header" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 25px 0; text-align: center;">
                        <a href="http://emscomplete.app" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #bbbfc3; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
                            Daily Education Department Update
                        </a>
                    </td>
                </tr>

                <!-- Email Body -->
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #FFFFFF; border-bottom: 1px solid #EDEFF2; border-top: 1px solid #EDEFF2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                        <table class="inner-body" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #FFFFFF; margin: 0 auto; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                            <!-- Body content -->
                            <tr>
                                <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
                                    <h1 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 19px; font-weight: bold; margin-top: 0; text-align: left;">{{ date('M d, Y') }}</h1>







                                    <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 10px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                                        <tr>
                                            <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                                    <tr>
                                                        <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                                                            <table border="0" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; ">
                                                                <tr class="border_bottom" style="background-color: #C1BDBD; border-radius: 15px;">
                                                                    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">



                                                                        @if($task)
                                                                            <strong>Tasks completed by the education department </strong>.
                                                                            <ol>
                                                                                @foreach($task as $row)
                                                                                    <li>
                                                                                        {!!$row->task!!}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ol>
                                                                        @else
                                                                            <h3>No tasks were marked complete on todays date.</h3>
                                                                        @endif
                                                                    </td>
                                                                </tr>


                                                                <tr class="border_bottom" style="background-color: #C1BDBD; border-radius: 15px;">
                                                                    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">



                                                                        @if(count($cpr) > 0)
                                                                            <strong>CPR Classes completed by the education department </strong>.
                                                                            <ol>
                                                                                @foreach($cpr as $row)
                                                                                    <li>
                                                                                        {{$row->teacher->first_name or ''}} {{$row->teacher->last_name or ''}} - {{$row->facility->name or ''}}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ol>
                                                                        @else
                                                                            <h3>No CPR Classes intructed on todays date.</h3>
                                                                        @endif

                                                                    </td>

                                                                </tr>

                                                                <tr class="border_bottom" style="background-color: #C1BDBD; border-radius: 15px;">
                                                                    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">



                                                                        @if(count($ceu) > 0)
                                                                            <strong>CEU Classes completed by the education department </strong>.
                                                                            <ol>
                                                                                @foreach($ceu as $row)
                                                                                    <li>
                                                                                        {{$row->instruct->first_name}} {{$row->instruct->last_name}} - {{$row->class_dates->course->title}} -- {{$row->class_dates->location}}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ol>
                                                                        @else
                                                                            <h3>No CEU Classes intructed on todays date.</h3>
                                                                        @endif

                                                                    </td>

                                                                </tr>

                                                                <tr class="border_bottom" style="background-color: #C1BDBD; border-radius: 15px;">
                                                                    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">



                                                                        @if($encounter)
                                                                            <strong>Employee Encounters/Notes by the education department </strong>.
                                                                            <ol>
                                                                                @foreach($encounter as $row)
                                                                                    <li>
                                                                                        <table>
                                                                                            <tr><th>{{$row->Employee->first_name or ''}} {{$row->Employee->last_name or ''}} </th></tr>

                                                                                            <tr>
                                                                                                <td>{{$row->Policies->title or ''}}</td>
                                                                                            </tr>

                                                                                            <tr>
                                                                                                <td><strong>Note / Incident</strong></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>{!!$row->incident_report or ''!!}</td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td><strong>Note / Plan of Action</strong></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>{!!$row->plan or ''!!}</td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ol>
                                                                        @else
                                                                            <h3>No Employee Encounters / Notes on todays date.</h3>
                                                                        @endif

                                                                    </td>

                                                                </tr >

                                                                <tr class="border_bottom" style="background-color: #C1BDBD; border-radius: 15px;">
                                                                    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">



                                                                        @if($taskp)
                                                                            <strong>Tasks in process by the education department </strong>.
                                                                            <ol>
                                                                                @foreach($taskp as $row)
                                                                                    <li>
                                                                                        {!!$row->task!!}

                                                                                        @if($row->notes)
                                                                                            <ul>
                                                                                                @foreach($row->notes as $nrow)
                                                                                                    <li>{{ Carbon\Carbon::parse($nrow->created_at)->format('m-d') }} - {!! $nrow->note !!}</li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        @endif
                                                                                    </li>
                                                                                @endforeach
                                                                            </ol>
                                                                        @else
                                                                            <h3>No tasked currently marked as in progress.</h3>
                                                                        @endif
                                                                    </td>

                                                                </tr>


                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 30px auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                                        <tr>
                                            <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">

                                            </td>
                                        </tr>
                                    </table>
                                    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Thanks,<br>
                                        Your Education Department</p>


                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                        <table class="footer" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                            <tr>
                                <td class="content-cell" align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
                                    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: #AEAEAE; font-size: 12px; text-align: center;">© 2019 Medidex Solutions. All rights reserved.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>