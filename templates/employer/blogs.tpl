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
<script>
	function getBlogData() {
		var pageSize = document.getElementById("page_size").value;
		var pageNumber = document.getElementById("page_no").value;
		var contentDiv = document.getElementById("blogsDiv");
		var callback = function(res) {
			var res = res.responseText;
			var data = JSON.parse(res);
			if (data.length > 0) {
				for (var i = 0; i < data.length; i++) {
					var parent = document.createElement("div");
					parent.className = "col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 job-item internship";
					var div1 = document.createElement("div");
					div1.className = "content-wrap";
					var div2 = document.createElement("div");
					div2.className = "company-info internship";
					div2.style.cssText = "border-top:1px solid #f8f8f8";
					var div3 = document.createElement("div");
					div3.className = "job-position art-blg";
					var t = document.createTextNode(data[i].title);
					div3.appendChild(t);
					div2.appendChild(div3);
					if (data[i].img_path != "") {
						var imgDiv = document.createElement("div");
						imgDiv.className = "job-description art-blog-txt";
						var img = document.createElement("IMG");
						img.setAttribute('src', data[i].img_path);
						img.style.width = "100%";
						img.style.height = "200px";
						imgDiv.appendChild(img);
						div2.appendChild(imgDiv);
					}
					div2.innerHTML = div2.innerHTML + " <a href='employer.php?action=readblog&id="+data[i].blog_id+"' class='read-more'><div class='text'>Read More</div><div class='right-arrow'><i class='fa fa-angle-right'></i></div></a>";

					div1.appendChild(div2);
					parent.appendChild(div1);
					contentDiv.appendChild(parent);
				}

			}

		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?page_no=" + pageNumber + "&page_size=" + pageSize +"&role=400"+ "&REQUEST=GET_BLOG_PAGE";
		var process = ajax.process(url, parameter);

	}

	function getNextBlogData() {
		var pageSize = document.getElementById("page_size").value;
		var pageNumber = parseInt(document.getElementById("page_no").value) + 1;
		var contentDiv = document.getElementById("blogsDiv");
		var callback = function(res) {
			var res = res.responseText;
			if (res.trim() == "NO") {
				alert("No More Blogs Available");
			} else {
				var data = JSON.parse(res);
				if (data.length > 0) {
					document.getElementById("page_no").value = pageNumber;
					while (contentDiv.firstChild) {
						contentDiv.removeChild(contentDiv.firstChild);
					}
					for (var i = 0; i < data.length; i++) {
						var parent = document.createElement("div");
						parent.className = "col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 job-item internship";
						var div1 = document.createElement("div");
						div1.className = "content-wrap";
						var div2 = document.createElement("div");
						div2.className = "company-info internship";
						div2.style.cssText = "border-top:1px solid #f8f8f8";
						var div3 = document.createElement("div");
						div3.className = "job-position art-blg";
						var t = document.createTextNode(data[i].title);
						div3.appendChild(t);
						div2.appendChild(div3);
						if (data[i].img_path != "") {
							var imgDiv = document.createElement("div");
							imgDiv.className = "job-description art-blog-txt";
							var img = document.createElement("IMG");
							img.setAttribute('src', data[i].img_path);
							img.style.width = "100%";
							img.style.height = "200px";
							imgDiv.appendChild(img);
							div2.appendChild(imgDiv);
						}
						div2.innerHTML = div2.innerHTML + " <a href='employer.php?action=readblog&id="+data[i].blog_id+"' class='read-more'><div class='text'>Read More</div><div class='right-arrow'><i class='fa fa-angle-right'></i></div></a>";

						div1.appendChild(div2);
						parent.appendChild(div1);
						contentDiv.appendChild(parent);
					}

				} else {
					alert("No More Blogs Available");
				}
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?page_no=" + pageNumber + "&page_size=" + pageSize +"&role=400"+ "&REQUEST=GET_BLOG_PAGE";
		//alert(url);
		var process = ajax.process(url, parameter);

	}

	function getPrvBlogData() {
		var pageSize = document.getElementById("page_size").value;
		var pageNumber = document.getElementById("page_no").value;
		//alert(pageNumber);
		if (pageNumber > 1) {
			pageNumber = parseInt(pageNumber) - 1;
			var contentDiv = document.getElementById("blogsDiv");
			var callback = function(res) {
				var res = res.responseText;
				//alert(res);
				var data = JSON.parse(res);
				if (data.length > 0) {
					document.getElementById("page_no").value = pageNumber;
					while (contentDiv.firstChild) {
						contentDiv.removeChild(contentDiv.firstChild);
					}
					for (var i = 0; i < data.length; i++) {
						var parent = document.createElement("div");
						parent.className = "col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 job-item internship";
						var div1 = document.createElement("div");
						div1.className = "content-wrap";
						var div2 = document.createElement("div");
						div2.className = "company-info internship";
						div2.style.cssText = "border-top:1px solid #f8f8f8";
						var div3 = document.createElement("div");
						div3.className = "job-position art-blg";
						var t = document.createTextNode(data[i].title);
						div3.appendChild(t);
						div2.appendChild(div3);
						if (data[i].img_path != "") {
							var imgDiv = document.createElement("div");
							imgDiv.className = "job-description art-blog-txt";
							var img = document.createElement("IMG");
							img.setAttribute('src', data[i].img_path);
							img.style.width = "100%";
							img.style.height = "200px";
							imgDiv.appendChild(img);
							div2.appendChild(imgDiv);
						}
						div2.innerHTML = div2.innerHTML + " <a href='employer.php?action=readblog&id="+data[i].blog_id+"' class='read-more'><div class='text'>Read More</div><div class='right-arrow'><i class='fa fa-angle-right'></i></div></a>";

						div1.appendChild(div2);
						parent.appendChild(div1);
						contentDiv.appendChild(parent);
					}
				}

			};
			var ajax = new Ajax(callback);
			var url = "admin/application/ajax.php";
			var parameter = "";
			url += "?page_no=" + pageNumber + "&page_size=" + pageSize +"&role=400"+ "&REQUEST=GET_BLOG_PAGE";
			//alert(url);
			var process = ajax.process(url, parameter);
		} else {
			alert("No More Blogs Available");
		}

	}


	$(document).ready(function() {

		getBlogData();
	});

</script>
{/literal}
<div style="clear:both;"></div>
<section style="padding:20px 0px 50px 0px;">
	<div class="col-md-12 resp-work-exp">
	<!--/.map-canvas -->

	<input type="hidden" id="page_size" name="page_size" value="6" />
	<input type="hidden" id="page_no" name="page_no" value="1" />

	<!--/.search-panel -->
	<h4>Blogs</h4>
	<div class="job-info-2">
		<div class="container-fluid">

			<div style="width:100%;" class="job-content-2 animated wow fadeIn" data-wow-delay="0.2s" id="blogsDiv">

			</div>
		</div>
	</div><!--/.job-info-2 -->

	<div class="col-md-12 text-center sec-h-pad-t">
		<ul class="pagination">
			<li>
				<a href="javascript:void(0)" onclick="getPrvBlogData()"><i class="fa fa-angle-left"></i></a>
			</li>

			<li>
				<a href="javascript:void(0)" onclick="getNextBlogData()"><i class="fa fa-angle-right"></i></a>
			</li>
		</ul>
	</div>

	</div><!--/.container -->

</section>
