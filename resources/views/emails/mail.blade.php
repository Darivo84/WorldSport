<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<tr>
			<td>Full Name : </td>
			<td>{!! $name . ' ' . $surname !!}<td>
		</tr>
		<tr>
			<td>E-mail : </td>
			<td>{!! $email !!}</td>
		</tr>
		@if(isset($business))
			<tr>
				<td>Business : </td>
				<td>{{ $business }}</td>
			</tr>	
		@endif
		@if(isset($department))
			<tr>
				<td>Department : </td>
				<td>{{ $department }}</td>
			</tr>
		@endif
		<tr>
			<td>Message : </td>
			<td>{{ $messages }}</td>
		</tr>
	</table>
</body>
</html>