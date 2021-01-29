<step id="step-1" name="Financial Assistance Policy">
    @csrf
    
    <div class="row">
        <div class="col-xl-10 text-center">
            <h3>Edicational Assistance Policy</h3>
            <h3>Portsmouth Management Firm</h3>
            <h5>Manged: PEASI - PMT - GEAS - PAT - PCI - TBN</h5>
        </div>
        <div class="col-xl-10">
            <ol>
                <li>Portsmouth Management Firm (PMF) offers employees an interest free education loan to employees whom are wishing to advance their career in Emegency Medical Services.</li>

                <li>Procedure to apply for educational loan</li>

                <ol type="a">
                    <li>Employee should complete this application.</li>
                    <li>Employee must complete payroll deduction form agreeing to have payment deducted from their paycheck.</li>
                    <li>Education loans are paid back at a minimum of 4% of the total loan per paycheck. The amount of this loan cannot be more than $5000 or $200 per paycheck.</li>
                    <li>Providing your the loan is approved by administration, PMF will provide the student with a letter of intent to pay, copy of application and the deduction schedule.</li>
                </ol>

                <li>Employee Eligibility</li>

                <ol type="a">
                    <li>Employee Performance. </li>
                    <li>Supervisor Recommendation.</li>
                    <li>Employee Tenure.</li>
                    <li>School student success rate.</li>
                    <li>Must be employeed for a minimun of six (6) months of continuous employment.</li>
                    <li>Professional experience.</li>
                </ol>

                <li>Administration reserves the right to apporve or deny tuition requests b ased on relevant criteria.</li>

                <li>Employee mus seek educational assistance from other sources such as VA, frants, etc. If the employee is able to procure other sources of payment PMF will consider partial assistance.</li>

                <li>In the event the employee has late fees on tuition, the late fees will be the responsibility of the employee.</li>

                <li>Reimbursement Plan</li>

                <ol type="a">
                    <li>All classes approved by administration will be funded up to the annual cap of $5000 per year or $200 per paycheck. The amount of reimbursement will be negotiated at an amount that the employee is comfortable with. Themount will be no less than 4% of the total amount borrowed per paycheck.</li>
                </ol>

                <li>Class attendance and completion of study assignments will oridinarily be accomplished outside of the employee's regular working hours. Employer will arrange for scheduling to accommodate courses within reason and employees must maintain full time status throughout the length of the course. Any employee leave of absence will result in the employee arranging payments to PMF at the regularly deducted amount untill the terms of agreement are repaid.</li>

                <li>Employees who terminate their employment prior to fulfilling their commitment will be responsible for the repayment of the full amount of the educational assistance immediately upon termination.</li>

                <li>Any unpaid balances remaining at the time of termination will be deducted from the employee's final paycheck if possible. If necessary, repayment arrangements for any outstanding balances must be made with and approved by administration.</li>

                <li>Employees who terminate employment prior to the completion of the class or who fail to complete their program will be responsible for the repayment of all educational assistance.</li>

                <li>To be eligiable for additional assistance while a current loan is still being repaid the employee must submit proof of maintaining a passing grade in the course or any additional documentation requested by PMF.</li>

                <li>PMF reserves the right to modify, restrict, deny or eliminate educational assistance benefits at any time and for any reason.</li>


            </ol>
        </div>
        <div class="col-xl-10 mt-4">
            <div class="checkbox checkbox-css">
                <input name="policy_agreement" type="checkbox" name="policyAccepted" id="policyAccepted" value="true" data-parsley-checkmin="1" required/>
                <label for="policyAccepted">I have read the above policy and agree to it's contents. To the best of my knowledge I qualify under these guidelines for educational assistance and can proceed with the application.</label>
            </div>
        </div>


    </div>

</step>

<step id="step-2" name="Course Information">

    <table class="table">
        <tbody>
        <tr>
            <td>Employee Name</td>
            <td>{{Auth::user()->employee->first_name}} {{Auth::user()->employee->last_name}}</td>
        </tr>
        <tr>
            <td>Employee Address</td>
            <td><address>
                    {{Auth::user()->employee->street_number}} {{Auth::user()->employee->route}}<br>
                    {{Auth::user()->employee->locality}}, {{Auth::user()->employee->state}} {{Auth::user()->employee->postal_code}}<br>
                    <abbr title="Phone">P:</abbr>
                </address></td>
        </tr>
        <tr>
            <td>Social Security</td>
            <td>{{decrypt(Auth::user()->employee->ssn)}}</td>
        </tr>
        <tr>
            <td>School Attending</td>
            <td><input type="text" name="school" class="form-control" placeholder="Enter School" data-parsley-required="true" /></td>
        </tr>
        <tr>
            <td>School Address and Phone Number</td>
            <td><textarea name="school_contact" rows="4" cols="75"  data-parsley-required="true"></textarea></td>
        </tr>
        <tr>
            <td>Other schools you are attending</td>
            <td><textarea rows="4" cols="75" name="other_schools" ></textarea></td>
        </tr>
        <tr>
            <td>List courses you plan to take.</td>
            <td><textarea rows="4" cols="75" name="courses" data-parsley-required="true"></textarea></td>
        </tr>
        <tr>
            <td>Start Date</td>
            <td><input name="start_date" type="text" class="form-control" id="start_date" class="form-control" placeholder="Select Date" value="" data-parsley-required="true"/></td>
        </tr>
        <tr>
            <td>End Date</td>
            <td><input name="end_date" type="text" class="form-control" id="end_date" placeholder="Select Date" value="" /></td>
        </tr>
        <tr>
            <td>Total Cost of Course</td>
            <td><input name="cost" type="number" name="cost" min="1" max="20000" class="form-control" placeholder="Enter Total Cost of Course" data-parsley-required="true" /></td>
        </tr>
        <tr>
            <td>Total Assistance Requested</td>
            <td><input type="number" id="requested" name="requested" min="1" max="5000" class="form-control" placeholder="Enter Total Amount Requested" data-parsley-required="true" /></td>
        </tr>
        <tr>
            <td>Describe how this course could benefit your employer.</td>
            <td><textarea rows="4" cols="75" name="imporove" data-parsley-required="true"></textarea></td>
        </tr>
        </tbody>
    </table>

</step>

<step id="step-3" name="Tax Notification">
    <div class="col-xl-10">
        This statement is notice to you of possible tax implication relating to the financial assistance you will receive from PMF per agreement executed by and between you and PMF. Forgiveness of indebtedness in connection with employment may be considered taxable income to an employee. You are encouraged to discuss this matter with your tax advisor. The amount forgiven will be reported to the Internal Revenue service on from 1099 on a calendar year basis. Receipt of this notice is acknowledged by my signature on this application.
    </div>
</step>

<step id="step-4" name="Confirmation">
    <!-- begin #home -->
		<div id="home" class="content has-bg home">
                <!-- begin content-bg -->
                <div class="content-bg" style="background-image: url(../assets/img/bg/bg-home.jpg);" 
                    data-paroller="true" 
                    data-paroller-factor="0.5"
                    data-paroller-factor-xs="0.25">
                </div>
                <!-- end content-bg -->
                <!-- begin container -->
                <div class="container home-content">
                    <h1>Congratulations you have completed the application. The next step is to sign the agreement and forward it to your supervisor By confirming this information you will now need to sign the 
                        agreement which will be forwarded to your supervisor for review. Please remember administration mankes every effort to provide educational assistance, however reserves 
                        the right to deny applications submitted or discontinue the program without notification. </h1>
                    
                    <p>
                        Please be patient as it can take time for your application to make it through the entire process. You will be notified of the status of your application as it goes through the process.<br />
                        
                    </p>
                    <button type="submit" class="btn btn-theme btn-primary" id="confirm">Submit Application</button> <br />
                    <br />
                   
                </div>
                <!-- end container -->
            </div>
            <!-- end #home -->

</step>

