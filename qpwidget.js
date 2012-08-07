$(document).ready( function(){	/**
	* Назначаем обработчик события, которое происходит при клике по объекту с классом "qp_map", т.е. по любой кнопке или ссылке для вызова карты
	*/
	$( '.qp_map' ).bind( 'click', function(){		window.open( 'http://qiwipost.ru/widget/geo.php?remote_host=' + escape(document.URL) + '&dropdown_name=machine&dropdown_class=class&field_to_update=address&user_function=','EasyPack','height=640,width=1000,toolbar=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no' );	});

	/**
	* Назначаем обработчик события, которое происходит при клике по radiobutton (в раскрытом списке терминалов)
	*/
	$( 'input.qp_radio_select:radio' ).bind( 'click', function(){
		if ( $( this ).is( ':checked' ) )
			qpAfterSelectTerminal( $( this ).val(), 1, this );
	});

	/**
	* Назначаем обработчик события, которое происходит при выборе терминала из выпадающего списка
	*/
	$( 'select.qp_select_select, select.qp_select_select_map' ).bind( 'change', function(){
		qpAfterSelectTerminal( $( this ).val(), 1, this );
	});

	/**
	* Запускаем мониторинг. Если мы выбираем терминал на карте, то параметры выбранного терминала записываются в хеш адресной строки и затем распарсиваются методом checkHash() - польский скрипт qiwipost.ru/widget/dropdown.php. Этот метод делает выбранным нужный пункт в выпадающем списке. Мы отслеживаем изменения в выпадающем списке и подставляем нужное значение в комментарий.
	*/
	if ( $( 'select.qp_select_select_map' ).get().length > 0 )
		window.setInterval( "qpCheckSelectChange();", 300 );

	/**
	* При изменении комментария пользователем вручную мы отслеживаем, чтобы он не затер информацию о выбранном терминале. Поэтому назначется обработчик события, которое происходит при изменении текста комментария.
	*/
	$( '#'+$( '#qp_commentFieldId' ).val() ).bind( 'change', function(){		qpExecEvents();	} );

	/**
	* Проставляем текст комментария с информацией о выбранном терминале, если после загрузки страницы по умолчанию уже выбран терминал QiwiPost.
	*/
	qpExecEvents();
});

/**
* Имитируем вызов событий клик по radiobutton и клик по выпадающему списку.
*/
function qpExecEvents()
{	$( 'input.qp_radio_select:radio:checked' ).triggerHandler( 'click' );
	$( 'select.qp_select_select, select.qp_select_select_map' ).triggerHandler( 'change' );}

/**
* Вставляет в поле с комментарием информацию о выбранном терминале QiwiPost
* Шаблон сообщения берем из скрытого поля #qp_mess_template
* ID поля с комментарием берем из скрытого поля #qp_commentFieldId
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
* Мониторинг изменения выпадающего списка (для варианта с картой, если терминал выбран на карте)
*/
function qpCheckSelectChange()
{	qpAfterSelectTerminal( $( 'select.qp_select_select_map' ).val(), 1, 'select.qp_select_select_map' );}


/**
* Делает активными или неактивными элементы выбора терминалов QiwiPost на форме. action=1 - сделать активными, action=0 - дезактивировать
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
* Удаляет стандартное сообщение о выбранном терминале QiwiPost из поля с комментарием
*/
function qpDelQiwiPostInfo()
{	var obj = $( '#'+$( '#qp_commentFieldId' ).val() );
	var expr = new RegExp( $( '#qp_mess_template' ).val().replace( /name/, "QiwiPost\\s[a-zA-Z]{3}\\_\\d{3}\\D{0,1}" ) );
	obj.val( obj.val().replace( expr, "" ) );
}