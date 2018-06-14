<?php
	include('./modules/dashboard/class.php');
	@session_start();
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-icon" data-background-color="green">
					<i class="material-icons">person</i>
				</div>
				<div class="card-content">
					<h4 class="card-title"><b></h4>
					<h4 class="card-title" style="float: left;"><b></h4>
					<div class="row">
						<div class="col-md-12">
							<?php echo DashBoard::get_all_orders(); ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#sample_1').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });


        var table = $('#datatables').DataTable();

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');

            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });

        $('.card .material-datatables label').addClass('form-group');
    });
</script>