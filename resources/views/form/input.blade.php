<div class="form-group" id="{{ $id }}-form-group">
	<label for="{{ $id }}">{{ $label }} @if($required == true) <span class="badge bg-danger">必須</span>@endif
	</label>
	<!--  スマホで数値を入力する場合は、セレクトボックスで選択する -->
	<select id="{{ $id }}" class="form-select"></select>
	<input type="{{ $type }}" class="form-control" id="{{ $id }}">
	<div id="{{ $id }}-feedback" class="invalid-feedback"></div>
</div>

<script>

$(function() {
	
	for( var i = 1; i <= 100; i++ ) {
		$( "#<%$id}}" ).append( $( "<option>" ).html( i ).val( i ) );
	}
	
});

</script>