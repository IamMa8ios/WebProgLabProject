<div class="x_panel">
	<div class="x_title">
		<h2>Profile </h2>
		<div class="clearfix"></div>
	</div>
	<div class="x_content">
		<br/>
		<form class="form-label-left input_mask">
			
			<div class="col-md-6 col-sm-6  form-group has-feedback">
				<input type="text" class="form-control has-feedback-left" id="inputSuccess2"
					   placeholder="First Name">
				<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
			</div>
			
			<div class="col-md-6 col-sm-6  form-group has-feedback">
				<input type="text" class="form-control" id="inputSuccess3" placeholder="Last Name">
				<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
			</div>
			
			<div class="col-md-6 col-sm-6  form-group has-feedback">
				<input type="email" class="form-control has-feedback-left" id="inputSuccess4"
					   placeholder="Email">
				<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
			</div>
			
			<div class="col-md-6 col-sm-6  form-group has-feedback">
				<input type="tel" class="form-control" id="inputSuccess5" placeholder="Phone">
				<span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
			</div>
			<div class="form-group row">
				<label class="col-form-label col-md-3 col-sm-3 ">Date Of Birth</label>
				<div class="col-md-9 col-sm-9 ">
					<input class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" type="text"
						   onfocus="this.type='date'" onmouseover="this.type='date'"
						   onclick="this.type='date'" onblur="this.type='text'"
						   onmouseout="timeFunctionLong(this)">
					<script>
                        function timeFunctionLong(input) {
                            setTimeout(function () {
                                input.type = 'text';
                            }, 60000);
                        }
					</script>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group row">
				<div class="col-md-9 col-sm-9  offset-md-3">
					<button type="button" class="btn btn-primary">Cancel</button>
					<button class="btn btn-primary" type="reset">Reset</button>
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</div>
		
		</form>
	</div>
</div>