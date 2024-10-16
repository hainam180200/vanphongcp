@if(isset($data))
    {{Form::open(array('route'=>array('admin.role.update',$data->id),'method'=>'PUT','enctype'=>"multipart/form-data" , 'files' => true))}}
@else
    {{Form::open(array('route'=>array('admin.role.store'),'method'=>'POST','enctype'=>"multipart/form-data"))}}
@endif

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">
        @if(isset($data))
            Chỉnh sửa
        @else
            Thêm mới
        @endif
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i aria-hidden="true" class="ki ki-close"></i>
    </button>
</div>
<div class="modal-body">




    {{-----parent_id------}}
    <div class="form-group row">
        <label  class="col-12">{{ __('Danh mục cha') }}</label>
        <div class="col-12">

            <select name="parent_id" class="form-control select2 col-md-5" id="kt_select2_2"  style="width: 100%"  >

                @if( !empty(old('parent_id')) )
                    {!!\App\Library\Helpers::buildMenuDropdownList($dataCategory,old('parent_id')) !!}
                @else
                    <?php $itSelect = [] ?>

                    @if(isset($data))
                        <?php array_push($itSelect, $data->parent_id);?>
                    @endif
                    {!!\App\Library\Helpers::buildMenuDropdownList($dataCategory,$itSelect) !!}
                @endif
            </select>

            @if($errors->has('parent_id'))
                <div class="form-control-feedback">{{ $errors->first('parent_id') }}</div>
            @endif
        </div>
    </div>






    {{-- title --}}
    <div class="form-group {{ $errors->has('title')? 'has-danger':'' }}">
        <label class="form-control-label">{{__('Tiêu đề')}}</label>
        <input type="text" class="form-control" name="title"
               value="{{old('title', isset($data) ? $data->title : null)}}" autofocus="true">
        @if($errors->has('title'))
            <div class="form-control-feedback">{{ $errors->first('title') }}</div>
        @endif
    </div>
    {{-- name --}}
    <div class="form-group {{ $errors->has('name')? 'has-danger':'' }}">
        <label class="form-control-label">{{__('Name')}}</label>
        <input type="text" class="form-control" name="name" value="{{old('name', isset($data) ? $data->name : null)}}">
        @if($errors->has('name'))
            <div class="form-control-feedback">{{ $errors->first('name') }}</div>
        @endif
    </div>

    @if(isset($data))
        <div class="text-center">{{__("Chú ý: bạn đang chỉnh sửa vai trò:")}} <span class="text-danger">{{old('title', isset($data) ? $data->title : null)}}</span> </div>
    @endif

    <div class="mt-10 mb-10">
        <a href="#" id="btnToggleTree" class="btn btn-info m-btn" data-open="1">Thu gọn</a>
        <a href="#" id="btnSelectAll" class="btn btn-info m-btn">Chọn tất cả</a>
        <a href="#" id="btnDeselectAll" class="btn btn-danger m-btn">Bỏ tất cả</a>

    </div>


    <div id="kt_tree_3" class="tree-demo">
    </div>

    <input type="hidden" id="permission_ids" name="permission_ids" value="{{implode (",",old('permission_ids', isset($permissionsSelected) ? $permissionsSelected : []) )}}">



    <style>
        a[aria-level="1"] {
            font-weight: bold;
        }
    </style>
    <script>

        // var jsondata = [
        //
        //
        //     {"id":"15","parent":"#","text": "Child 1"},
        //     { "id": "ajson3", "parent": "ajson3", "text": "Child 1"},
        //     { "id": "ajson4", "parent": "ajson2", "text": "Child 2"},
        // ];

        var jsondata={!! $permissionsJson !!};
        // var jsondata=[{"id":"15","parent":"13","text":"Ch\u1ec9nh s\u1eeda ng\u00f4n ng\u1eef"},{"id":"19","parent":"0","text":"Qu\u1ea3n l\u00fd t\u00e0i kho\u1ea3n"},{"id":"13","parent":"18","text":"Ng\u00f4n ng\u1eef"},{"id":"16","parent":"13","text":"X\u00f3a ng\u00f4n ng\u1eef"},{"id":"18","parent":"0","text":"H\u1ec7 th\u1ed1ng"}];

        $('#kt_tree_3').jstree({
            "plugins": ["wholerow", "checkbox", "types","search"],
            "core": {
                "dblclick_toggle" : false,
                "themes": {
                    "responsive": false,
                    "icons":false,
                    "dots": true,
                },
                "data": jsondata
            },

            "types": {
                "default": {
                    "icon": "fa fa-folder text-warning"
                },
                "file": {
                    "icon": "fa fa-file  text-warning"
                }
            },

        }).bind("loaded.jstree", function (e, data) {
            var perSelected=$('#permission_ids').val();

            var arrPer = perSelected.split(",");
            $.each(arrPer, function( index, value ) {

                $('#kt_tree_3').jstree("select_node", value, true);
            });


        })
        .on('changed.jstree', function (e, data) {

            var i, j, r = [];
            for(i = 0, j = data.selected.length; i < j; i++) {

                r.push(data.instance.get_node(data.selected[i]).id);
            }
            $('#permission_ids').val(r.join(','));
        });

        $( "#btnDeselectAll").click(function(e) {
            e.preventDefault();
            $("#kt_tree_3").jstree().deselect_all(true);
            $("#permission_ids").val('');
        });

        $( "#btnDeselectAll").click(function(e) {
            e.preventDefault();
            $("#kt_tree_3").jstree().uncheck_all(true);
        });

        $( "#btnSelectAll").click(function(e) {
            e.preventDefault();
            $("#kt_tree_3").jstree().check_all(true);
        });
        $( "#btnToggleTree").click(function(e) {
            var isOpen=$(this).data('open');

            if(isOpen){

                $("#kt_tree_3").jstree('close_all');
                $(this).data('open',0);
                $(this).text('{{__('Mở rộng')}}');
            }
            else{
                $("#kt_tree_3").jstree('open_all');
                $(this).data('open',1);
                $(this).text('{{__('Thu gọn')}}');
            }


        });




    </script>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Hủy')}}</button>
    <button type="submit" class="btn btn-success m-btn m-btn--custom m-btn--icon">
        @if(isset($data))
            {{__(' Chỉnh sửa')}}
        @else
            {{__(' Thêm mới')}}
        @endif
    </button>
</div>
{{ Form::close() }}


