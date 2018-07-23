<form enctype= "multipart/form-data" action="candidate.php?action=upload_video" method="post" name="videoform" id="videoform">
	<div class="col-md-12" style="margin-top:20px;">
		<div class="msg-con" >
			{if $MSG!=""}
			<div style="background:#e9e4d4;height:40px;margin-bottom:20px;">
				<b style="font-size:24px;">{$MSG}</b>
			</div>
			{/if}
		</div>
		<h4>Videos</h4>

		<div class="my-bookmark post-a-job" style="margin-top:10px;">
			<div class="form-group">

				<input type="text" name="youtube" id="youtube" class="def-input" placeholder="youtube or google drive link">

			</div>
			<div class="form-group mar-t-20 mar-b-20" style="padding:15px; background: cadetblue; color: white; border-radius:5px;">

				<h5 style="color: white;">or</h5>
				<h3 style="color: white;font-size: 18px;">Upload video directly to youtube</h3>
				{if $AUTH_REQ=='NO'}
				<div class="def-btn upload-file-btn">
					<span><i class="fa fa-upload"></i>&nbsp; Browse Video</span>
					<input type="file" name="filename" id="filename" class="upload">
				</div>
				<div class="small-desc">
					Max 32MB
				</div>

				{else}

				<p>
					Please <a class="video-access-btn" href="{$AUTH_URL}">authorize access</a> before proceeding.
				<p>
					{/if}

			</div>
			<!--<div class="form-group mar-t-20 mar-b-20" style="padding:0px;">

			<h5>OR</h5>

			<div class="def-btn upload-file-btn">
			<span><i class="fa fa-upload"></i>&nbsp; Browse Video</span>
			<input type="file" name="filename" id="filename" class="upload">
			</div>
			<div class="small-desc">
			Max 32MB
			</div>

			</div>-->
		</div>
		<a href="javascript:void(0)" onclick="UploadVideo()" class="get-loc">Submit</a>

		<div class="job-info-2">

			<h4>Uploaded Videos</h4>

			<div>

				<div class="job-content-2 animated wow fadeIn" data-wow-delay="0.2s">
					{foreach from=$VIDEOS item=r key=key}

					<div class="col-md-4 col-sm-6 job-item fulltime">
						<div class="content-wrap">
							<div class="company-logo valign-wrap">
								<div class="valign-middle">
									{if $r.vtype=="mp4"}
									<video height="250" width="100%" controls>
										<source src="http://skillchamps.in/videos/{$r.uid}/{$r.videoURL}" type="video/mp4">

										Your browser does not support the video tag.
									</video>
									{else}
									<iframe width="100%"  height="250" src="https://www.youtube.com/embed/{$r.videoURL}" frameborder="0" allowfullscreen></iframe>
									{/if}
								</div>
							</div>
							<div class="company-info parttime">
								<div class="job-type" style="padding-top:10px; padding-bottom:5px;">
									<div class="job-info-2-type-age">
										Dated : {$r.added_date}
										<br>
										Approval Status: {if $r.status=='Approved' OR $r.status=='Rejected'}{$r.status}{else}Pending{/if}
									</div>

								</div>

							</div>
						</div>
					</div><!--/.job-item -->
					{/foreach}

					<!--/.job-item -->

					<!--/.job-item -->

				</div>

			</div>
		</div>

	</div>
