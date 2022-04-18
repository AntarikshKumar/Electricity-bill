<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Electricity Bill Calculator</title>
		<link rel="stylesheet" href="style.css">

		<!-- Bootstrap CSS -->
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

		
		<script src="http://code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</head>
	<body>

	<div class="container">
		<h1>Electricity Bill Calculator</h1>
		<form action="" method="POST" role="form">
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<label for="">Total Unit / Kwh</label>
					<input type="text" class="form-control" name="unit" placeholder="Input total Unit">
				</div>
			</div>

			<div class="col-lg-6">
				<div class="form-group">
					<label for="">Meter Charge</label>
					<select class="form-control" name="meter">
						<option value="100">100 Rupees</option>
						<option value="175">175 Rupees</option>
					</select>
				</div>
			</div>
			
			<div class="col-lg-6">
				<button type="submit" class="btn btn-primary">Calculate</button>
			</div>
		</div>
		</form>

		<hr>
		<?php
		if(isset($_POST['unit']))
		{
			$total = 0;
			$unit = (int) $_POST['unit'];

			function calculate($unit,$range,$price)
			{
				$xunit = $range[1]-$range[0]+1;
				if($unit<=$xunit && $unit>0)
				{
					$bill = $unit  * $price;
					echo "
						<tr>
							<td>".implode("-", $range)."</td>
							<td>$price</td>
							<td>$unit</td>
							<td>$bill Rupees</td>
						</tr>
						";
					return array($unit-$xunit, $bill);
				}
				elseif($unit>$xunit)
				{
					$bill = $xunit * $price;
					$newUnit = $unit - $xunit;
					echo "
						<tr>
							<td>".implode("-", $range)."</td>
							<td>$price</td>
							<td>".$xunit."</td>
							<td>$bill Rupees</td>
						</tr>
						";
					return array($newUnit, $bill);
				}
			}

			echo "<h3>Bill for $unit Unit</h3>";

			echo "<table class=\"table table-hover\">
			<thead>
				<tr>
					<th>Range</th>
					<th>Price/Unit</th>
					<th>Unit</th>
					<th>Bill</th>
				</tr>
			</thead>
			<tbody>
				
			";

			$newUnit = 0;
			if($unit>0)
			{
				$rep = calculate($unit,array(1,75),3.53);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(76,200),5.01);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(201,300),5.19);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(301,400),5.42);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(401,600),8.51);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			if($newUnit>0)
			{
				$rep = calculate($newUnit,array(601,1000000),9.93);
				$newUnit = $rep[0];
				$total += $rep[1];
			}
			$meter = $_POST['meter'];
			$newTotal = $total + $meter;
			$vat = ($newTotal * 5)/100;
			$gTotal = $newTotal + $vat;
			echo "
				
			</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th></th>
					<th>Bill</th>
					<th>$total Rupees</th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th>Meter Charge</th>
					<th>$meter Rupees</th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th>Total</th>
					<th>$newTotal Rupees</th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th>Vat</th>
					<th>$vat Rupees</th>
				</tr>
				<tr>
					<th></th>
					<th></th>
					<th>G. Total</th>
					<th>$gTotal Rupees</th>
				</tr>
			</tfoot>
		</table>";
		}
		?>
	

	<footer>
		&copy; <?php echo date('Y'); ?> , <a href="http://saiful.im/">Saiful Islam</a>
	</footer>
	</div>	
	</body>
</html>