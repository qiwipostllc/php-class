$(document).ready( function(){	/**
	* ��������� ���������� �������, ������� ���������� ��� ����� �� ������� � ������� "qp_map", �.�. �� ����� ������ ��� ������ ��� ������ �����
	*/
	$( '.qp_map' ).bind( 'click', function(){		window.open( 'http://qiwipost.ru/widget/geo.php?remote_host=' + escape(document.URL) + '&dropdown_name=machine&dropdown_class=class&field_to_update=address&user_function=','EasyPack','height=640,width=1000,toolbar=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no' );	});

	/**
	* ��������� ���������� �������, ������� ���������� ��� ����� �� radiobutton (� ��������� ������ ����������)
	*/
	$( 'input.qp_radio_select:radio' ).bind( 'click', function(){
		if ( $( this ).is( ':checked' ) )
			qpAfterSelectTerminal( $( this ).val(), 1, this );
	});

	/**
	* ��������� ���������� �������, ������� ���������� ��� ������ ��������� �� ����������� ������
	*/
	$( 'select.qp_select_select, select.qp_select_select_map' ).bind( 'change', function(){
		qpAfterSelectTerminal( $( this ).val(), 1, this );
	});

	/**
	* ��������� ����������. ���� �� �������� �������� �� �����, �� ��������� ���������� ��������� ������������ � ��� �������� ������ � ����� �������������� ������� checkHash() - �������� ������ qiwipost.ru/widget/dropdown.php. ���� ����� ������ ��������� ������ ����� � ���������� ������. �� ����������� ��������� � ���������� ������ � ����������� ������ �������� � �����������.
	*/
	if ( $( 'select.qp_select_select_map' ).get().length > 0 )
		window.setInterval( "qpCheckSelectChange();", 300 );

	/**
	* ��� ��������� ����������� ������������� ������� �� �����������, ����� �� �� ����� ���������� � ��������� ���������. ������� ���������� ���������� �������, ������� ���������� ��� ��������� ������ �����������.
	*/
	$( '#'+$( '#qp_commentFieldId' ).val() ).bind( 'change', function(){		qpExecEvents();	} );

	/**
	* ����������� ����� ����������� � ����������� � ��������� ���������, ���� ����� �������� �������� �� ��������� ��� ������ �������� QiwiPost.
	*/
	qpExecEvents();
});

/**
* ��������� ����� ������� ���� �� radiobutton � ���� �� ����������� ������.
*/
function qpExecEvents()
{	$( 'input.qp_radio_select:radio:checked' ).triggerHandler( 'click' );
	$( 'select.qp_select_select, select.qp_select_select_map' ).triggerHandler( 'change' );}

/**
* ��������� � ���� � ������������ ���������� � ��������� ��������� QiwiPost
* ������ ��������� ����� �� �������� ���� #qp_mess_template
* ID ���� � ������������ ����� �� �������� ���� #qp_commentFieldId
*/
function qpAfterSelectTerminal( terminal, type, machine )
{	var reg = /QiwiPost\s([a-zA-Z]{3})\_\d{3}\D*/i;
	var obj = $( '#'+$( '#qp_commentFieldId' ).val() );
	var res = reg.test( obj.val() );
	if ( !$( machine ).is( ':disabled' ) && ( type || !res ) )
	{		if ( !res )
		{			var expr = new RegExp( $( '#qp_mess_template' ).val().replace( /name/, "" ) );			obj.val( obj.val().replace( expr, "" ) );
			obj.val( obj.val().replace( /QiwiPost/, "" ) );
			obj.val( $( '#qp_mess_template' ).val().replace( /name/, "QiwiPost "+terminal )+'. '+obj.val() );
		}
		else
			obj.val( obj.val().replace( /(QiwiPost\s)([a-zA-Z]{3}\_\d+)(\D)/i, "$1"+terminal+"$3" ) );
	}}

/**
* ���������� ��������� ����������� ������ (��� �������� � ������, ���� �������� ������ �� �����)
*/
function qpCheckSelectChange()
{	qpAfterSelectTerminal( $( 'select.qp_select_select_map' ).val(), 1, 'select.qp_select_select_map' );}


/**
* ������ ��������� ��� ����������� �������� ������ ���������� QiwiPost �� �����. action=1 - ������� ���������, action=0 - ���������������
*/
function qpChangeStatus( action )
{
	var objs = $( 'input.qp_radio_select:radio, select.qp_select_select, select.qp_select_select_map, .qp_map' );
	if ( action == 1 )
	{
		objs.removeAttr( 'disabled' );
		qpExecEvents();
	}
	else
		objs.attr( 'disabled', 'disabled' );
	return 1;
}

/**
* ������� ����������� ��������� � ��������� ��������� QiwiPost �� ���� � ������������
*/
function qpDelQiwiPostInfo()
{	var obj = $( '#'+$( '#qp_commentFieldId' ).val() );
	var expr = new RegExp( $( '#qp_mess_template' ).val().replace( /name/, "QiwiPost\\s[a-zA-Z]{3}\\_\\d{3}\\D{0,1}" ) );
	obj.val( obj.val().replace( expr, "" ) );
}