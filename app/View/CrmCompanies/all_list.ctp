
<link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<div class="crmCompanies index">

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
            <h2>List of all <?php echo ucwords($this->params['url']['type']); ?>
            <small><a href="#" data-usertype="<?php echo $this->params['url']['type']; ?>" data-toggle="modal" data-target="#exampleModal"  class="btn btn-xs btn-info btn-outline"><i class="fa fa-plus"></i> Add new <?php echo ucwords($this->params['url']['type']); ?></a>
            </small></h2>
		</div>
	</div>

	<div class="wrapper wrapper-content">
	<div class="row">
		
		<div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example">
							<thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact Number</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
							<tbody>
                                <?php foreach ($companies as $company) { ?>
                                    <tr>
                                        <td><?php echo ucwords($company['CrmCompany']['name']); ?></td>
                                        <td><?php echo $company['CrmCompany']['contact_number']; ?></td>
                                        <td><?php echo ucwords($company['CrmCompany']['contact_person']); ?></td>
                                        <td><?php echo $company['CrmCompany']['email']; ?></td>
                                        <td><?php echo ucwords($company['CrmCompany']['address']); ?></td>
                                        <td><?php echo ucwords($company['Admin']['name']); ?></td>
                                        <td>
                                            <?php
                                            if ($company['CrmCompany']['admin_id'] == $me) {
                                                echo '<button class="btn btn-default update_company_btn" data-id="' . $company['CrmCompany']['id'] . '"><i class="fa fa-edit"></i></button>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>

<!--MODAL FOR ADD-->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">New <?php echo ucwords($this->params['url']['type']); ?></h4>
            </div> 
            <div class="modal-body"> 

                <input type="hidden" id="type" class="form-control" value="<?php echo $this->params['url']['type']; ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" id="name" class="form-control">
                </div>
                <div class="form-group"> 
                    <label>Contact Number</label>
                    <input type="text" id="contact_number" class="form-control">
                </div>
                <div class="form-group">
                    <label>Contact Person</label>
                    <input type="text" id="contact_person" class="form-control"> 
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" id="address" class="form-control">  
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="email" class="form-control">  
                </div>  
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" id="tin_number" class="form-control">  
                </div> 
                <input type="hidden" id="user_id" class="form-control" value="<?php echo $me; ?>">  

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                <button type="button" class="btn btn-primary addCompanyBtn"  >Add</button>    
            </div> 
        </div> 
    </div>
</div>


<!--update modal-->

<div class="modal" id="update_modal" role="dialog" tabindex="-2"  aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Update <?php echo ucwords($this->params['url']['type']); ?> info</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="update_company_id">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" id="uname" class="form-control">
                </div>
                <div class="form-group"> 
                    <label>Contact Number</label>
                    <input type="text" id="ucontact_number" class="form-control">
                </div>
                <div class="form-group">
                    <label>Contact Person</label>
                    <input type="text" id="ucontact_person" class="form-control"> 
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" id="uaddress" class="form-control">  
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="uemail" class="form-control">  
                </div> 
                <div class="form-group">
                    <label>Tin</label>
                    <input type="text" id="utin_number" class="form-control">  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                <button type="button" class="btn btn-primary updateCompanyBtn"  >Update</button>  
            </div>  
        </div>
    </div> 
</div>

<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/js/plugins/dataTables/datatables.min.js"></script>
<script src="/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ]

        });

	$(".update_company_btn").each(function () {
        $(this).on("click", function () {
//                alert('asdadsad');exit();
            var id = $(this).data('id'); //this line gets value of data-id from delete button
            $('#update_company_id').val(id); // this line passes the value from data id to modal, to be able to manipulate id of the selected row
            $('#update_modal').modal('show'); // this line shows modal, make sure to assign values first before showing modal


            $.get('/crm_companies/get_company_info', {
                id: id,
            }, function (data) {
                console.log(data['name']);
                $('#uname').val(data['name']);
                $('#ucontact_person').val(data['contact_person']);
                $('#uaddress').val(data['address']);
                $('#uemail').val(data['email']);
                $('#ucontact_number').val(data['contact_number']);
                $('#utin_number').val(data['tin_number']);
            });


        });
    });




    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test($email);
    }
    
    $('.addCompanyBtn').on("click", function () {
        var name = $('#name').val();
        var contact_person = $('#contact_person').val();
        var address = $('#address').val();
        var email = $('#email').val();
        var tin_number = $('#tin_number').val();
        var contact_number = $('#contact_number').val();
        var type = $('#type').val();
        var user_id = $('#user_id').val();

        type = (type == 'suppliers') ? 'SUPPLIERS' : 'CLIENTS';

        if ((name != "")) {
            if (contact_person != "") {
                if (address != "") {
                    if (email != "") {
                        if (!validateEmail(email)) {
//                            console.log('invalid');
                            document.getElementById('email').style.borderColor = "red";
                        } else {
//                            console.log('valid'); 
                            if (contact_number != "") {
                                var data = {
                                    "name": name,
                                    "contact_person": contact_person,
                                    "address": address,
                                    "email": email,
                                    "tin_number": tin_number,
                                    "contact_number": contact_number,
                                    "type": type,
                                    "admin_id": user_id,
                                }
                            console.log(data);
                                $.ajax({
                                    url: "/crm_companies/addCompany",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'json',
                                    success: function (dd) {
                                        location.reload();
                                        // console.log(dd);
                                    },
                                    error: function (dd) {
//                                        location.reload();
                                        console.log(dd);
                                    }
                                });
                            } else {
                                document.getElementById('contact_number').style.borderColor = "red";
                            }
                        }
                    } else {
                        document.getElementById('email').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('address').style.borderColor = "red";
                }
            } else {
                document.getElementById('contact_person').style.borderColor = "red";
            }
        } else {
            document.getElementById('name').style.borderColor = "red";
        }
    });


    $('.updateCompanyBtn').on("click", function () {
        var name = $('#uname').val();
        var contact_person = $('#ucontact_person').val();
        var address = $('#uaddress').val();
        var email = $('#uemail').val();
        var tin_number = $('#utin_number').val();
        var contact_number = $('#ucontact_number').val();
        var update_company_id = $('#update_company_id').val();

        if ((name != "")) {
            if (contact_person != "") {
                if (address != "") {
                    if (email != "") {

                        if (!validateEmail(email)) {
//                            console.log('invalid');
                            document.getElementById('uemail').style.borderColor = "red";
                        } else {
                            if (contact_number != "") {
                                var data = {"name": name,
                                    "contact_person": contact_person,
                                    "address": address,
                                    "email": email,
                                    "tin_number": tin_number,
                                    "contact_number": contact_number,
                                    "id": update_company_id,
                                }
                                $.ajax({
                                    url: "/crm_companies/update_company_process",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'json',
                                    success: function (id) {
                                        location.reload();
                                    },
                                    error: function (dd) {
//                                        location.reload();
                                        console.log(dd);
                                    }
                                });
                            } else {
                                document.getElementById('ucontact_number').style.borderColor = "red";
                            }
                        }
                    } else {
                        document.getElementById('uemail').style.borderColor = "red";
                    }
                } else {
                    document.getElementById('uaddress').style.borderColor = "red";
                }
            } else {
                document.getElementById('ucontact_person').style.borderColor = "red";
            }
        } else {
            document.getElementById('uname').style.borderColor = "red";
        }
    });

    });

</script>
