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
<form enctype= "multipart/form-data" action="candidate.php?action=upload_video" method="POST" name="videofrm">
	<div class="col-md-12 resp-work-exp" style="margin-top:20px;">

		<div class="job-info-2">

			<h4>Articles</h4>

			<div class="container-fluid">
				<div class="row">
				<div class="job-content-2 animated wow fadeIn" data-wow-delay="0.2s">
					{foreach from=$DATA item=r key=key}
					<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 job-item internship">
						<div class="content-wrap">

							<div class="company-info internship" style="border-top:1px solid #f8f8f8">

								<div class="job-position art-blg">
									{$r.title}
								</div>
								<div class="job-description art-blog-txt">
									{$r.content|substr:0:30}...
								</div>
								<a href="employer.php?action=readarticles&id={$r.article_id}"  class="read-more">
								<div class="text">
									Read More
								</div>
								<div class="right-arrow">
									<i class="fa fa-angle-right"></i>
								</div></a>
							</div>
						</div>
					</div>
					{/foreach}

					<!--/.job-item -->

					<!--/.job-item -->

				</div>
				</div>
			</div>
		</div>

	</div>
