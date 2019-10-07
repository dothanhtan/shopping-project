<?php include_once("header.php") ?>    
<?php include_once("nav.php") ?>
<?php 
    include_once("model/history.php");
    
    $ls = History::getList();
?>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form>
			<div class="form-group ">
			<label for="from">Từ năm</label>
			<input type="number" class="form-control" id="from" placeholder="Từ năm">
			</div>
			<div class="form-group">
			<label for="to">Đến năm</label>
			<input type="number" class="form-control" id="to" placeholder="Đến năm">
			</div>
			<div class="form-group">
			<label for="class">Lớp</label>
			<input type="text" class="form-control" id="class" placeholder="Lớp">
			</div>
			<div class="form-group">
			<label for="place">Nơi học</label>
			<input type="text" class="form-control" id="place" placeholder="Nơi học">
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btn-create" type="button" class="btn btn-primary">Create</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form>
			<div class="form-group ">
			<label for="from">Từ năm</label>
			<input type="number" class="form-control" id="from" placeholder="Từ năm">
			</div>
			<div class="form-group">
			<label for="to">Đến năm</label>
			<input type="number" class="form-control" id="to" placeholder="Đến năm">
			</div>
			<div class="form-group">
			<label for="class">Lớp</label>
			<input type="text" class="form-control" id="class" placeholder="Lớp">
			</div>
			<div class="form-group">
			<label for="place">Nơi học</label>
			<input type="text" class="form-control" id="place" placeholder="Nơi học">
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btn-edit" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<div class="btn-add d-flex justify-content-end align-items-center pb-3">
				<button class="btn btn-outline-primary" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus-circle"></i> Thêm</button>
			</div>
			<thead class="thead-dark">
				<tr>
					<th scope="col">STT</th>
					<th scope="col">Từ năm</th>
					<th scope="col">Đến năm</th>
					<th scope="col">Lớp</th>
					<th scope="col">Nơi học</th>
					<th scope="col">Thao tác</th>
				</tr>
			</thead>
			<tbody>
			<?php for($i = 0; $i < count($ls); $i++) { ?>
				<tr>
					<th scope="row"><?php echo $i + 1 ?></th>
					<td><?php echo $ls[$i]->fromYear ?></td>
					<td><?php echo $ls[$i]->toYear ?></td>
					<td><?php echo $ls[$i]->class ?></td>
					<td><?php echo $ls[$i]->place ?></td>
					<td class="d-flex">
						<button class="btn btn-outline-info mr-3" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i> Sửa</button>
						<button class="btn-delete btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Xóa</button>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php include_once("footer.php") ?> 

<script>
	$(document).ready(function(){
		$(document).on("click", ".btn-delete", function(){
			$.confirm({
			title: 'Confirm!',
			content: 'Are you sure to delete this item?',
			buttons: {
				YES: function () {
					
				},
				NO: function () {
					
				}
			},
			theme: "supervan"
			});
		})
		
	})
</script>