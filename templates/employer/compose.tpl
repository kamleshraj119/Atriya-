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
		if (document.getElementById("msg_subject").value == "") {
			form_msg.msg_subject.focus();
			alert("Please select message subject");
			return false;
		} else if (document.getElementById("msg").value == "") {
			form_msg.msg.focus();
			alert("Please enter message");
			return false;
		}
		else
		{
			return true;
		}
	}
	function showOther(){
		var sub=document.getElementById("msg_subject1").value;
		if(sub=="Other"){
			document.getElementById("subDiv1").style.display= 'block';
		}else 	document.getElementById("subDiv1").style.display= 'none';
	}
</script>
{/literal}
<div class="col-md-12 resp-work-exp" style="margin-top:20px;">

	<h4>Write Message</h4>

	<form action="employer.php?action=send_message" method="post" name="form_msg" id="form_msg" onsubmit="return validateForm()">
		<div class="my-bookmark" style="margin-top:10px;">

			<div class="form-group">
				<input id="msgto" name="msgto" type="hidden" value="1,{$DATA[0].skc}" />
				<select name="msg_subject" id="msg_subject1" class="def-input" onchange="showOther();">
					<option value="" disabled selected>Select Message Subject</option>

					{foreach from=$SUBJECT item=r key=key}

					<option value="{$r.subject}">{$r.subject}</option>

					{/foreach}
				</select>

			</div>
			<div class="form-group" id="subDiv1" style="display: none;">
				<input type="text" name="sub_other" id="sub_other" class="def-input" placeholder="Subject" />
			</div>
			<div class="form-group">
				<textarea name="msg" id="msg"  class="def-input" style="height:100px;" placeholder="Message"></textarea>
			</div>
			<input type="submit" class="get-loc">

		</div>
	</form>

</div>

