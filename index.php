<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>IsRobots?</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
		<!-- <form method="get" action="login.php" id="login"> -->
		<form id="url" class="form-group">
          <div>
				<select id="protokol" class="my-select" name="protocol">
					<option value="http">http://</option>
					<option value="https">https://</option>
				</select>		
				<input type="text" id="domen" class="my-input-text" name="domen" placeholder="example.com">		
			</div>
			<div>
				<input type="submit" class="my-input-btn" name="submitBtn" id="submitBtn" value="Check!" >
			</div>
        </form>
		<div class="result-data"></div>
			<!-- <table class="result-data">
				<tr>
					<td>11</td>	
					<td>12</td>		
				</tr>
				<tr>
					<td>21</td>	
					<td>22</td>		
				</tr>
				<tr>
					<td>31</td>	
					<td>32</td>		
				</tr>				
			</table> -->

	<script src="js/jquery.min.js"></script>
	<script src='js/main.js'></script>
</body>
</html>