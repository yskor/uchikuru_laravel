<div class="row mt-3">
	<div class="col">
		<div id="category">
            <div class="d-flex section">
                    {{-- <div class="col-md-6"> --}}
                        {{-- <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="category-code">カテゴリ</label>
                            </div>
                            <form action="{{ route('master_list') }}" method="get">
                                @csrf
                                <select class="custom-select form-control form-select w-100" id="category-code">
                                    <option value="ALL">全て</option>
                                    @foreach($consumable_category as $data) --}}
                                    {{-- カテゴリごとに作成 --}}
                                    {{-- <option value="{{ $data->consumable_category_code }}">{{ $data->consumable_category_name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div> --}}
                        <!-- Button trigger modal -->
                            <label class="input-group-text" for="category_code">カテゴリ</label>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                選択
                            </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col">
                                        <a href="{{ route('master_list') }}">
                                            全て
                                        </a>
                                    </div>
                                    @foreach($consumable_category_all as $data)
                                    <div class="col">
                                        <a href="{{ route('master_list') }}/{{ $data->consumable_category_code }}">
                                            {{ $data->consumable_category_name }}
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button>
                                </div>
                            </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>