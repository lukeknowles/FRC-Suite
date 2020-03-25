

<?php
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>FRC Suite Creator</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<style>
			html,body {
			margin: 0;
			height: 100%;
			}
			.no-gutters {
			margin-right: 0;
			margin-left: 0;
			> .col,
			> [class*="col-"] {
			padding-right: 0;
			padding-left: 0;
			}
			}
			#workspace {
			background-color:#06c;
			background-image: linear-gradient(rgba(255,255,255,0.2) 2px, transparent 2px),
			linear-gradient(90deg, rgba(255,255,255,0.2) 2px, transparent 1px),
			linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px),
			linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px);
			background-size:100px 100px, 100px 100px, 20px 20px, 20px 20px;
			background-position:-2px -2px, -2px -2px, -1px -1px, -1px -1px;
			}

			.user-added-control>div>div>input:hover {
			}

			.user-added-control .form-row {
				background-color: transparent;
				transition: 0.3s;
			}

			.user-added-control:hover * {
				cursor: pointer !important;
			}

			.user-added-control:hover .form-row {
				background-color: rgba(3, 140, 252, 0.75);
			}

			.user-added-control:hover .form-group {
				opacity: 0.25;
			}

			.user-added-control .form-group {
				opacity: 1;
				transition: 0.3s;
			}
		</style>
	</head>
	<body>
		<div class="row h-100 no-gutters">
			<div class="col-3 h-100 bg-dark">
				<div class="container-fluid" style="padding: 0;">
					<table class="table table-dark table-bordered text-center">
						<tbody>
							<tr>
								<th class="align-middle lead">Metric Label</th>
								<td class="align-middle">
									<input type="text" class="w-75">
								</td>
							</tr>
							<tr>
								<th class="align-middle lead">Input Type</th>
								<td class="align-middle">
									<select class="custom-select w-75">
										<option value="text" selected>Text</option>
										<option value="longtext">Long Text</option>
										<option value="bool">Boolean Switch</option>
										<option value="int">Integer</option>
										<option value="int">Dropdown</option>
									</select>
								</td>
							</tr>

							<tr>
								<th class="align-middle lead">Metric ID</th>
								<td class="align-middle">
									<input type="text" class="w-75">
								</td>
							</tr>

							<tr>
								<th class="align-middle lead">Position</th>
								<td class="align-middle">
									<div class="btn-group">
										<button type="button" class="btn btn-info"><i class="fa fa-chevron-up"></i></button>
										<button type="button" class="btn btn-info"><i class="fa fa-chevron-down"></i></button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="col-9 h-100 d-flex" id="workspace">
				<div class="container d-flex align-self-center justify-content-center" id="workspace-inner">   
					<div class="card w-50" style="max-height: 75vh; overflow-y:auto;">
						<h5 class="card-header info-color white-text text-center">
						</h5>
						<div class="card-text p-3">
							<form class="text-center" id="newForm">
								<div class="form-row">
									<div class="form-group col">
										<input type="text" class="form-control" placeholder="Team #" disabled>
									</div>
									<div class="form-group col">
										<input type="text" class="form-control" placeholder="Match #" disabled>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col mb-0">
										<button type="button" class="btn btn-lg btn-outline-success" style="border-radius: 25px;" id="add-control-button">+</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="add-control-modal" tabindex="-1" role="dialog" aria-labelledby="add-control-modal-title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="add-control-modal-title">Add Control</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
                            <div class="col-3">

                            </div>

                            <div class="col-9">
                                
                            </div>
                        </div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Add</button>
					</div>
				</div>
			</div>
		</div>
    </body>
    
    <script>
		var control_counter = 2;
		var controls = [
			{
				id: "team_number",
				data: {
					type: "text"
				},
				placeholder: "Team #",
				label: null,
				jquery_reference: null
			},
			{
				id: "match_number",
				data: {
					type: "number",
					min: 0,
					max: 200
				},
				placeholder: "Match #",
				label: null,
				jquery_reference: null
			}
		];
        $("#add-control-button").on("click", function() {
            //$("#add-control-modal").modal("show");
			control_counter += 1;
			let control_id = "user-added-control-" + (control_counter);
			let new_control =
			$("<div>", {class:"user-added-control", 'data-control-id': control_id}).append(
				$("<div>", {class:"form-row"}).append(
					$("<div>", {class:"form-group col"}).append(
						$("<label class='lead font-weight-normal'>Input Label</label>").css({"float": "left", "word-break": "break-all"}),
						$("<input>", {class:"form-control", type:"text", disabled:true})
					)
				)
			).insertBefore($("#newForm > div:last"));

			console.log(new_control);
        });
    </script>
</html>

