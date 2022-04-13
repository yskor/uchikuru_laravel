<!-- Modal -->
<div class="modal fade" id="modal-buy-{{$facility->office_code}}-{{$consumables->consumables_code}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modal-buy-{{$facility->office_code}}-{{$consumables->consumables_code}}-Label">仕入れ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="data" style="">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>事業所</th>
                            <td>{{$facility->facility_name}}</td>
                        </tr>
                        <tr>
                            <th>消耗品</th>
                            <td>{{$consumables->consumables_name}}</td>
                        </tr>
                    </tbody>
                </table>
                <img src="{{asset('upload/consumables/'.$consumables->image_file_extension)}}" width="100px">
                <script>
                    $(function() {
                        var parent = $( "#data" );
                    });
                </script>
            </div>
            <div class="form-group" id="buy-number-form-group">
                <label for="buy-number">仕入れ数 <span class="badge bg-danger">必須</span> </label>
                <select id="buy-number" class="form-select">
                    @foreach (range(1, 100) as $i)
                        <option value="{{$i}}">{{$i}}</option>
                    @endforeach
                </select>
                <div id="buy-number-feedback" class="invalid-feedback"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="btn-close" data-bs-dismiss="modal">閉じる</button>
            <button type="button" class="btn btn-primary" id="btn-do"><svg
                    class="svg-inline--fa fa-plus fa-w-14 fa-fw" aria-hidden="true" focusable="false"
                    data-prefix="fas" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512" data-fa-i2svg="">
                    <path fill="currentColor"
                        d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                    </path>
                </svg><!-- <i class="fas fa-plus fa-fw"></i> Font Awesome fontawesome.com -->仕入れ</button>
        </div>
    </div>
    </div>
</div>