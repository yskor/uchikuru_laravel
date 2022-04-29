<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
    削除する
</button>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">以下の消耗品を削除しますか？</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h6>{{$consumables->consumables_name}}</h6>
                <img src="{{ asset('upload/consumables/'. $consumables->image_file_extension)}}"
                    style="width:100px;height:100px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                <input type="submit" class="btn btn-danger mx-3" name="post" value="削除する">
            </div>
        </div>
    </div>
</div>