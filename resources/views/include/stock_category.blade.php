<div class="row section">
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<label class="input-group-text" for="office-code">事業所</label>
				</div>
				<select class="custom-select form-control form-select w-50" id="office-code">
										<option value="1">ほのか</option>
										<option value="2">高岡</option>
										<option value="3">新庄</option>
										<option value="4">円光寺</option>
										<option value="5">福久</option>
										<option value="6">大友</option>
										<option value="7">ハマナス</option>
										<option value="99">事業所全体</option>
										<option value="8">有沢</option>
										<option value="9">砺波</option>
										<option value="50">金沢苑1F</option>
										<option value="10">黒部</option>
										<option value="55">ケアマネ</option>
										<option value="90">ケアマネ</option>
										<option value="90">ケアマネ</option>
										<option value="11">北代</option>
										<option value="51">金沢苑2F</option>
										<option value="12">玉鉾</option>
										<option value="13">魚津</option>
										<option value="70">看護業務</option>
										<option value="80">ケアマネ</option>
										<option value="14">白山</option>
										<option value="75">あいう薬局</option>
										<option value="92">就労（金沢）</option>
										<option value="93">就労B型（金沢）</option>
										<option value="94">ライフ</option>
										<option value="15">城川原</option>
										<option value="95">就労（富山）</option>
										<option value="96">就労B型（富山）</option>
										<option value="96">施設支援（アシスト）</option>
										<option value="100">管理（富山）</option>
										<option value="101">管理（石川）</option>
										<option value="16">秋吉</option>
										<option value="91" selected="">アシスト</option>
										<option value="90">LABO</option>
									</select>
			</div>
		</div>
	</div>
</div>

<div class="row section">
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
</div>