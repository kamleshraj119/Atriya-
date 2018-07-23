<div class="col-md-12 body" style="margin-top:20px;">

	<h4>Messages</h4>

	<div class="my-bookmark" style="margin-top:10px;">
		

				<table class=" table-hover js-basic-example dataTable large-table">
              
				<thead style="border-bottom:3px solid #fcc512 !important;">
					<tr style="background: #eee;">
						<th><a href="javascript:void(0);" class="row-head">S.No<b class="caret"></b></a></th>
						<th><a href="javascript:void(0);" class="row-head">Message ID<b class="caret"></b></a></th>
						<th><a href="javascript:void(0);" class="row-head">From<b class="caret"></b></a></th>
						<th><a href="javascript:void(0);" class="row-head">To<b class="caret"></b></a></th>
						<th><a href="javascript:void(0);" class="row-head">Message<b class="caret"></b></a></th>
						<th><a href="javascript:void(0);" class="row-head">Posted On<b class="caret"></b></a></th>
						<th><a href="javascript:void(0);" class="row-head">Status <b class="caret"></b></a></th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$DATA item=r key=key}
					<tr>
						<td style="width:50px;">{$key+1}.</td>
						<td style="width:150px;{if $r.is_read=="NO"}font-weight:bold{/if}"><a href="candidate.php?action=read_message&id={$r.msg_id}">#{$r.msg_number}{$r.msg_id}</a></td>
						<td style="width:150px;{if $r.is_read=="NO"}font-weight:bold{/if}">{$r.from}</td>
						<td style="width:150px;{if $r.is_read=="NO"}font-weight:bold{/if}">{$r.to}</td>
						<td style="width:150px;{if $r.is_read=="NO"}font-weight:bold{/if}"><b>{$r.msg_subject|truncate:30:'..':true:true}</b><br /><a href="candidate.php?action=read_message&id={$r.msg_id}">{$r.msg|truncate:30:'..':true:true}</a></td>
						<td style="width:150px;{if $r.is_read=="NO"}font-weight:bold{/if}">{$r.msg_posted_on}</td>
						<td style="width:150px;{if $r.is_read=="NO"}font-weight:bold{/if}"><a href="javascript:void(0);" class="get-loc" style="padding:10px;">{$r.msg_status}</a></td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</div>


</div>