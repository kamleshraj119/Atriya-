{literal}
<style>
	.main-ratn {
		width: 33%;
		float: left;
	}
	.rating-txt {
		width: 100%;
		float: left;
		text-align: center;
		font-size: 13px;
	}
	.rating-str {
		width: 100%;
		float: left;
	}
	form .stars {
		background: url("stars.png") repeat-x 0 0;
		width: 100px;
		margin: 0 auto;
	}

	form .stars input[type="radio"] {
		position: absolute;
		opacity: 0;
		filter: alpha(opacity=0);
	}
	form .stars input[type="radio"].star-5:checked ~
	span {
		width: 100%;
	}
	form .stars input[type="radio"].star-4:checked ~
	span {
		width: 80%;
	}
	form .stars input[type="radio"].star-3:checked ~
	span {
		width: 60%;
	}
	form .stars input[type="radio"].star-2:checked ~
	span {
		width: 40%;
	}
	form .stars input[type="radio"].star-1:checked ~
	span {
		width: 20%;
	}
	form .stars label {
		display: block;
		width: 20px;
		height: 20px;
		margin: 0 !important;
		padding: 0 !important;
		text-indent: -999em;
		float: left;
		position: relative;
		z-index: 10;
		background: transparent !important;
		cursor: pointer;
	}
	form .stars label:hover ~
	span {
		background-position: 0 -30px;
	}
	form .stars label.star-5:hover ~
	span {
		width: 100% !important;
	}
	form .stars label.star-4:hover ~
	span {
		width: 80% !important;
	}
	form .stars label.star-3:hover ~
	span {
		width: 60% !important;
	}
	form .stars label.star-2:hover ~
	span {
		width: 40% !important;
	}
	form .stars label.star-1:hover ~
	span {
		width: 20% !important;
	}
	form .stars span {
		display: block;
		width: 0;
		position: relative;
		top: 0;
		left: 0;
		height: 30px;
		background: url("stars.png") repeat-x 0 -60px;
		-webkit-transition: -webkit-width 0.5s;
		-moz-transition: -moz-width 0.5s;
		-ms-transition: -ms-width 0.5s;
		-o-transition: -o-width 0.5s;
		transition: width 0.5s;
	}

</style>
<script>
function validateForm() {
  var rate = document.getElementsByName("star");
   var ratestar = 0;
    for(i=0;i<rate.length;i++){
      if(rate[i].checked == true){
        ratestar++;
        break;
        }
       }
	if (ratestar == 0) {
			rate[0].focus();
			alert("Please rate candidate");
			
			return false;
		} 
	else if (document.getElementById("remark").value == "") {
			alert("Please mention the remark");
			form_rating.remark.focus();
			return false;
		}
	else
	{
		return true;
	}
}
</script>

{/literal}
<div class="col-md-12 resp-work-exp" style="margin-top:20px;">

	<h4>Rate Candidate</h4>

	<form action="employer.php?action=save_user_rating" method="post" name="form_rating" id="form_rating" onsubmit="return validateForm()">
		<div class="my-bookmark" style="margin-top:10px;">

			<div class="form-group">

				<div class="job-rating" style="padding-bottom:8px;">
					<div class="main-ratn">

						<div class="rating-txt">
							<input type="hidden" name="uid_to" id="uid_to" value="{$UID_TO}"/>
							<input type="hidden" name="uid_from" id="uid_from" value="{$UID_FROM}"/>
							<input type="hidden" name="redirect" id="redirect" value="employer.php"/>
						</div>
						<div class="rating-str">

							<div style="float: left;" class="stars">
								<input type="radio" name="star" class="star-1" id="star-1-1" value="1"/>
								<label class="star-1" for="star-1-1">1</label>
								<input type="radio" name="star" class="star-2" id="star-1-2" value="2"/>
								<label class="star-2" for="star-1-2">2</label>
								<input type="radio" name="star" class="star-3" id="star-1-3" value="3"/>
								<label class="star-3" for="star-1-3">3</label>
								<input type="radio" name="star" class="star-4" id="star-1-4" value="4"/>
								<label class="star-4" for="star-1-4">4</label>
								<input type="radio" name="star" class="star-5" id="star-1-5" value="5"/>
								<label class="star-5" for="star-1-5">5</label>
								<span></span>
							</div>
						</div>
					</div>
				</div>

			</div>
			<br/>
			<div class="form-group">
				<textarea name="remark" id="remark"  class="def-input" style="height:100px;" placeholder="Remark"></textarea>
			</div>
			<input type="submit" class="reply">
		</div>
	</form>

</div>