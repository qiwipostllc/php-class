$(document).ready( function(){
	* ��������� ���������� �������, ������� ���������� ��� ����� �� ������� � ������� "qp_map", �.�. �� ����� ������ ��� ������ ��� ������ �����
	*/
	$( '.qp_map' ).bind( 'click', function(){

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
	$( '#'+$( '#qp_commentFieldId' ).val() ).bind( 'change', function(){

	/**
	* ����������� ����� ����������� � ����������� � ��������� ���������, ���� ����� �������� �������� �� ��������� ��� ������ �������� QiwiPost.
	*/
	qpExecEvents();
});

/**
* ��������� ����� ������� ���� �� radiobutton � ���� �� ����������� ������.
*/
function qpExecEvents()
{
	$( 'select.qp_select_select, select.qp_select_select_map' ).triggerHandler( 'change' );

/**
* ��������� � ���� � ������������ ���������� � ��������� ��������� QiwiPost
* ������ ��������� ����� �� �������� ���� #qp_mess_template
* ID ���� � ������������ ����� �� �������� ���� #qp_commentFieldId
*/
function qpAfterSelectTerminal( terminal, type, machine )
{
	var obj = $( '#'+$( '#qp_commentFieldId' ).val() );
	var res = reg.test( obj.val() );
	if ( !$( machine ).is( ':disabled' ) && ( type || !res ) )
	{
		{
			obj.val( obj.val().replace( /QiwiPost/, "" ) );
			obj.val( $( '#qp_mess_template' ).val().replace( /name/, "QiwiPost "+terminal )+'. '+obj.val() );
		}
		else
			obj.val( obj.val().replace( /(QiwiPost\s)([a-zA-Z]{3}\_\d+)(\D)/i, "$1"+terminal+"$3" ) );
	}

/**
* ���������� ��������� ����������� ������ (��� �������� � ������, ���� �������� ������ �� �����)
*/
function qpCheckSelectChange()
{


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
{
	var expr = new RegExp( $( '#qp_mess_template' ).val().replace( /name/, "QiwiPost\\s[a-zA-Z]{3}\\_\\d{3}\\D{0,1}" ) );
	obj.val( obj.val().replace( expr, "" ) );
}