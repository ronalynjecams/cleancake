<link href="/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">

<!--CONTENT-->
<div class="crmQuotations form">

	<div class="row  border-bottom white-bg dashboard-header">
		<div class="col-md-12">
			<div class="btn-group pull-right m-t-5 m-b-20"> 
                <a href="#" data-quotationid="<?php echo $quote_data['CrmQuotation']['id']; ?>"  data-processtype="save" class="btn btn-info dim savePendingQuote">Save</a>
                <a href="#" id="cancelQuotation" data-quotationid="<?php echo $quote_data['CrmQuotation']['id']; ?>"  data-action="cancelled"  class="btn btn-danger dim">Cancel</a>
            </div>
            <h2 class="page-title"><?php echo ucfirst($status); ?> Quotation <small>[<b> <?php if (!is_null($quote_data['CrmQuotation']['quote_number'])) echo $quote_data['CrmQuotation']['quote_number']; ?> </b>]</h2>
        </div>
	</div>

    <div class="wrapper wrapper-content">
        
    <input type="hidden" id="quotation_id" value="<?php echo $quote_data['CrmQuotation']['id']; ?>"> 
        
	<div class="row">
		<div class="col-md-6">
		    <div class="ibox">
			<div class="ibox-title">
                <h5>Quotation Details</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="form-group"><div class="row">
                    <label class="col-md-2 control-label">Subject</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control help-block" id="subject" value="<?php if (!is_null($quote_data['CrmQuotation']['subject'])) echo $quote_data['CrmQuotation']['subject']; ?>" >
                     <!--<span class="help-block"><small>&nbsp;</small></span>-->
                    </div>
                </div></div>
                <div class="form-group"><div class="row">
                    <label class="col-md-2 control-label" >Validity Date</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control help-block" name="date"   id="validity_date" value="q ?>" />
                    </div>
                </div></div>
                <div class="form-group"><div class="row">
                    <label class="col-md-2 control-label" >Shipping Address</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control help-block" name="text"   id="shipping_address" value="<?php if (!is_null($quote_data['CrmQuotation']['shipping_address'])) echo $quote_data['CrmQuotation']['shipping_address']; ?>" />
                    </div>
                </div></div>
                <div class="form-group"><div class="row">
                    <label class="col-md-2 control-label" >Billing Address</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control help-block" name="text"   id="billing_address" value="<?php if (!is_null($quote_data['CrmQuotation']['billing_address'])) echo $quote_data['CrmQuotation']['billing_address']; ?>" />
                    </div>
                </div></div>
                

			</div>
			</div>
		</div><!-- end col md 12 -->
		
		<div class="col-md-6">
		    <div class="ibox">
			<div class="ibox-title">
                <h5>Client Details <a data-toggle="modal" class="btn btn-success" href="#modal-addClient"><i class="fa fa-plus"></i></a></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                
                <div class="form-group">
                    <div class="row">
                        <label class="col-md-2 control-label">Select Client</label>
                        <div class="col-md-10">
                            <select id="company_id" class="chosen-select"  tabindex="2">
                                <?php if ($quote_data['CrmQuotation']['crm_company_id'] != 0) { ?>
                                    <option value="<?php echo $quote_data['CrmQuotation']['crm_company_id']; ?>"><?php echo $quote_data['CrmCompany']['name']; ?></option>
                                    <?php
                                } else {
                                    echo '<option></option>';
                                }
                                foreach ($companies as $client) {
                                    ?>
                                    <option value="<?php echo $client['CrmCompany']['id']; ?>"> <?php echo $client['CrmCompany']['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <?php if ($quote_data['CrmQuotation']['crm_company_id'] != 0) { ?>
                    <div class="form-group oldInfo">
                        <div class="col-sm-12">
                            <label class="col-md-2 control-label">Contact Person</label> 
                            <div class="col-md-10">
                                <input type="text" class="form-control help-block" readonly id="contact_person" value="<?php echo $quote_data['CrmCompany']['contact_person']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="col-md-2 control-label">Contact Number</label> 
                            <div class="col-md-10">
                                <input type="text" class="form-control help-block" readonly id="contact_number" value="<?php echo $quote_data['CrmCompany']['contact_number']; ?>">
                            </div>
                        </div>
                    </div>
                <?php } ?> 

			</div>
		</div><!-- end col md 12 -->
		</div>
	</div><!-- end row -->
	
	<div class="row">
		<div class="col-md-12">
		    <div class="ibox">
			<div class="ibox-title">
                <h5>Product Details <a data-toggle="modal" class="btn btn-success" href="#modal-addProduct"><i class="fa fa-plus"></i></a></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
            
            <?php if (count($quote_prods) != 0) { ?>
                <div class="table-responsive">
					<table class="table table-bordered table-hover">
                        <tr>
                            <th>#</th>
                            <!--<th>Image</th>-->
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Quantity</th>
                            <th>List Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        $ctr = 1;
                        // pr($quote_prods);
                        foreach ($quote_prods as $quote_prod) {
                            $desc_variant = '';
                            if(array_key_exists('ProductVariant',$quote_prod['CrmQuoteprodVariant'])){
		                        foreach($quote_prod['CrmQuoteprodVariant']['ProductVariant'] as $variant){
		                            $desc_variant .= $variant['attribute_name']." : ".$variant['attribute_value']."</br>";
		                        }
				            }
                        
                        ?>
                            <tr>
                                <td style="width: 5%"><?php echo $ctr; ?></td> 
                                <td style="width: 15%"><?php echo  $quote_prod['Product']['code']; ?></td>
                                <td style="width: 35%">  <?php echo $desc_variant.''.$quote_prod['CrmQuotationProduct']['description']; ?><?php if($quote_data['CrmQuotation']['status'] == 'PENDING' || $quote_data['CrmQuotation']['status'] == 'ONGOING' || $userRole == "admin"){?> <button class="btn btn-default btn-xs update_desc" data-descid="<?php echo $quote_prod['CrmQuotationProduct']['id']; ?>" data-descdata="<?php echo $quote_prod['CrmQuotationProduct']['description']; ?>"><i class="fa fa-edit"></i></button> <?php } ?></td>
                                <td style="width: 10%">
                                    <input type="number" class="form-control quoted_qty" <?php if($quote_data['CrmQuotation']['status'] != 'PENDING' && $quote_data['CrmQuotation']['status'] != 'ONGOING' && $userRole != "admin"){echo 'disabled';} ?> data-qtyid="<?php echo $quote_prod['CrmQuotationProduct']['id']; ?>" value="<?php echo $quote_prod['CrmQuotationProduct']['qty']; ?>">
                                </td>
                                <td style="width: 15%">
                                    <input type="number" class="form-control quoted_list_price" <?php if($quote_data['CrmQuotation']['status'] != 'PENDING' && $quote_data['CrmQuotation']['status'] != 'ONGOING' && $userRole != "admin"){echo 'disabled';} ?> data-listpriceid="<?php echo $quote_prod['CrmQuotationProduct']['id']; ?>" value="<?php echo $quote_prod['CrmQuotationProduct']['list_price']; ?>"  min="1" step="1">
                                </td> 
                                <td style="width: 15%">
                                    <input type="number" class="form-control"  id="quoted_total_price" disabled  data-totalpriceid="<?php echo $quote_prod['CrmQuotationProduct']['id']; ?>" value="<?php echo $quote_prod['CrmQuotationProduct']['total_price'] ?>" >
                                </td>  
                                <td style="width: 5%"><button class="btn btn-danger btn-xs deleteProduct" data-id="<?php echo $quote_prod['CrmQuotationProduct']['id'] ?>">x</button></td>
                            </tr>
                        <?php 
                        $ctr++;
                            
                        }
                        ?>
                        
                        <tr>
                            <th colspan="4" align="right"> </th> 
                            <th align="right">Sub Total</th> 
                            <th> 
                                <input type="number" class="form-control"  id="subtotal" disabled  value="<?php echo $quote_data['CrmQuotation']['sub_total'] ?>">
                            </th>
                            <th></th>
                        </tr>
                        
                        <tr>
                            <th colspan="4" align="right"> </th> 
                            <th align="right">Discount</th> 
                            <th> <input type="number" class="form-control"  id="discount"  value="<?php echo $quote_data['CrmQuotation']['discount'] ?>"> </th>
                            <th></th>
                        </tr>
                        
                        <tr>
                            <th colspan="4" align="right"> </th> 
                            <th align="right">Delivery</th> 
                            <th> <input type="number" class="form-control"  id="delivery_amount"  value="<?php echo $quote_data['CrmQuotation']['delivery_amount'] ?>"> </th>
                            <th></th>
                        </tr>
                        
                        <tr>
                            <th colspan="4" align="right"> </th> 
                            <th align="right">Installation</th> 
                            <th> <input type="number" class="form-control"  id="installation_amount"  value="<?php echo $quote_data['CrmQuotation']['installation_amount'] ?>"> </th>
                            <th></th>
                        </tr>
                          
                        <tr>
                            <th colspan="4" align="right"> </th> 
                            <th>Grand Total</th> 
                            <th> <input type="number" class="form-control" disabled id="grand_total"  value="<?php echo $quote_data['CrmQuotation']['grand_total'] ?>"> </th>
                            <th></th>
                        </tr> 
                    </table>
                </div>
                <?php
            } else {
                echo 'No Added Product for this Quotation';
            }
            ?>
            
            </div>
            </div>
        </div>
	</div>
	
	<div class="row">
        <div class="col-md-12">
            <div class="ibox">
        	<div class="ibox-title">
                <h5>Terms and Conditions</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <textarea id="terms" class="form-control"><?php echo $quote_data['CrmQuotation']['terms'];?></textarea>
            </div>
            </div>
        </div>
    </div>

	
	</div>
</div>

<!--CONTENT END-->

<!--MODAL-->

<div id="modal-addClient" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel1">New Client</h3>
            </div> 
            <?php echo $this->Form->create('Company', array('role' => 'form', 'url' => '/crm_companies/add')); ?> 
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="type" class="form-control" value="CLIENTS">
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
                            <label>Tin</label>
                            <input type="text" id="tin_number" class="form-control">  
                        </div>  
                        <input type="hidden" id="user_id" class="form-control" value="<?php echo $me; ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                <button type="button" class="btn btn-primary addCompanyBtn"  >Add</button>    
            </div> 
            <?php echo $this->Form->end() ?>
            </div>
    </div>
</div>

<div id="modal-addProduct" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Add New Product</h4>
            </div>  
            <div class="modal-body">  
                <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Select Product</label>
                        <input type="hidden" id="variant_product_id"/>
                        <select class="chosen-select"  tabindex="2" id="product_id">
                            <option>--- Select Product ---</option>
                            <?php
                            foreach ($product_lists as $product_list) {
                                echo '<option value="' . $product_list['Product']['id'] . '">' . $product_list['Product']['code'] . '</option>';
                            }
                            ?>
                        </select> 
                    </div>
                     <div class="form-group">
                        <div id="productVariantDiv"></div>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" id="qty" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>List Price</label>
                        <input type="number" id="list_price" class="form-control" readonly>
                    </div>
                    <!--<div class="form-group">-->
                    <!--    <label>Sale Price</label>-->
                    <!--    <input type="number" id="sale_price" class="form-control">-->
                    <!--</div>-->
                    
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Product Image </label>
                        <div id="productImageDiv"></div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="description" class="form-control"></textarea>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                    <button type="button" class="btn btn-primary" id="addQuotationProductBtn"  >Add</button>    

            </div>  
    
        </div>
    </div>
</div>

<!--MODAL END-->

<!-- START MODAL FOR update PRODUCT DESC--> 
<div class="modal fade" id="update_desc_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Update Product Description</h4>
            </div>  
            <div class="modal-body">   
                <div class="col-lg-12">
                    
                    <div class="form-group">
                        <label>Description</label>
                        <input type="hidden" id="desc_qp_id"/>
                        <textarea id="udescription" class="form-control"></textarea>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button> 
                    <button type="button" class="btn btn-primary" id="update_descBtn"  >Update</button>    
                </div>  
            </div>  

        </div> 
    </div>
</div>
<!-- END MODAL FOR update PRODUCT DESC-->

<!-- Chosen -->
<script src="/js/plugins/chosen/chosen.jquery.js"></script>

<script>

    tinymce.init({
        selector: 'textarea',
        height: 200, 
        menubar: false,
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample | link',
    });

    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test($email);
    }
    
    $(document).ready(function(){
        
        $('.chosen-select').chosen({width: "100%",
            placeholder: "Select a Product",
            allowClear: true
        });
        
        // $("#company_id").select({
        //     placeholder: "Select Client Name",
        //     allowClear: true
        // }); 
        
        // $("#product_id").select2({
        //     allowClear: true,
        //     width: "100%",
        // });
        
        // $("#company_id").select2({
        //   allowClear: true,
        //   width: "100%"
        // });
        
    });
    
    function saveProcess(data) {
        $.ajax({
            url: "/crm_quotations/saveCreateQuotation",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
                // console.log(dd);
                location.reload();
            },
            error: function (dd) {
                console.log(dd);
            }
        });
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
//                            console.log(data);
                                $.ajax({
                                    url: "/crm_companies/addCompany",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'json',
                                    success: function (dd) {
                                        location.reload();
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
    
    $("#company_id").change(function () {
        $(".oldInfo").remove();
        $(".cInfo").remove();
        var id = $("#company_id").val();
        $.get('/app/getCompanies/'+id, 
        function (data) {
            $(".client_info").append('<div class="form-group cInfo">' +
                    '<div class="col-sm-6">' +
                    '<label class="control-label">Contact Person</label>' +
                    '<input type="text" class="form-control" readonly id="ucontact_person" value="' + data['contact_person'] + '">' +
                    '</div>' +
                    '<div class="col-sm-6">' +
                    '<label class="control-label">Contact Number</label>' +
                    '<input type="text" class="form-control" readonly id="ucontact_number" value="' + data['contact_number'] + '">' +
                    '</div>' +
                    '</div>');
        });
        var value = $("#company_id").val();
        var id = $("#quotation_id").val();
        var Qfield = 'crm_company_id';

        var data = {"id": id,
            "value": value,
            "Qfield": Qfield
        }
        saveProcess(data);
    });
    
    $('#validity_date').on('change', function (e) {
        var value = $("#validity_date").val();
        var id = $("#quotation_id").val();
        var Qfield = 'validity_date';

        var data = {
            "id": id,
            "value": value,
            "Qfield": Qfield
        }
        saveProcess(data);
    });
    
    $('#subject').on('change', function (e) {
        var value = $("#subject").val();
        var id = $("#quotation_id").val();
        var Qfield = 'subject';

        var data = {"id": id,
            "value": value,
            "Qfield": Qfield
        }
        saveProcess(data);
    });
    
    $('#shipping_address').on('change', function (e) {
        var value = $("#shipping_address").val();
        var id = $("#quotation_id").val();
        var Qfield = 'shipping_address';

        var data = {"id": id,
            "value": value,
            "Qfield": Qfield
        }
        saveProcess(data);
    });
    
    $('#billing_address').on('change', function (e) {
        var value = $("#billing_address").val();
        var id = $("#quotation_id").val();
        var Qfield = 'billing_address';

        var data = {"id": id,
            "value": value,
            "Qfield": Qfield
        }
        saveProcess(data);
    });
    
    $("#product_id").change(function () {
        
            $('#list_price').val(0);
            $('#sale_price').val();
            $('#description').val();
            $('.addedProductImageDiv').remove();
            $('.addedProductVariantDiv').remove();
        var product_id = $('#product_id').val();
        //get details of selected product  
         
        $.get('/app/getProduct/'+product_id, 
        function (data) {
            console.log(data);
            
            
            var variants = JSON.parse(data['Variant']);
            
            var variant = "" ;
            $.each(variants['display'], function( index, value ) {
                 variant += '<div class="row"><div class="col-lg-6">'+
                '<input type="text" class="prod_prop form-control " value="' + index + '" readonly></div>'+
                '<div class="col-lg-6"><select class="prod_value form-control" onchange="getPrice()"><option value="">--- SELECT '+index+' ---</option>';
     
                $.each(value, function( index, val ) {
                    variant += '<option value="'+ val +'">'+ val +'</option>';
                });
                variant += '</select></div></div>';
            });
            
            $("#productVariantDiv").append('<div class="form-group addedProductVariantDiv">' +
                    '<label>Product Variants </label>' + variant +
                    "<input type='hidden' id='variants' value='"+JSON.stringify(variants[product_id])+"'>"+ 
                    '</div>');
            
        });  
        
        $.get('/app/getImage/'+product_id, 
        function (data) {
            data = JSON.parse(data);
            $("#productImageDiv").append('<div class="form-group addedProductImageDiv">' +
                    '<img class="img-responsive" src="' + data['img'] + '" width="100%"> </div>' + 
                    '</div>');
            tinymce.get('description').setContent(data['description']);
        }); 
        
    });
    
    function getPrice(){
        
        var result = checkPrice();
        
        $('#list_price').val(result.base_price);
        $('#variant_product_id').val(result.id);
    }
    
    $('#addQuotationProductBtn').on("click", function () {

        var product_id = $('#product_id').val();
        var qty = $('#qty').val();
        var list_price = $('#list_price').val();
        var sale_price = $('#sale_price').val();
        // var description = $('#description').val();
        var quotation_id = $('#quotation_id').val();
        var variant_product_id = $('#variant_product_id').val();
        
        
        var description = tinyMCE.get('description').getContent();
        console.log('=>'+description)
        var data = {
            "product_id": product_id,
            "qty": qty,
            "list_price": list_price,
            "description": description,
            "quotation_id": quotation_id,
            "variant_product_id" : variant_product_id
        } 
        
        if(list_price!=""){
            if(qty!=""){
                $.ajax({
                    url: "/crm_quotations/saveProductQuotation",
                    type: 'POST',
                    data: {'data': data},
                    dataType: 'json',
                    success: function (dd) {
                        location.reload();
                    },
                    error: function (dd) {
                        console.log(dd);
                    }
                });
            }else{
                document.getElementById('qty').style.borderColor = "red";
            }
        }else{
            document.getElementById('list_price').style.borderColor = "red";
        }
    });
    
    $(".deleteProduct").each(function(index) {
        $(this).on("click", function(){ 
            var id = $(this).data('id');  
            var quotation_id = $('#quotation_id').val();
            //   console.log('sdfsdf'+id);
    var data = {
        "quotation_product_id": id, 
        "quotation_id": quotation_id
    } 
         swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this product.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {  
                    $.ajax({
                    url: "/crm_quotations/delete_product",
                    type: 'POST',
                    data: {'data': data},
                    dataType: 'text',
                    success: function (dd) {
                        location.reload();
                    },
                    error: function (dd) { 
                        console.log("AJAX error: " + JSON.stringify(dd, null, 2));
                    }
                });
                
                
                } else {
                    swal("Cancelled", "", "error");
                }
            });
            
            
        });
   });
   
   
   function saveQuotaionProductProcess(data) {
        $.ajax({
            url: "/crm_quotation_products/saveQuotationProduct",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
                location.reload();
            },
            error: function (dd) {
                console.log(dd);
            }
        });
    }
    
    
    
    $(".update_desc").each(function(index) {
        $(this).on("click", function(){    
            // alert('asdasd');
            var descid = $(this).data('descid');  
            var descdata = $(this).data('descdata');  
            $('#desc_qp_id').val(descid);
            tinymce.get('udescription').setContent(descdata); 
            $('#update_desc_modal').modal('show');   
        });
    });
    
    
    $("#update_descBtn").on("click", function(){  
        var quotation_product_id = $('#desc_qp_id').val();
        
        var value = tinyMCE.get('udescription').getContent(); 
        var Qfield = 'description';
        
        var data = {
            "quotation_product_id": quotation_product_id,
            "value": value,
            "Qfield": Qfield
        }
        
        saveQuotaionProductProcess(data);
    });
    
    
    
    
    $(".quoted_qty").each(function(index) {
        $(this).on("change", function(){  
            var quotation_product_id = $(this).data('qtyid');  
            var value = parseFloat($(this).val());
            var Qfield = 'qty';
                
            if (value % 1 == 0) {
                var data = {
                    "quotation_product_id": quotation_product_id,
                    "value": value,
                    "Qfield": Qfield
                }
                
                saveQuotaionProductProcess(data);
                
            }else{
                alert('Invalid Quantity!');
            }
        }); 
    });
    
    $(".quoted_list_price").each(function(index) {
        $(this).on("change", function(){   
            var quotation_product_id = $(this).data('listpriceid');  
            var value = parseFloat($(this).val());
            var Qfield = 'list_price';

            var data = {
                "quotation_product_id": quotation_product_id,
                "value": value,
                "Qfield": Qfield
            }
            
            saveQuotaionProductProcess(data);
        });
    });
    
    function saveComputeQuotationProcess(data) {
        $.ajax({
            url: "/crm_quotations/saveComputeQuotationProcess",
            type: 'POST',
            data: {'data': data},
            dataType: 'json',
            success: function (dd) {
                location.reload();
            },
            error: function (dd) {
                console.log(dd);
            }
        });
    }
    
    $("#discount").on("change", function(){   
         
        var quotation_id = $("#quotation_id").val();  
        var value = $("#discount").val();
        var Qfield = 'discount';

        var data = {
            "quotation_id": quotation_id,
            "value": value,
            "Qfield": Qfield
        }
        
        saveComputeQuotationProcess(data);
    });
    
    $("#delivery_amount").on("change", function(){   
         
        var quotation_id = $("#quotation_id").val();  
        var value = $("#delivery_amount").val();
        var Qfield = 'delivery_amount';
        
        var data = {
            "quotation_id": quotation_id,
            "value": value,
            "Qfield": Qfield
        }
        
        saveComputeQuotationProcess(data);
    });
    
    $("#installation_amount").on("change", function(){   
         
        var quotation_id = $("#quotation_id").val();  
        var value = $("#installation_amount").val();
        var Qfield = 'installation_amount';
       
        var data = {
            "quotation_id": quotation_id,
            "value": value,
            "Qfield": Qfield
        }
        
        saveComputeQuotationProcess(data);
    });
    
    
    $('.savePendingQuote').each(function (index) {
        $(this).click(function () {
            var button_type = $(this).data("buttontype");
            var terms = tinyMCE.get('terms').getContent();

            var id = $("#quotation_id").val();  
            var Qfield = 'terms';
            var shipping_address = $('#shipping_address').val();
            var billing_address = $('#billing_address').val();
    
            var data = {"id": id,
                "value": terms,
                "Qfield": Qfield,
                "shipping_address": shipping_address,
                "billing_address": billing_address,
            }
    
            saveProcess(data);
        });
    });
    
    $("#cancelQuotation").click(function () {
        var action = $(this).data('action');
        var quote_id  = $(this).data('quotationid');
        var data = {"id":quote_id, "action":action};
        swal({
            title: "Are you sure?",
            text: "This quotation will be "+action+".",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
        			url: '/crm_quotations/action',
            		type: 'POST',
            		data: {"data": data},
            		dataType: 'text',
            		success: function(msg) {
            			console.log(msg);
            			swal({
        		            title: "Success!",
        		            text: "Quotation was "+action+".",
        		            type: "success"
        		        },
        		        function (isConfirm) {
        		            if (isConfirm) { location.href = '/admins/dashboard'; }
        		        });
            		},
            		error: function(error) {
            			console.log("Error: "+error);
            			swal({
        		            title: "Oops!",
        		            text: "Something went wrong while quotation was being "+action+". Please try again.",
        		            type: "warning"
        		        });
            		}
            	});	
            }
        });
    });
    
    $(".update_desc").each(function(index) {
        $(this).on("click", function(){    
            // alert('asdasd');
            var descid = $(this).data('descid');  
            var descdata = $(this).data('descdata');  
            $('#desc_qp_id').val(descid);
            tinymce.get('udescription').setContent(descdata); 
            $('#update_desc_modal').modal('show');   
        });
    });
    
    $("#update_descBtn").on("click", function(){  
        var quotation_product_id = $('#desc_qp_id').val();
        
        var value = tinyMCE.get('udescription').getContent(); 
        var Qfield = 'description';
        

        var data = {
            "quotation_product_id": quotation_product_id,
            "value": value,
            "Qfield": Qfield
        }
        
        saveQuotaionProductProcess(data);
    });
    
</script>