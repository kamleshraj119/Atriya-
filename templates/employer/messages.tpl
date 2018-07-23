<div class="col-md-12 body resp-work-exp" style="margin-top:20px;">

	<h4>Messages</h4>

	<div class="my-bookmark" style="margin-top:10px; overflow-x: scroll; width: 100%;">
		

				<table class=" table-hover js-basic-example dataTable large-table">
              
				<thead style="border-bottom:3px solid #fcc512 !important;">
					<tr style="background: #eee;">
						<th><a href="#" class="row-head">S.No<b class="caret"></b></a></th>
						<th><a href="#" class="row-head">Message ID<b class="caret"></b></a></th>
						<th><a href="#" class="row-head">From<b class="caret"></b></a></th>
						<th><a href="#" class="row-head">To <b class="caret"></b></a></th>
						<th><a href="#" class="row-head">Message<b class="caret"></b></a></th>
						<th><a href="#" class="row-head">Posted On<b class="caret"></b></a></th>
						<th><a href="#" class="row-head">Status <b class="caret"></b></a></th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$DATA item=r key=key}
					<tr>
						<td>{$key+1}.</td>
						<td style="{if $r.is_read=="NO"}font-weight:bold{/if}"><a href="employer.php?action=read_message&id={$r.msg_id}">#{$r.msg_number}{$r.msg_id}</a></td>
						<td style="{if $r.is_read=="NO"}font-weight:bold{/if}">{$r.from}</td>
						<td style="{if $r.is_read=="NO"}font-weight:bold{/if}">{$r.to}</td>
						<td style="{if $r.is_read=="NO"}font-weight:bold{/if}"><b>{$r.msg_subject|truncate:30:'..':true:true}</b><br /><a href="employer.php?action=read_message&id={$r.msg_id}">{$r.msg|truncate:30:'..':true:true}</a></td>
						<td style="{if $r.is_read=="NO"}font-weight:bold{/if}">{$r.msg_posted_on}</td>
						<td style="{if $r.is_read=="NO"}font-weight:bold{/if}"><a href="javascript:void(0);" class="get-loc" style="padding:10px;">{$r.msg_status}</a></td>
					</tr>
					{/foreach}
					
					<!--{foreach from=$DATA item=r key=key}
					<tr>
						<td><a href="employer.php?action=read_message&id={$r.msg_id}">#{$r.msg_number}</a></td>
						<td><a href="employer.php?action=read_message&id={$r.msg_id}">{$r.msg}</a></td>
						<td>{$r.msg_posted_on|date_format:"%H:%M,  %b %e, %Y"}</td>
						<td><a href="#" class="reply" style="color:#fff">{$r.msg_status}</a></td>
					</tr>
					{/foreach}-->
				</tbody>
			</table>
		</div>


</div>