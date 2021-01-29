<html>
<head>
    <title>Scholarship Contract</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link media="all" type="text/css" rel="stylesheet" href="https://peasi.app/public/assets/css/mdb.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://peasi.app/public/assets/css/style.min.css">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Employee / Apprentice Tuition Payment Agreement</h2>
        </div>
    </div>


    <div class="row">
        <p>This Agreement is made as of <strong>{{date('M d, Y')}}</strong> , between Portsmouth Emergency Ambulance
            Service Inc <strong>(PEASI)</strong>. and its employee/apprentice <strong>{{$student->student}}</strong>
            whom is currently employed as a <strong>EMT - Apprentice</strong> with PEASI. For and in consideration of
            the provisions set forth below and the mutual covenants and promises herein contained, the receipt and
            adequacy of which are here by acknowledged, the parties hereto, intending to be legally bound hereby, agree
            as follows.</p>
    </div>

    <div class="row">
        <div class="col-12">
            <ol>
                <li>PEASI agrees to pay, on behalf of the employee, expenses related to training of Emergency Medical
                    Technician.
                </li>
                <li>In consideration for any expenses paid by PEASI, the Employee agrees to use any training for which
                    PEASI has paid for the benefit of PEASI only for 1 year. If the Employee, while employed by PEASI,
                    provides services in direct or indirect competition with PEASI within a 25-mile radius of any PEASI
                    station, whether by employment by a competitor, self-employment, or otherwise, he/she will pay the
                    remaining balance as outlined in section 3 below. The Employee understands that this applies to any
                    services in the car, ambulette, ambulance, emergency 911, mechanic, or billing services.
                </li>
                <li>The table below illustrates the payment plan for an Employee whom may violate this contract. The
                    Employees year starts from {{date('m-d-Y')}} and will end on {{date('Y-m-d', strtotime('+1
                    years'))}}.
                </li>
                <li>Employee must remain in good standing throughout the term of this contract. Any employee not
                    considered to in good standing either by self-terminating employment or termination by other means
                    would not be considered an employee in good standing.
                </li>
                <li>All questions concerning the validity or meaning of this Agreement or relating to the rights and
                    obligations of the Parties with respect to performance under this Agreement shall be construed and
                    resolved under the laws of the State of Ohio
                </li>
                <li>The parties to this Agreement hereby designate the courts of Scioto County, Ohio, as the courts of
                    proper jurisdiction and venue for any actions or proceedings relating to this Agreement, consent to
                    such designation, jurisdiction and venue, and waive any objections or defenses relating to
                    jurisdiction or venue with respect to any action or proceedings initiated therein.
                </li>
                <li>The intention of the Parties to this Agreement is to comply with all laws and public policies, and
                    this Agreement shall be construed consistently with all such laws and public policies to the extent
                    possible. In the event that any of the provisions of this Agreement shall be held by a court of
                    competent jurisdiction to be invalid or unenforceable, the remaining provisions shall nevertheless
                    continue to be valid and enforceable as though the invalid or unenforceable portions had not been
                    included herein. In the event that any provisions of this Agreement relating to duration, territory,
                    and/or scope of restriction, and/or related aspects, shall be held by a court of competent
                    jurisdiction to exceed a maximum restrictiveness such court deems reasonable and enforceable, then
                    the duration, territory, and/or scope of restriction, and/or related aspects deemed reasonable and
                    enforceable by the court shall be construed to be the terms hereunder and be enforced.
                </li>
                <li>No failure by any party to insist upon strict compliance with any term of this Agreement, exercise
                    any option, enforce any right, or seek any remedy upon any default or any other party shall affect,
                    or constitute a waiver of, the party’s right to insist upon such strict compliance, exercise that
                    option, enforce that right, or seek that remedy with respect to that default or any prior,
                    contemporaneous, or subsequent default. No custom or practice of the parties at variance with any
                    provision of this Agreement shall affect or constitute a waiver of any party’s right to demand
                    strict compliance with all provisions of this Agreement.
                </li>
                <li>This document contains the entire agreement among the parties and supersedes any prior discussions,
                    understandings, or agreements among them respecting the subject matter of this Agreement. No
                    alterations, additions, or other changes to this Agreement shall be made or be binding unless made
                    in writing and signed by all parties to this Agreement.
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <strong><p>Employees hired under the Portsmouth Ambulance Emergency Services Inc. (PEASI) scholarship
                    program must adhere to the following additional policies and procedures. </p></strong>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <ol>
                <li>Apprentice program not to exceed the length of the EMS course (+) plus 60 calendar days.</li>
                <li>Complete all accredited institution pre-enrollment process in a timely manner.</li>
                <li>Attend all accredited institutions scheduled courses as outlined within the course syllabus.</li>
                <ol>
                    <li>PEASI has the right to deem an absence unexcused if and when:</li>
                    <ol>
                        <li>
                            The employee fails to provide documentation to substantiate an excused absence.
                        </li>
                        <li>
                            Documentation provided is deemed to be inaccurate or false.
                        </li>
                        <li>
                            Accredited institution disallows the excused absence.
                        </li>
                        <li>
                            Employee has violated PEASI Attendance Policy.
                        </li>
                        <li>
                            Attend all PEASI study sessions as outlined in PEASI course Syllabus.
                        </li>
                        <li>
                            Maintain 83% GPA in accredited institutions course
                        </li>
                        <li>
                            Employee must follow all PEASI policies and procedures
                        </li>
                    </ol>
                </ol>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <p><strong>Failure to abide by this policy will result in immediate dismissal from the program and
                    employment with PEASI.</strong></p>
        </div>
    </div>

    <div class="row" style="margin-bottom: 25px">
        <div class="col-12">
            IN WITNESS WHEREOF, THE PARTIES HERE TO HAVE EXCUTED THIS Agreement on the {{date('d')}} day of {{date('M,
            Y')}}.
        </div>
    </div>

    <div class="row" >
        <div class="col-6 border-bottom align-text-bottom" style="vertical-align: text-bottom">
            <span class="align-text-bottom">Joshua Blevins Director of Education </span>
        </div>
        
        <div class="col-6 border-bottom align-text-bottom" style="vertical-align: text-bottom">
           <span class="align-text-bottom"> {{date('M d, Y')}} </span>
        </div>
    </div>

    <div class="row">
        <div class="col-6 align-text-bottom" style="vertical-align: text-bottom">
            Employer Representative Title
        </div>
     
        <div class="col-6 align-text-bottom" style="vertical-align: text-bottom">
            Date
        </div>
    </div>

        
        
        <div class="row" style="margin-bottom: 25px">
            <div class="col-12 border-bottom">
            <img src="data:image/jpeg;base64,
            {{ base64_encode(@file_get_contents(url('https://peasi.app/storage/app/signatures/jblevinssig.png'))) }}">
            </div>
        </div>



    
    
    <div class="row" >
        <div class="col-6 border-bottom align-text-bottom" style="vertical-align: text-bottom">
            <span class="align-text-bottom">{{$student->student}} </span>
        </div>
        
        <div class="col-6 border-bottom align-text-bottom" style="vertical-align: text-bottom">
           <span class="align-text-bottom"> {{date('M d, Y')}} </span>
        </div>
    </div>
    
    <div class="row">
        <div class="col-4">
            Employee/Student Name
        </div>

        <div class="col-4">
            Date
        </div>
    </div>
    <div class="row">
       
        <div class="col-12 border-bottom">
            
            <img src="data:image/jpeg;base64,
            {{ base64_encode(@file_get_contents(url('https://peasi.app/storage/app/'.$sig))) }}">
           
        </div>

    </div>
</div>
</body>
<footer>

</footer>

</html>