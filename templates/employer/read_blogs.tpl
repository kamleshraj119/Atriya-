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
{/literal}
<div class="col-md-12 resp-work-exp" style="margin-top:20px;">

	<div class="job-info-2">

		<h4>{$DATA[0].title}</h4>

		<div class="job-description art-blog-txt">
			{$DATA[0].content|unescape:"html"}
		</div>

	</div>

<h3>Posted -by</h3>

	<h4>"{$DATA[0].posted_by}" </h4>
	<h4>Posted -Date</h4>
	<h4>{$DATA[0].posted_on}</h4>


</div>


