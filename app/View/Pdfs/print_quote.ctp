<body style="font-family: arial; font-size: 9pt;A_CSS_ATTRIBUTE:all;position: absolute;top: 25px; left:150; right:150; ">
    <?php //echo $terms_info; ?>
     
<p  style="margin-top: 30px;font-size:12px"> <b> Terms and Conditions </b> </p>
<p> Price quoted is based on the specifications provided by the client and agreed by Raeas Marketing or vice-versa, changes in product, design or specifications after approval of proposal may be subject to price adjustment as the parties may agree. </p>
<?php echo $terms; ?> 
<!--<p>We would like to thank you for giving us the opportunity to serve you. </p> -->
<!--<p>We hope to hear your confirmation soon.</p><br/><br/><br/><br/><br/> -->
<p  style="margin-top: 30px;font-size:12px"> <b> General Agreement: </b> </p>
<p>Unless full payment of the full purchase price is made, it is agreed that Raeas Marketing shall remain to be the lawful owner of the product(s). Accordingly, Raeas Marketing has the right to demand a return of the product(s) delivered should the client not complete the payments within the period given (i.e. fifteen (15) days after full delivery of the order). Raeas Marketing is not responsible for pricing, typographical or other errors and it reserves the right to amend, modify, or cancel orders arising from such errors.</p>
<p>&nbsp;</p>
<p>Please feel free to call us, should you require further informations. </p> 
<p>Thank you and we are hoping to serve your valued order soon.</p>
<p>&nbsp;</p>
<!-- <p  style=" width:500 ">Very Truly yours,</p><br/><br/>-->
<!--    <?php if($agent_signature != ""): ?>-->
<!--    <img src="/img/signatures/<?php echo $agent_signature; ?>" class="signature"-->
<!--         style="margin-top:-15px;width:70px;margin-left:50px;margin-bottom:-15px;"/>-->
<!--    <?php endif; ?>-->
<!--     <p> ___________________________________________</p>-->
<!--<p><?php  echo 'Prepared By: '.$prepared_by;?></p>-->
<table align="center" width="1000">
    <tr>
        <td width="300" align="left">
            <p  style=" width:500 ">Very Truly yours,</p><br/><br/>
            <img src="/img/signatures/<?php echo $agent_signature; ?>" class="signature"
         style="margin-top:-15px;width:70px;margin-left:50px;margin-bottom:-15px;"/>
             <p> ___________________________________________</p>
            <p> <?php echo $prepared_by; ?> - Account Executive</p> 
        </td>
    </tr>
    <tr><td><br></td></tr>
    <tr>
       <td width="300" align="left">
            <p  style=" width:500 ">Noted by:</p><br/><br/>
            <img src="/img/signatures/<?php echo $agent_signature; ?>" class="signature"
         style="margin-top:-15px;width:70px;margin-left:50px;margin-bottom:-15px;"/>
             <p> ___________________________________________</p>
            <p> <?php echo "Genalyn Cambay"; ?> - OIC</p> 
        </td>
        <td width="300">
            <p >Confirm By (Sign Below),</p><br/><br/><br/>
             <p> ___________________________________________</p>
            <p> <?php echo $contact_person; ?> - Client Name </p> 
        </td>
    </tr>
</table>
 
</body>