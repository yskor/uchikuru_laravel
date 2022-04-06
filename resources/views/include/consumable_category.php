<div class="row mt-3">
	<div class="col">
		<div id="category">
            <div class="row section">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="category-code">カテゴリ</label>
                            </div>
                            <form action="{{ route('master_list') }}" method="post">
                                <select class="custom-select form-control form-select w-100" id="category-code">
                                    <option value="ALL">全て</option>
                                    <option value="SGGD">衛生用品</option>
                                    <option value="SGOC">衛生用品（口腔）</option>
                                    <option value="SGKT">衛生用品（厨房）</option>
                                    <option value="SGCL">衛生用品（清掃）</option>
                                    <option value="SGSO">衛生用品（洗剤）</option>
                                    <option value="CARE">介護用品</option>
                                    <option value="OFSP">事務用品</option>
                                    <option value="FOOD">食品</option>
                                    <option value="LBCS">LABO消耗品</option>
                                    <option value="LBSS">LABO調味料</option>
                                    <option value="OTHR">その他</option>
                                    <option value="TEST">テスト</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>