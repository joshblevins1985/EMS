<table class="table table-borderless">
    <tbody>
       <tr>
           <th>First Name</th>
           <td>{{decrypt($pt->first_name) ?? ''}}</td>
           <th>Middle Name</th>
           <td>{{decrypt($pt->middle_name) ?? ''}}</td>
           <th>Last Name</th>
           <td>{{decrypt($pt->last_name) ?? ''}}</td>
       </tr> 
       <tr>
           <th>Date of Birth</th>
           <td>{{ Carbon\Carbon::parse($pt->dob)->format('m/d/Y') }}</td>
           <th>SSN</th>
           <td>{{decrypt($pt->ssn) ?? ''}}</td>
           <th>Phone Numbers</th>
           <td>
               <table class="table table-borderless">
                   <tr>
                       <td>Home:</td>
                       <td><?php $phone_home = decrypt($pt->phone); ?> <abbr title="Phone">P:{{ '('.substr($phone_home, 0, 3).') '.substr($phone_home, 3, 3).'-'.substr($phone_home,6)  }}</abbr></td>
                   </tr>
                   <tr>
                       <td>Mobile:</td>
                       <td><?php $phone = decrypt($pt->phone_mobile); ?> <abbr title="Phone">P:{{ '('.substr($phone, 0, 3).') '.substr($phone, 3, 3).'-'.substr($phone,6)  }}</abbr></td>
                   </tr>
               </table>
           </td>
       </tr>
       <tr>
           <th colspan="2">Email Address</th>
           <td>{{ decrypt($pt->email) }}</td>
           <th>Address</th>
           <td colspan="2"><address>
                  {{$pt->street_number ?? ''}} {{decrypt($pt->route) ?? ''}} <br>
                  {{decrypt($pt->locality) ?? ''}} {{decrypt($pt->state) ?? ''}} {{decrypt($pt->postal_code) ?? ''}}<br>
                  
                </address></td>
       </tr>
    </tbody>
</table>

