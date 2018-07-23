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

	function validateForm() {
		 if (document.getElementById("replied_msg").value == "") {
			reply_msg.replied_msg.focus();
			alert("Please enter message");
			return false;
		}
		return true;
	}

</script>
{/literal}
<div class="col-md-12" style="margin-top:20px;">

	<h4>Messages</h4>

	<form action="candidate.php?action=send_reply" name="reply_msg" id="reply_msg" method="post" onsubmit="return validateForm()">

		<div class="my-bookmark" style="margin-top:10px;">
			<h5 style="margin-bottom:10px;">Ticket ID: #{$DATA[0].msg_number} </h5>
			<div class="form-group">

				<select name="replied_status" id="replied_status" class="def-input def-select">
					<option value="" selected>Status</option>
					<option value="Open" {if $DATA[0].msg_status=="Open"}selected{/if}>Open</option>
					<option value="In Progress" {if $DATA[0].msg_status=="In Progress"}selected{/if}>In Progress</option>
					<option value="Closed" {if $DATA[0].msg_status=="Closed"}selected{/if}>Closed</option>

				</select>

			</div>
			<div class="form-group">
				<textarea name="replied_msg" id="replied_msg"  class="def-input" style="height:100px;" placeholder="Message"></textarea>				

 <input type="hidden" name="mid" id="mid" value="{$DATA[0].msg_id}">

			</div>
			<input type="submit" class="get-loc">

		</div>
	</form>

</div>

<div class="supp-msg">
	<div class="supp-name">
		<div style="font-size:14px; float:left;">
			<i class="fa fa-lg fa-user"></i> &nbsp;&nbsp;{$DATA[0].from}
		</div>
		<div style="float:right; font-size:12px;">
			{$DATA[0].msg_posted_on|date_format:"%H:%M,  %b %e, %Y"}
		</div>

	</div>
	<div class="supp-txt">
		<p style="font-size:13px; line-height:20px;" >
			{$DATA[0].msg}
		</p>

	</div>
</div>
{foreach from=$REPLY item=r key=key}
<div class="supp-msg">
	<div class="supp-name-gry">
		<div style="font-size:14px; float:left;">
			<i class="fa fa-lg fa-user"></i>  &nbsp;&nbsp;
			{if $r.reply_from=="1"}
			Admin
			{else}
			{$r.name}
			{/if}
		</div>
		<div style="float:right; font-size:12px;">
			{$r.replied_on|date_format:"%H:%M,  %b %e, %Y"}
		</div>
	</div>
	<div class="supp-txt">
		<p style="font-size:13px; line-height:20px;">
			{$r.replied_msg}
		</p>

	</div>
</div>
{/foreach}

