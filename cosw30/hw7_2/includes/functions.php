function inputElement($label,$type='text',$name,$size,$value) {
    $element = "
    <div class="form-row py-2">
		<label for=$name class="form-label">$label</label>
		<input type=$type name=$name size=$size class="form-control"
				value=$value>
	</div>
    ";
    echo $element;
}

function buttonElement($btnid,$btnclass,$name,$attr,$btntext) {
    $button = "
        <button type="submit" class=$btnclass id=$btnid name=$name attr=$attr>$btntext</button>
    ";
    echo $button;
}