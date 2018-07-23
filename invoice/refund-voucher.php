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
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  } 
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  } 
		comment { display:none;  } 
	</style>
	
</head>

<body>

<div class="container">
	<div class="row">
<table align="left" cellspacing="0" border="0">
	<colgroup width="124"></colgroup>
	<colgroup width="73"></colgroup>
	<colgroup width="63"></colgroup>
	<colgroup width="178"></colgroup>
	<colgroup width="117"></colgroup>
	<colgroup width="131"></colgroup>
	<colgroup width="54"></colgroup>
	<colgroup width="149"></colgroup>
	<colgroup width="155"></colgroup>
	<tr>
		<td colspan=8 height="61" align="left" valign=middle><b><font face="Book Antiqua" size=6>Cmcorps Integrated Services Pvt Ltd</font></b></td>
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
		<td colspan=9 height="26" align="left" valign=bottom><i><font face="Book Antiqua" size=4><br></font></i></td>
		</tr>
	<tr>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=9 height="35" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Refund Voucher</font></b></td>
		</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="23" align="left" valign=bottom><b><font face="Book Antiqua" size=3>Customer Name : <?php echo $data[0]->customer_name;?></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td colspan=3 rowspan=2 align="left" valign=top><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000;" colspan="4" align="left" valign=middle><b><font face="Book Antiqua" size=3>Refund No : <?php echo $data[0]->refund_number;?></font></b></td>
		
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000;  border-right: 2px solid #000000;" align="left" valign=middle colspan="4"><b><font face="Book Antiqua" size=3>Refund Date : <?php echo $data[0]->refund_date;?></font></b></td>
		
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="27" align="left" valign=top><b><font face="Book Antiqua" size=3>Billing Address : <?php echo $data[0]->billing_address;?></font></b></td>
		<td align="left" valign=top><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3><br></font></b></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="39" align="left" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=top><b><font face="Book Antiqua" size=3>Place of Supply</font></b></td>
		<td style="border-top: 1px solid #000000" align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 1px solid #000000" align="left" valign=bottom ><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-right: 2px solid #000000" align="left" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="28" align="left" valign=bottom><b><font face="Book Antiqua" size=3>GSTIN : <?php echo $data[0]->gstin;?></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3 color="#000000"><br></font></b></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3>State Code :</font></b></td>
		<td style="border-top: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3><?php echo $data[0]->state_code;?></font></b></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3>State Name :</font></b></td>
		<td style="border-top: 1px solid #000000; border-right: 2px solid #000000" align="left" valign=middle ><b><font face="Book Antiqua" size=3><?php echo $data[0]->state_name;?></font></b></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="44" align="left" valign=top><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-bottom: 1px solid #000000" colspan=2 rowspan=2 align="left" valign=top><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle><b><font face="Book Antiqua" size=3>Invoice/Receipt Date :</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle><b><font face="Book Antiqua" size=3><?php echo $data[0]->invoice_date;?></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 2px solid #000000" align="left" valign=middle ><b><font face="Book Antiqua" size=3><br></font></b></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000" height="49" align="left" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" colspan="2" valign=middle><b><font face="Book Antiqua" size=3>Invoice/Receipt No :</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000" align="left" colspan="2" valign=middle><b><font face="Book Antiqua" size=3><?php echo $data[0]->invoice_number;?></font></b></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="7" align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-right: 2px solid #000000" align="left" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000" height="94" align="left" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>HSN CODE</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=7 align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Description of Services</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Amount</font></b></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="20" align="left" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" colspan=7 align="center" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
		<td style="border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=bottom ><font face="Book Antiqua" size=3><br></font></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom ><b><font face="Book Antiqua" size=3><?php echo $data[0]->hsn;?></font></b></td>
		<td style="border-left: 1px solid #000000" colspan=7 align="left" valign=top><b><font face="Book Antiqua" size=3><?php echo $data[0]->description;?></font></b></td>
		<td style="border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign="middle" ><font face="Book Antiqua" size=3 ><?php echo $data[0]->amount;?></font></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-left: 1px solid #000000" colspan=7 align="left" valign=top><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=bottom ><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="27" align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-left: 1px solid #000000" colspan=7 align="left" valign=top><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=bottom ><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="27" align="left" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
		<td style="border-left: 1px solid #000000" colspan=7 align="left" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
		<td style="border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=bottom ><font face="Book Antiqua" size=3><br></font></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="27" align="left" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
		<td style="border-left: 1px solid #000000" colspan=7 align="left" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
		<td style="border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=bottom ><font face="Book Antiqua" size=3>  </font></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="25" align="left" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
		<td style="border-left: 1px solid #000000" colspan=7 align="left" valign=bottom><font face="Book Antiqua" size=3><br></font></td>
		<td style="border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=bottom ><font face="Book Antiqua" size=3><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" colspan=6 height="32" align="left" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Statutory Details </font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" align="center" rowspan=2  valign="middle" bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Total</font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" rowspan=2 align="right" valign=middle bgcolor="#FFFF99" ><b><font face="Book Antiqua" size=4><?php echo $data[0]->amount;?></font></b></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="25" align="left" valign=bottom><b><font face="Book Antiqua" size=3>GSTIN</font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3>:</font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3>07AAFCC9951N1Z0</font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		
		</tr>
	<tr>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" height="2" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=middle bgcolor="#FFFF99" ><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom colspan="7"><b><font face="Book Antiqua" size=3><br></font></b></td>
		
		<td style="border-top: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" align="right" valign=bottom><b><font face="Book Antiqua" size=3>CGST @ 9%</font></b></td>
		<td style="border-top: 2px solid #000000; border-right: 2px solid #000000" align="right" valign=middle ><font face="Book Antiqua" size=3><?php echo $data[0]->cgst;?></font></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom colspan="7"><b><font face="Book Antiqua" size=3><br></font></b></td>
	    <td style="border-left: 2px solid #000000; border-right: 2px solid #000000" align="right" valign=bottom><b><font face="Book Antiqua" size=3>SGST @ 9%</font></b></td>
		<td style="border-right: 2px solid #000000" align="right" valign=middle ><font face="Book Antiqua" size=3><?php echo $data[0]->sgst;?></font></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="22" align="left" valign=bottom colspan="7"><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" align="right" valign=bottom><b><font face="Book Antiqua" size=3>IGST @ 18%</font></b></td>
		<td style="border-right: 2px solid #000000" align="right" valign=middle ><font face="Book Antiqua" size=3><?php echo $data[0]->igst;?></font></td>
	</tr>
	
	<tr>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" height="4" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=middle bgcolor="#FFFF99" ><font face="Book Antiqua" size=3 color="#FFFFFF"><br></font></td>
	</tr>
	<tr>
		<td style="border-left: 2px solid #000000" height="44" align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua"><br></font></td>
		<td style="border-left: 2px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF99"><b><font face="Book Antiqua" size=4>Total Due</font></b></td>
		<td style="border-bottom: 2px solid #000000; border-right: 2px solid #000000" align="right" valign=middle bgcolor="#FFFF99" ><b><font face="Book Antiqua" size=3><?php echo $data[0]->refund_amount;?></font></b></td>
	</tr>
	<tr>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000" height="4" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFF99"><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 2px solid #000000" align="right" valign=middle bgcolor="#FFFF99" ><font face="Book Antiqua" size=3><br></font></td>
	</tr>
	<tr>
		<td height="22" align="left" valign=bottom><b><font face="Book Antiqua" size=3><br></font></b></td>
		<td align="left" valign=bottom><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom ><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><font face="Book Antiqua"><br></font></td>
	</tr>
	<tr>
		<td height="39" align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom><font face="Book Antiqua"><br></font></td>
		<td align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td colspan=2 align="left" valign=bottom><font color="#000000"><br></font></td>
		</tr>
	<tr>
		<td height="20" align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom ><i><font face="Book Antiqua"><br></font></i></td>
		<td align="right" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
	</tr>
	<tr>
		<td height="20" align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom ><i><font face="Book Antiqua"><br></font></i></td>
		<td align="left" valign=bottom><font face="Book Antiqua"><br></font></td>
	</tr>
	<tr>
		<td height="20" align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=1><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=1><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=1><br></font></b></td>
		<td align="right" valign=bottom><i><font face="Book Antiqua"><br></font></i></td>
		<td align="right" valign=bottom><font face="Book Antiqua"><br></font></td>
	</tr>
	<tr>
		<td height="24" align="left" valign=bottom><img src="img/logo-1.png"></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=1><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="right" valign=bottom><br></font></b></td>
		<td style="" colspan=4 align="right" valign=bottom><b><font face="Book Antiqua" size=3 color="#000000">Authorized Signatory</font></b></td>
	</tr>
	<tr>
		<td height="24" align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua" size=1><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="left" valign=bottom><b><font face="Book Antiqua"><br></font></b></td>
		<td align="right" valign=bottom></td>
		<td align="right" valign=bottom><font face="Book Antiqua"><br></font></td>
	</tr>
</table>

</div>
</div>
<!-- ************************************************************************** -->

</body>

</html>