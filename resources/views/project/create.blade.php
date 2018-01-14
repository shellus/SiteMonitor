    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ \Route::currentRouteName() == "project.edit"?"编辑":"新增" }}项目</h4>
    </div>
    <div class="modal-body">
        <form id="project-create-form" method="post" action="{{ route('project.store') }}">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $project->id }}">
        <div class="form-group">
            <label for="exampleInputEmail1">项目名称</label>
            <input name="title" class="form-control" id="exampleInputEmail1" value="{{ $project->title }}">
        </div>
        </form>
    </div>
    <div class="modal-footer">
        <button form="project-create-form" class="btn btn-primary">提交</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
    </div>