<?php
// $url = "https://www.youtube.com/watch?v=BjrGkBvfGsA";
// $url_encurtada = strlen($url) + 1;

// $url_encurtada = "http://www.pudim.pu/". base_convert($url_encurtada, 10, 36);

?>
<style type="text/css">
	form {
		width: 80%;
		margin-left: 10%;
		margin-right: 10%;
	}
</style>
<link href="css/bootstrap.min.css" rel="stylesheet" />
<html>
	<body>
		<form>
			<div class="form-group">
				<label for="encurtar">Informe a URL que deseja encurtar</label>
				<input type="text" class="form-control" id="urlEncurtar" placeholder="urlEncurtar">
			</div>
			<button class="btn btn-success btnEncurtar">Encurtar</button>
			<table class="table tblUrl">
				<thead>
					<th>
						<td>URL</td>
						<td>URL Encurtada</td>
					</th>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</form>
	</body>
	
	<script src="js/bootstrap.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-3.2.1.min.js"></script>

	<script type="text/javascript">
		$().ready(function(){
			$.ajax({
				url: "encurtadorDAO.php",
	            type: 'POST',
	            data: {
	                action: "select"
	            },
	            success: function(result) {
	            	result = JSON.parse(result);

	            	$(result.data).each(function() {
	                	var tr = '<tr>';
	                    tr += '<td>' + this.url + '</td>';
	                    tr += '<td><a href="' + this.url + '" target="_blank">http://www.pudim.pu/' + this.url_encurtador + '</a></td>';
                    	tr += '</tr>';
					
                    	$(".tblUrl > tbody").append(tr);
	                });
        		}
			});

			$(".btnEncurtar").on("click", function(){
				var url = $("#urlEncurtar").val();

				if(url == "undefined" || url == ""){
					alert("informe uma url para encurtar");
				}else{
					$.ajax({
						url: "encurtadorDAO.php",
			            type: 'POST',
			            data: {
			                action: "insert",
			            	url: url
			            },
			            success: function(result) {
			            	result = JSON.parse(result);

	    					if(result.success == true){
	    						alert("Inserido com sucesso");
	    					}else{
	    						alert("ERRO");
	    					}
		        		}
					});
				}
			});
		});
	</script>
</html>