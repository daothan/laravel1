
<!-- Modal Add Cate-->

<div id="addcateModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="content modal_background">
            <div class="panel-title">
                <h3 class="modal_header" align="center">Add Category</h3>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-horizontal" role="form"  id="validate_add_cate">

					<div class="form-group">
						<label class="col-md-4 control-label">Category Parent</label>
						<div class="col-md-6">
							<select name="add_parent" id="add_parent" class="form-control" autofocus >
								<option disabled selected hidden>Please Choose Catgeory...</option>
								<option value="0" class="{{Auth::user()->level==1 ? 'hidden':''}}">Parent Category</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Category Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="add_name" name="add_name" placeholder="Please Enter Category Name">
							<div class="has-error"><i><span class="help-block errorName_add"></span></i></div>
						</div>

					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Category keywords</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="add_keywords" name="add_keywords" placeholder="Please Enter Category Keywords" value="{{old('keywords')}}">
							<div class="has-error"><i><span class="help-block errorKeyword_add"></span></i></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Category Description</label>
						<div class="col-md-6">
							<textarea class="form-control" name="add_description" id="add_description" rows="3" placeholder="Please enter description">{{old('description')}}</textarea>
							<div class="has-error"><i><span class="help-block errorDescription_add"></span></i></div>
						</div>
					</div>
                    <!-- Submit -->
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn_admin primary">Submit</button>
                            <button class="btn_admin warning" type="reset" >Reset</button>
                			<button type="button" class="btn_admin danger pull-right" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- message add success -->

<div id="add_cate_success" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
	    <div class="modal-content">
		    <div class="modal-body">
		        <h3 align="center" style="color:green;">Category has added successfully !</h3>
		    </div>
	    </div>
	</div>
</div>

