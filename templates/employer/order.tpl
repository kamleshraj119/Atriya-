{literal}
<style>
    	.fl{float: left;}
    	.fr{float: right}
    	.order-id{padding: 20px 20px 20px 20px; border-bottom: 1px solid rgba(204, 204, 204, 0.5);}
    	.order-id a{padding: 10px;
					float: left;
					word-wrap: break-word;
					height: auto;
					color: #000;
					text-align: center;}

		.cancel-button {padding: 20px 20px 20px 20px; border-bottom: 1px solid rgba(204, 204, 204, 0.5);}
		.cancel-button a{padding: 10px;
					float: right;
					word-wrap: break-word;
					height: auto;
					color: #000;
					text-align: center;}

		.order-date{padding: 20px 20px 10px 20px; border-top: 1px solid rgba(204, 204, 204, 0.5);}
    	.order-date p{padding: 10px;
					}

		.total-order {padding: 20px 20px 10px 20px; border-top: 1px solid rgba(204, 204, 204, 0.5);}
		.total-order p{padding: 10px;}

		.about-p {padding: 20px;}
		.about-p p{line-height: 14px;}


		.another-p {padding: 20px;}

		.another-p p{line-height: 14px;}

    </style>
{/literal}


<div class="container-fluid resp-work-exp">
	  	{assign var=counter  value="0" scope="global"}
		{if $DATA|@count gt 0}
		{assign "prv" ""}
		{assign "current" ""}
		{assign "next" ""}
		{foreach from=$DATA item=$r key=key}
		{if $r.transaction_status eq "TXN_SUCCESS" && $r.transaction_id != ""}
		 {$counter = $counter+1}
		{assign "current" $r.id}
		{assign "next" $DATA[$key+1].id}
        <div {if $current!=$prv} style="border:1px solid #ccc;" {else} style="border-left:1px solid #ccc;border-right:1px solid #ccc;border-bottom:1px solid #ccc;" {/if} class="row">
        	{if $current!=$prv}
        	<div class="col-xl-6 col-md-6 col-lg-6 col-md-6 col-sm-12 order-id">
        		<a style="background-color: #062223; color:#ffffff; cursor: static;">{$r.order_number}</a>
        	</div>
        	<div class="col-xl-6 col-md-6 col-lg-6 col-md-6 col-sm-12 cancel-button">
        		{if $r.canceled=="NO" && $r.show=="YES"}
        			<a href="javascript:void(0);" style="background-color: #cccccc;" onclick="cancelOrder('{$r.id}');">CANCEL</a>
        			{else}
        			<a href="#" style="background-color: #cccccc;visibility: hidden;" >CANCEL</a>
        		{/if}
        	</div>
			{/if}
        	<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-12">
        		{if $r.profile_pic!=""}
					<img style="padding: 20px 0px 10px 10px;" width="100px" src="http://skillchamps.in/admin/images/candidate/{$r.uid}/{$r.profile_pic}">
					{else}
					<img style="padding: 20px 0px 10px 10px;" width="100px" src="http://skillchamps.in/assets/images/individu-1.png">
				{/if}
        	</div>
        	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-12 about-p">
        		<p style="margin-top:35px;">{$r.name}</p>
        		<p>	Salary : ₹{$r.sal}</p>
           	</div>

        	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12 another-p">
        		<p style="margin-top:35px;"> Period : {$r.period}</p>
        		  <p>{$r.from_date} to {$r.to_date}</p>
        		 
        	</div>
        	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-12 about-p">
        		<p style="margin-top:35px;">	Manpower charge : ₹{$r.am}</p>
        		
        	</div>
        	
        	<div style="clear: both;"></div>
        	
			{if $current!=$next}
	            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 order-date">
	        		<p>Order Date: <b>{$r.added_date}</b></p>
	        		
	        	</div>
	        	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 total-order">
	        		<p class="fr">Order Total: <b>₹{$r.total|string_format:"%.2f"}</b></p>
	        	</div>
	        	
			{/if}

			{assign "prv" $current}
        </div>
        {/if}
		{if $current!=$next}
      	<br>
		{/if}		
        {/foreach}
        {/if}     
		 {if $counter eq 0 || $counter == ""}	 
			No Items.
		{/if}



    </div>






{literal}
<script>
	function ShowExp(id) {
		var callback = function(res) {
			var response = res.responseText;
			response = response.trim();
			if (response == "NO") {
				alert("No experience detail found.");
			} else {
				document.getElementById("expDiv").innerHTML = response;
				$('#work_experience').modal('show');
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?cid=" + id + "&REQUEST=EMPLOYEMENT_HISTORY_POPUP";
		var process = ajax.process(url, parameter);

	}

	function ShowVideo(id) {
		//document.getElementById("videoBox").innerHTML=id;
		var callback = function(res) {
			var response = res.responseText;
			response = response.trim();
			//alert(response);
			if (response == "NO") {
				alert("No video found");
			} else {
				document.getElementById("canvideoBox").innerHTML = response;
				$('#canvideo').modal('show');
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?cid=" + id + "&REQUEST=GET_CANDIDATE_VIDEO";
		var process = ajax.process(url, parameter);

	}

	function ShowNextVideo() {
		var id = document.getElementById("cid").value;
		var cvid = document.getElementById("cvid").value;
		var callback = function(res) {
			var response = res.responseText;
			response = response.trim();
			if (response == "NO") {
				alert("No more videos");
			} else {
				document.getElementById("canvideoBox").innerHTML = response;
				$('#canvideo').modal('show');
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?cid=" + id + "&vid=" + cvid + "&REQUEST=getCandidateNextVideo";
		var process = ajax.process(url, parameter);

	}

	function ShowPrevVideo() {
		var id = document.getElementById("cid").value;
		var cvid = document.getElementById("cvid").value;
		var callback = function(res) {
			var response = res.responseText;
			response = response.trim();
			if (response == "NO") {
				alert("No more videos");
			} else {
				document.getElementById("canvideoBox").innerHTML = response;
				$('#canvideo').modal('show');
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?cid=" + id + "&vid=" + cvid + "&REQUEST=getCandidatePrevVideo";
		var process = ajax.process(url, parameter);

	}

	function deleteFromCart(avId) {

		var callback = function(res) {
			var response = res.responseText;
			alert(response);
			window.location.reload();
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?&av_id=" + avId + "&REQUEST=DELETE_CART_CANDIDATE";
		var process = ajax.process(url, parameter);
	}

	function cancelOrder(id) {
		var callback = function(res) {
			var response = res.responseText;
			alert(response);
			window.location.reload();
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?id=" + id + "&REQUEST=CANCEL_ORDER";
		var process = ajax.process(url, parameter);
	}
</script>
{/literal}

