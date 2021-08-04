<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form class="form-horizontal" method="POST" action="record.php" name="frmdept" onSubmit="return validateform()">
        scan result  :<input type="text" class="form-control" name="scan_result"  required />
        	<br>
        place id  :<input type="text" class="form-control" name="place_id" required />
        	<br>
        status  :<input type="text" class="form-control" name="status_data" value="0" required />
        	<br>
         <button type="submit" name="loginbtn" id="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
	  </form>
</body>
</html>