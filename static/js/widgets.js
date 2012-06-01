var widgets={
work_form:'\
<div class="modal fade">\
  <form id="add-work-form" class="form-horizontal well" action="#">\
    <header class="modal-header">\
      <h4> 创建新工作 </h4>\
    </header>\
    <div class="modal-body clear">\
      <label for="name" class="label"> 工作名称 </label>\
      <input type="text" class="span6" name="name" placeholder="周一丙班经理"/>\
      <label for="num" class="label"> 工作人数 </label>\
      <input type="text" class="span6" name="num" placeholder="1"/>\
      <label for="desp" class="label"> 工作描述 </label>\
      <textarea name="desp" class="span6" placeholder="经理班"/>\
    </div>\
    <footer class="modal-footer">\
      <button id="cancel" class="btn btn-inverse pull-right"> 取消 </button>\
      <button id="submit" class="btn btn-success pull-right"> 提交 </button>\
    </footer>\
  </form>\
</div>\
',

upload_form:'\
<div class="modal fade">\
  <form id="upload-img-form" class="form-horizontal well" action="#">\
    <header class="modal-header">\
      <h4> 上传头像 </h4>\
    </header>\
    <div class="modal-body clear">\
      <div class="span4 row offset1">\
        <a href="#" class="thumbnail">\
          <img id="photo-preview" src="{{photo}}"/>\
        </a>\
      </div>\
      <br/>\
      <div class="row">\
	<span class="label">上传一张照片(仅支持jpg)</span>\
	<input id="file-upload" type="file" name="avatar-file"/>\
      </div>\
    </div>\
    <footer class="modal-footer">\
      <button id="cancel" class="btn btn-inverse pull-right"> 取消 </button>\
      <button id="upload-submit" class="btn btn-success pull-right"> 提交 </button>\
    </footer>\
  </form>\
</div>\
'

};
