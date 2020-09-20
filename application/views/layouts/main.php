<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
	<title><?= $page->title; ?></title>
</head>
<style>
	ul.user-profile-list{
		list-style: none !important;
	}
	/** Bootstrap 5 Tooltip not triggered when hovering over child element
 will be fixed in Bootstrap 5 alpha 2. A workaround to set fas z-index */
	.fas {
		z-index: -1;
	}
</style>
<body class="d-flex flex-column h-100">

	<?= $header ?>

	<?php if($this->session->flashdata('db_status')): ?>
		<div class="div container mt-3">
			<div class="mt-3 alert alert-<?= $this->session->flashdata('db_status')->status ?> alert-dismissible fade show" role="alert">
				<i class="fa fa-<?= $this->session->flashdata('db_status')->icon ?>"></i> <?= $this->session->flashdata('db_status')->message ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>  <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>  <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/></svg></span>
				</button>
			</div>
		</div>
	<?php endif; ?>

	<?= $body ?>

	<?= $footer ?>

	<script src="https://kit.fontawesome.com/d4ddcae7a9.js" crossorigin="anonymous"></script>
	<!-- Popper.js first, then Bootstrap JS -->
	<script src="<?= base_url('js/popper.min.js') ?>" ></script>
	<!-- <script src="<?= base_url('js/bootstrap.min.js') ?>"></script> -->
	<script>
		/**Enabling bootstrap 5 tooltip everwhere */
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
			return new bootstrap.Tooltip(tooltipTriggerEl)
		})
		/** */
	</script>
</body>
</html>