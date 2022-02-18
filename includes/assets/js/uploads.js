
var inputs = document.querySelectorAll( '.nfInputPu' );
Array.prototype.forEach.call( inputs, function( input )
{
	var label	 = input.nextElementSibling,
		labelVal = label.innerHTML,
		newSpan = document.createElement('span');

	input.addEventListener( 'change', function( e )
	{
		var fileName = '';
		if( this.files && this.files.length > 1 )
			fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
		else
			fileName = e.target.value.split( '\\' ).pop();

		if( fileName ){
			label.innerHTML = "";
			label.appendChild(newSpan);
			label.querySelector('span').innerHTML = fileName;
		}else{
		label.innerHTML = labelVal;}
	});
});