<?php
 $data=json_decode($_REQUEST["data"]);
 $amount=0;
 $sgst=0;
 $igst=0;
 $cgst=0;
 $total=0;
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
        <colgroup width="109"></colgroup>
        <colgroup width="139"></colgroup>
        <colgroup width="146"></colgroup>
        <colgroup width="168"></colgroup>
        <colgroup width="109"></colgroup>
        <colgroup width="79"></colgroup>
        <colgroup width="87"></colgroup>
        <colgroup span="5" width="113"></colgroup>
        <tr>
            <td colspan=12 rowspan=5 height="161" valign=middle><b><font face="Book Antiqua" size=6><br>
            	<img src="img/logo.png" align="right">
		</font></b></td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=12 height="35" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>TAX INVOICE</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=2 rowspan=2 height="53" align="left" valign=top><b><font face="Book Antiqua" size=3>Customer Name :<?php echo $data[0]->customer_name;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" colspan=5 rowspan=2 align="left" valign=top><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3>Consol Invoice No :</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle ><b><font face="Book Antiqua" size=3><?php echo $data[0]->consol_invoice_number;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle ><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3>Invoice Date :</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle ><b><font face="Book Antiqua" size=3><?php echo $data[0]->added_date;?></font></b></td>
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
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=5 rowspan=2 align="left" valign=bottom>
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
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=midd"middle">
                <b><font face="Book Antiqua" size=3>
                    <?php echo $data[0]->state_name;?>
                </font></b>
            </td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=2 rowspan=2 height="62" align="left" valign=top><b><font face="Book Antiqua" size=3>GSTIN :</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=5 rowspan=2 align="left" valign=top><b><font face="Book Antiqua" size=3><?php echo $data[0]->gstin;?></font></b></td>
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
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="94" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Invoice No.</font></b></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Name</font></b></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99" colspan="2"><b><font face="Book Antiqua" size=4>Description of Services</font></b></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>HSN Code</font></b></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Days/ Period</font></b></td>
            <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Billing Rate</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Amount</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>CGST</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>SGST</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>IGST</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Total</font></b></td>
        </tr>
  
         <?php foreach($data as $row): ?>
             <?php $amount=$amount+$row->amount;
             $sgst=$sgst+$row->sgst;
             $igst=$igst+$row->igst;
             $cgst=$cgst+$row->cgst;
             $total=$total+$row->total; ?>
        <tr>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="53" align="left" valign=mi"middle">
                <b><font face="Book Antiqua" size=3>
                    <?php echo $row->invoice_number;?>
                </font></b>
            </td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><b><font face="Book Antiqua" size=3 ><?php echo $row->provider_name;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle" colspan="2"><b><font face="Book Antiqua" size=3><?php echo $row->description;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><b><font face="Book Antiqua" size=3><?php echo $row->hsn_code;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><b><font face="Book Antiqua" size=3><?php echo $row->period;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign="middle"><b><font face="Book Antiqua" size=3><?php echo $row->rate;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><b><font face="Book Antiqua" size=3><?php echo $row->amount;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle"><b><font face="Book Antiqua" size=3><?php echo $row->cgst;?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle" >
                <b><font face="Book Antiqua" size=3>
                    <?php echo $row->sgst;?>
                </font></b>
            </td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle" >
                <b><font face="Book Antiqua" size=3>
                    <?php echo $row->igst;?>
                </font></b>
            </td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign="middle" >
                <b><font face="Book Antiqua" size=3>
                    <?php echo $row->total;?>
                </font></b>
            </td>
        </tr>
         <?php endforeach; ?>
              
        
        <tr>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=7 height="25" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Total</font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><b><font face="Book Antiqua" size=3><?php echo sprintf('%0.2f', $amount);?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><b><font face="Book Antiqua" size=3><?php echo sprintf('%0.2f', $cgst);?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><b><font face="Book Antiqua" size=3><?php echo sprintf('%0.2f', $sgst);?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><b><font face="Book Antiqua" size=3><?php echo sprintf('%0.2f', $igst);?></font></b></td>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=bottom ><b><font face="Book Antiqua" size=3><?php echo sprintf('%0.2f', $total);?></font></b></td>
        </tr>
        <tr>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=8 height="26" align="left" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=3 rowspan=3 align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Total Invoice Amount</font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" rowspan=3 align="right" valign=middle bgcolor="#FFFF99" ><b><font face="Book Antiqua" size=4><?php echo sprintf('%0.2f', $total);?></font></b></td>
        </tr>
        <tr>
            <td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom><b><font face="Book Antiqua" size=3><br /></font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3></font></b></td>
            <td colspan=5 align="left" valign=bottom><b><font face="Book Antiqua" size=3><br /></font></b></td>
        </tr>
        <tr>
            <td style="border-left: 2px solid #000000" height="25" align="left" valign=bottom><b><font face="Book Antiqua" size=3><br /></font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td align="left" valign=bottom><b><font face="Book Antiqua" size=3></font></b></td>
            <td colspan=5 align="left" valign=bottom><b><font face="Book Antiqua" size=3><br /></font></b></td>
        </tr>
        <tr>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" height="2" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
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
            <td style="border-top: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=8 rowspan=3 height="78" align="justify" valign=top>
                <font face="Book Antiqua" size=1>1. This invoice is issued by the Service Provider and not by Cmcorps Integrated Services Private Limited. Cmcorps Integrated Services Private Limited acts only as an intermediary for the services. GST on the Total service charges and Other Charges (if applicable) is collected and remitted by Cmcorps Integrated Services Private Limited (GST Number 07AAFCC9951NZ10) in the capacity of an &quot;Electronic Commerce Operator&quot; as per Section 9(5) of the Central Goods &amp; Service Tax Act, 2017 and respective State GST laws.</font>
            </td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=4 rowspan=5 align="right" valign=bottom><img src="img/logo_sigclub.png" /><br /><b><font face="Book Antiqua" size=3 color="#000000">Authorized Signatory</font></b></td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
            <td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=8 rowspan=2 height="52" align="justify" valign=top>
                <font face="Book Antiqua" size=1>2. This invoice has been signed by the Authorized signatory of Cmcorps Integrated Services Private Limited only limited purposes of complying as an Electronic Commerce Operator.</font>
            </td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" height="4" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
            <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
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
            <td style="border-top: 2px solid #000000" colspan=12 height="22" align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
        </tr>
        <tr>
            <td colspan=12 rowspan=4 height="82" align="left" valign=bottom><i><font face="Book Antiqua"><br><img src="img/logo-1.png" width=188 height=72 hspace=30 vspace=6>
		</font></i></td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
    </table>
</div>
</div>
</body>

</html>