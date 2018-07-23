{literal}
<script>
	(function(i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] ||
		function() {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o),
		m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-107038257-1', 'auto');
	ga('send', 'pageview'); 
</script>
<script src="assets/js/jQuery-plugin-progressbar.js"></script>
{/literal}


<div class="col-md-12 resp-work-exp">
  <div class="msg-con" >
		{if $MSG!=""}
		<div style="background:#e9e4d4;height:40px;margin-bottom:20px;">
			<b style="font-size:24px;">{$MSG}</b>
		</div>
		{/if}
	</div>
	
	<div class="msg-con">
		<img src="assets/images/msg.png" width="30" height="30"> Recent Messages <a href="employer.php?action=messages" class="get-loc" style="float:right" > View All&nbsp; &nbsp; </a>

		<div style="height:1px; float:left; width:100%; background-color:#ccc; margin-top:10px" ></div>

		<form action="employer.php?action=home" method="POST">

			{foreach from=$DATA item=r key=key}
			<a class="msg-wrp" href="employer.php?action=read_message&id={$r.msg_id}" >#{$r.msg_number} &nbsp;  {$r.msg}
			<br>
			Last updated on {$DATA[0].msg_posted_on}
			<br>
			</a>
			{/foreach}
		</form>

	</div>
	

<br>
<br>


</div>