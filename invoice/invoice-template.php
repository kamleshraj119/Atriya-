<?php
 $data=json_decode($_REQUEST["data"]);   
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <style type="text/css">
    body,
    div,
    table,
    thead,
    tbody,
    tfoot,
    tr,
    th,
    td,
    p {
        font-family: "Calibri";
        font-size: x-small
    }

    a.comment-indicator:hover+comment {
        background: #ffd;
        position: absolute;
        display: block;
        border: 1px solid black;
        padding: 0.5em;
    }

    a.comment-indicator {
        background: red;
        display: inline-block;
        border: 1px solid black;
        width: 0.5em;
        height: 0.5em;
    }

    comment {
        display: none;
    }


    </style>
</head>

<body>
	<div class="container">
		<div class="row">
    <table cellspacing="0" border="0">
        <colgroup width="73"></colgroup>
        <colgroup width="94"></colgroup>
        <colgroup width="63"></colgroup>
        <colgroup width="178"></colgroup>
        <colgroup span="2" width="109"></colgroup>
        <colgroup width="95"></colgroup>
        <colgroup width="106"></colgroup>
        <colgroup width="115"></colgroup>
        <colgroup width="109"></colgroup>
            
    
        <tr>
        	
            <td colspan=9 height="10" align="left" valign=middle><b><font face="Book Antiqua" size=6>Cmcorps Integrated Services Pvt Ltd</font></b></td>

            <td rowspan="5"><img src="img/logo.png"></td>
        </tr>

        <tr>
      
            <td colspan=9 height="25" align="left" valign=bottom><i><font face="Book Antiqua" size=4>#306, International Trade Tower, E - Block, Nehru Place, New Delhi-110019</font></i></td>
        </tr>
        <tr>
        
            <td colspan=9 height="25" align="left" valign=bottom><i><font face="Book Antiqua" size=4>Tel. - +91 11 47048401/02/84</font></i></td>
        </tr>
        <tr>
   
            <td colspan=9 height="25" align="left" valign=bottom><b><i><u><font face="Book Antiqua" size=4>Web: www.cisgroup.co.in</font></u></i></b></td>
        </tr>
        <tr>
            <td style="border-bottom: 1px solid #000000" colspan=9 height="25" align="left" valign=bottom><i><font face="Book Antiqua" size=4><br></font></i></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=10 height="35" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>TAX INVOICE</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=2 rowspan=2 height="53" align="left" valign=top><b><font face="Book Antiqua" size=3>Customer Name :<?php echo $data[0]->customer_name;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 rowspan=2 align="left" valign=top><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3>Invoice No :</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle ><b><font face="Book Antiqua" size=3><?php echo $data[0]->consol_invoice_number;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3>Invoice Date :</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3><?php echo $data[0]->added_date;?></font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="left" valign=bottom>
                <font face="Book Antiqua">
                    <br>
                </font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=2 rowspan=2 height="66" align="left" valign=top><b><font face="Book Antiqua" size=3>Billing Address :<?php echo $data[0]->billing_address;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 rowspan=2 align="left" valign=bottom>
                <font color="#000000">
                    <br>
                </font>
            </td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="left" valign=bottom><b><font face="Book Antiqua" size=3>Place of Supply</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3>State Code :</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><b><font face="Book Antiqua" size=3><?php echo $data[0]->state_code;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3>State Name :</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign="middle">
                 <b><font face="Book Antiqua" size=3>
                    <?php echo $data[0]->state_name;?>
                </font></b>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=2 rowspan=2 height="61" align="left" valign=top><b><font face="Book Antiqua" size=3>GSTIN :</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=3 rowspan=2 align="left" valign=top><b><font face="Book Antiqua" size=3><?php echo $data[0]->gstin;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="left" valign=bottom>
                <font face="Book Antiqua">
                    <br>
                </font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 align="left" valign=middle><b><font face="Book Antiqua" size=3>Supply Taxable in Reverse Charge :</font></b></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle ><b><font face="Book Antiqua" size=3>No</font></b></td>
        </tr>
        
       <tr>
           <td bgcolor="#FFFF99" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan="5">
               <table width="100%" cellpadding="0" cellspacing="0">
                   <tr>
                       <td width="50px;" style="border-right: 1px solid #000000" align="left" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>S. No.</font></b></td>
                       <td style="border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Description of Services</font></b></td>
                       <td width="100px;" style="border-left: 1px solid #000000; " align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>HSN Code</font></b></td>
                   </tr>
               </table>
           </td>
           <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Amount</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>CGST</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>SGST</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>IGST</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Total</font></b></td>
       </tr>
        
       <tr>
           <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan="5">
               <table width="100%" cellpadding="0" cellspacing="0">
                   <tr>
                       <td width="50px;" style="border-right: 1px solid #000000" align="left" valign=middle ><b><font face="Book Antiqua" size=4>1</font></b></td>
                       <td style="border-right: 1px solid #000000" align="center" valign=middle ><b><font face="Book Antiqua" size=4><?php echo $data[0]->description;?></font></b></td>
                       <td width="100px;" style="border-left: 1px solid #000000; " align="center" valign=middle><b><font face="Book Antiqua" size=4><?php echo $data[0]->hsn_code;?></font></b></td>
                   </tr>
               </table>
           </td>
           <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><b><font face="Book Antiqua" size=3><?php echo $data[0]->amount;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><b><font face="Book Antiqua" size=3><?php echo $data[0]->cgst;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle" >
                <b><font face="Book Antiqua" size=3>
                     <?php echo $data[0]->sgst;?>
                </font></b>
            </td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle" >
                 <b><font face="Book Antiqua" size=3>
                   <?php echo $data[0]->igst;?>
                </font></b>
            </td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle">
                <b><font face="Book Antiqua" size=3>
                    <?php echo $data[0]->total;?>
                </font></b>
            </td>
       </tr> 
        
        
       <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 height="25" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Total</font></b></td>
            <td style="border-top: 1px solid #000000;border-right: 1px solid #000000" align="right" valign=bottom ><b><font face="Book Antiqua" size=3><?php echo sprintf('%0.2f', $data[0]->amount);?></font></td>
            <td style="border-top: 1px solid #000000;border-right: 1px solid #000000" align="right" valign=bottom ><b><font face="Book Antiqua" size=3><?php echo sprintf('%0.2f', $data[0]->cgst);?></font></td>
            <td style="border-top: 1px solid #000000;border-right: 1px solid #000000" align="right" valign=bottom ><b><font face="Book Antiqua" size=3><?php echo sprintf('%0.2f', $data[0]->sgst);?></font></td>
            <td style="border-top: 1px solid #000000;border-right: 1px solid #000000" align="right" valign=bottom ><b><font face="Book Antiqua" size=3><?php echo sprintf('%0.2f', $data[0]->igst);?></font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000;  border-right: 1px solid #000000"  align="right" valign=bottom ><b><font face="Book Antiqua" size=3><?php echo sprintf('%0.2f', $data[0]->total);?></font></td>
            
        </tr>
        <tr>
            <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000" colspan=6 height="26" align="left" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Statutory Details </font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=3 rowspan=3 align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Total Invoice Amount</font></b></td>
            <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" rowspan=3 align="right" valign=middle bgcolor="#FFFF99" ><b><font face="Book Antiqua" size=4><?php echo sprintf('%0.2f',  $data[0]->total);?></font></b></td>
        </tr>
        <tr>
            <td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom><b><font face="Book Antiqua" size=3>PAN No.</font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3>:</font></b></td>
            <td colspan=3 align="left" valign=bottom><b><font face="Book Antiqua" size=3>AAFCC9951N</font></b></td>
        </tr>
        <tr>
            <td style="border-left: 2px solid #000000" height="25" align="left" valign=bottom><b><font face="Book Antiqua" size=3>GSTIN</font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3>:</font></b></td>
            <td colspan=3 align="left" valign=bottom><b><font face="Book Antiqua" size=3>07AAFCC9951N1Z0</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" height="2" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=middle bgcolor="#FFFF99" >
                <font face="Book Antiqua" size=3 color="#FFFFFF">
                    <br>
                </font>
            </td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=middle bgcolor="#FFFF99" >
                <font face="Book Antiqua" size=3 color="#FFFFFF">
                    <br>
                </font>
            </td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=middle bgcolor="#FFFF99" >
                <font face="Book Antiqua" size=3 color="#FFFFFF">
                    <br>
                </font>
            </td>
        </tr>
        <tr>
            <td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom><b><font face="Book Antiqua" size=3>Benificiary Name</font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3>:</font></b></td>
            <td colspan=3 align="left" valign=bottom><b><font face="Book Antiqua" size=3>Cmcorps Integrated Services Private Limited</font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=4 rowspan=5 align="right" valign=bottom><img src="img/logo_sigclub.png" /><br /><b><font face="Book Antiqua" size=3 color="#000000">Authorized Signatory</font></b></td>
        </tr>
        <tr>
            <td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom><b><font face="Book Antiqua" size=3>Bank Name</font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3>:</font></b></td>
            <td colspan=3 align="left" valign=bottom><b><font face="Book Antiqua" size=3>HDFC Bank &amp; A-24 Hauz Khas, New Delhi</font></b></td>
        </tr>
        <tr>
            <td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom><b><font face="Book Antiqua" size=3>Account No.</font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3>:</font></b></td>
            <td colspan=3 align="left" valign=bottom><b><font face="Book Antiqua" size=3>50200008589095</font></b></td>
        </tr>
        <tr>
            <td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom><b><font face="Book Antiqua" size=3>IFSC Code</font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3>:</font></b></td>
            <td colspan=3 align="left" valign=bottom><b><font face="Book Antiqua" size=3>HDFC0000467</font></b></td>
        </tr>
        <tr>
            <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000" height="44" align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF">
                <font face="Book Antiqua">
                    <br>
                </font>
            </td>
            <td style="border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF">
                <font face="Book Antiqua">
                    <br>
                </font>
            </td>
            <td style="border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF">
                <font face="Book Antiqua">
                    <br>
                </font>
            </td>
            <td style="border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF">
                <font face="Book Antiqua">
                    <br>
                </font>
            </td>
            <td style="border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF">
                <font face="Book Antiqua">
                    <br>
                </font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" height="4" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=middle bgcolor="#FFFF99" >
                <font face="Book Antiqua" size=3>
                    <br>
                </font>
            </td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=middle bgcolor="#FFFF99" >
                <font face="Book Antiqua" size=3>
                    <br>
                </font>
            </td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=middle bgcolor="#FFFF99" >
                <font face="Book Antiqua" size=3>
                    <br>
                </font>
            </td>
        </tr>
        <tr>
            <td style="border-top: 2px solid #000000" colspan=10 height="22" align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
        </tr>
        <tr>
            <td colspan=10 height="20" align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
        </tr>
        <tr>
            <td height="24" align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
            <td colspan=9 align="left" valign=bottom><b><font face="Book Antiqua" size=1><br></font></b></td>
        </tr>
        <tr>
        	<td><img src="img/logo-1.png"></td>
            <td colspan=10 height="18" align="center" valign=bottom><b><i><font face="Book Antiqua">#306, International Trade Tower, E - Block, Nehru Place, New Delhi-110019</font></i></b></td>
        </tr>
        <tr>
            <td colspan=10 height="18" align="left" valign=bottom>
                <font face="Book Antiqua">
                    <br>
                </font>
            </td>
        </tr>
    </table>
</div>

   </div>
    
    <!-- ************************************************************************** -->
</body>

</html>