<?php
$user_id = $this->session->userdata('user_id');
$user_role = $this->session->userdata('user_role');
if (empty($user_id) || empty($user_role)) {
    redirect('auth/index/login');
}
$user_name = $this->session->userdata('user_nama');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Aduan</title>


	<link rel="shortcut icon" href="<?php echo base_url('path/image/logo.png'); ?>"
		type="image/x-icon">

	<link rel="stylesheet" href="<?php echo base_url('path/dist/assets/compiled/css/app.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('path/dist/assets/compiled/css/app-dark.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('path/dist/assets/extensions/simple-datatables/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('path/dist/assets/compiled/css/table-datatable.css'); ?>">
</head>

<body>
	<script src="<?php echo base_url('path/dist/assets/static/js/initTheme.js'); ?>"></script>
