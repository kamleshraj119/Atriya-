	<div class="col-md-12" style="margin-top:72px;">

		<div class="personal-data col-md-12">

				<div class="col-md-12">
					<div >
						<h4>Notifications</h4>
					</div>
				</div>
				<div class="col-md-12">
					<div class="my-bookmark" style="margin-top:10px;">
						{foreach from=$DATA  item=$cn key=key}
                                              <img src="http://skillchamps.in/admin/images/broadcast/{$cn.image}" style="max-width:100%;max-height:200px;" align="center">
                                              <div class="mail-contnet">
                                                    <h5>{$cn.title}&nbsp;&nbsp;({$cn.timestamp})</h5> <span class="mail-desc">{$cn.message}</span> <span class="time">Profile</span> </div><br><br>
                        {/foreach}
                        
					</div>
				</div>

			</div>

	</div>
	

