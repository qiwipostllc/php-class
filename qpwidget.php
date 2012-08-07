<?php
/**
* Виджет для вставки формы выбора почтового терминала QiwiPost на свой сайт
* @author Zoya Schegolihina zschegolihina (at) qiwipost (dot) ru
*
*/
class QPWidget
{	/** номер телефона для авторизации */	private $phone 			= '';
	/** пароль для авторизации */
	private $passwd		 	= '';
	/** ИД поля с комментарием */
	private $commentFieldId	= '';
	/** адрес API */
	private $url			= 'http://api.qiwipost.ru/?';
	/** адрес тестового API */
	private $test_url		= 'http://apitest.qiwipost.ru/?';
	/** Город */
	private $town			= 'Москва';
	/** Название поля для выбора терминала */
	private $fieldName		= 'machine';
	/** стоимость услуги */
	private $price			= 0;
	/** объект с данными о доступных терминалах */
	private $data			= null;
	/** относительный путь к папке с файлами */
	private $folder			= '';
	/** Текст сообщения, которое вставляется автоматически в поле с комментарием после выбора терминала QiwiPost */
	private $mess_template	= 'Выбран терминал оплаты name';
	/** 1 - необходимо подключить jquery, 0 - не нужно подгружать jquery */
	private $jquery			= 1;
	/** Кодировка */
	private $encode			= 'utf-8';

	/**
	* Инициализация объекта
	* @param $phone     		number     	Номер телефона для авторизации
	* @param $passwd        	string     	пароль для авторизации
	* @param $price     		string     	Стоимость услуги, например, '100 руб.'
	* @param $test     			bool		1 - если тестовый доступ (в этом случае номер телефона и пароль могут быть пустые), 0 - если реальный доступ
	* @param $folder     		string		относительный путь к папке с файлом qpwidget.js
	* @param $mess_template     string		Текст сообщения, которое вставляется автоматически в поле с комментарием после выбора терминала QiwiPost. Например: "Выбран терминал оплаты name", где "name" - будет заменено автоматически на ID терминала. Внимание! Если в шаблоне сообщения не будет указан параметр "name", то автоматически будет использован заданный по умолчанию шаблон.
	* @param $jquery     		bool     	1 - необходимо подключить jquery, 0 - не нужно подгружать jquery, т.к. он уже загружен на странице. Внимание! jquery необходим в любом случае, т.к. на нем работает подгружаемый js-скрипт!
	* @param $encode     		string     	Кодировка, в которой будут загружены данные о терминалах через api QiwiPost
	*/
	public function QPWidget( $phone, $passwd, $price, $test=false, $folder='', $mess_template='', $jquery=1, $encode='utf-8' )
	{		$this->phone 			= $test ? '9876543210' : $phone;
		$this->passwd 			= $test ? 'test' : $passwd;
		$this->url	 			= $this->url; //$test ? $this->test_url : $this->url
		$this->price 			= $price;
		$this->objectClass 		= $objectClass;
		$this->folder 			= $folder;
		$this->jquery 			= in_array( $jquery, array(0, 1) ) ? $jquery : 1 ;

		if ( !empty( $encode ) )
			$this->encode 		= $encode;

		if ( !empty( $mess_template ) && preg_match( "/\@name/", $mess_template ) )
			$this->mess_template = $mess_template;

		$this->data = self::parse( self::query() );	}

    /**
	* Отправка запроса на получение xml с данными о доступных терминалах
	*/
	private function query()
	{		$data = 'telephonenumber='.$this->phone.'&password='.$this->passwd;

		$ch = curl_init( $this->url.'do=listmachines_xml' );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 0 );
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

		return curl_exec( $ch );	}

	/**
	* Парсер xml с данными о доступных терминалах в объект с данными
	* @param $xml     		string     	xml для разбора
	*/
	private function parse( $xml )
	{		return simplexml_load_string( $xml );	}

	/**
	* Выдает html-код выпадающего списка с доступными терминалами
	* @param $objectClass     		string     	css-класс выдаваемого html-объекта
	* @param $fieldName     		string     	название поля для выбора терминала
	* @param $commentFieldId   		string     	ID поля с комментарием
	* @param $sclass   				string     	название класса select-а (используется в javascript-е qp_select_select и qp_select_select_map)
	*/
	public function getDrop( $objectClass, $fieldName, $commentFieldId, $sclass='qp_select_select' )
	{		$this->fieldName = $fieldName;		$options = '';		foreach ( $this->data->machine as $row )
		{			//if ( $row->town == $this->town )
				$options .= '<option value="'.$row->name.'">'.$row->name.', '.$row->town.', '.$row->street.' '.$row->buildingnumber.'</option>';
		}
		return self::getScripts( $commentFieldId ).'<select name="'.$this->fieldName.'" class="'.$objectClass.' '.$sclass.'">'.$options.'</select>';	}

	/**
	* Выдает html-код списка с информацией о доступных терминалах в виде таблицы
	* @param $objectClass     		string     	css-класс выдаваемого html-объекта
	* @param $fieldName     		string     	название поля для выбора терминала
	* @param $commentFieldId   		string     	ID поля с комментарием
	*/
	public function getTable( $objectClass, $fieldName, $commentFieldId )
	{		$this->fieldName = $fieldName;
		$options = '';
		foreach ( $this->data->machine as $row )
		{
			//if ( $row->town == $this->town )
				$options .= '<tr class="highlight">
					<td>
						<input type="radio" id="'.$this->fieldName.'_id" value="'.$row->name.'" name="'.$this->fieldName.'" class="qp_radio_select">
					</td>
					<td>
						<label for="qiwipost.'.$row->name.'">QiwiPost '.$row->name.' '.$row->town.', '.$row->street.' '.$row->buildingnumber.'</label>
					</td>
					<td style="text-align: right;">
						<label for="qiwipost.'.$row->name.'">'.$this->price.'</label>
					</td>
				</tr>';
		}
		return self::getScripts( $commentFieldId ).'<table class="'.$objectClass.'">'.$options.'</table>';
	}

	/**
	* Выдает html-код выпадающего списка доступных терминалов с возможностью выбора на карте
	* @param $objectClass     		string     	css-класс выдаваемого html-объекта
	* @param $fieldName     		string     	название поля для выбора терминала
	* @param $commentFieldId   		string     	ID поля с комментарием
	* @param $buttonType   			string     	тип ссылки на карту: button (кнопка), image (рисунок). По-умолчанию - ссылка.
	* @param $buttonText   			string     	Текст кнопки или ссылки. Если тип - image, то в данный параметр необходимо передать адрес, где лежит изображение
	*/
	public function getDropWithMap( $objectClass, $fieldName, $commentFieldId, $buttonType, $buttonText )
	{		$this->fieldName = $fieldName;
		return '<script type="text/javascript" src="http://qiwipost.ru/widget/dropdown.php?dropdown_name='.$this->fieldName.'&encoding=utf-8"></script>'.self::getDrop( $objectClass, $this->fieldName, $commentFieldId, 'qp_select_select_map' ).self::getButton( $buttonType, $buttonText );
	}

	/**
	* Выдает список подгружаемых скриптов
	* @param $commentFieldId    string     	ID поля с комментарием
	*/
	private function getScripts( $commentFieldId )
	{		return ( $this->jquery ? '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>' : '' ).'<script type="text/javascript" src="'.$this->folder.'qpwidget.js"></script><input type="hidden" id="qp_commentFieldId" value="'.htmlspecialchars( $commentFieldId ).'"><input type="hidden" id="qp_mess_template" value="'.$this->mess_template.'">';	}

	/**
	* Выдает html-код кнопки для отображения карты
	* @param $commentFieldId   		string     	ID поля с комментарием
	* @param $type     				string     	тип: button (кнопка), image (рисунок). По-умолчанию - ссылка.
	* @param $text     				string     	Текст кнопки или ссылки. Если тип - image, то в данный параметр необходимо передать адрес, где лежит изображение
	*/
	private function getButton( $type, $text )
	{		$button = '';
		switch ( $type )
		{			case 'button':
				$button = '<input type="button" class="qp_map" value="'.htmlspecialchars( !empty( $text ) ? $text : 'Показать на карте' ).'">';
				break;

			case 'image':
				$button = '<img src="'.( !empty( $text ) ? $text : '/' ).'" class="qp_map">';
				break;

			default:
				$button = '<a class="qp_map" href="javascript:void(0);">'.( !empty( $text ) ? $text : 'Показать на карте' ).'</a>';		}

		return $button;	}

	/**
	* Выдает html-код кнопки/ссылки для выбора терминала на карте
	* @param $commentFieldId   		string     	ID поля с комментарием
	* @param $buttonType   			string     	тип ссылки на карту: button (кнопка), image (рисунок). По-умолчанию - ссылка.
	* @param $buttonText   			string     	Текст кнопки или ссылки. Если тип - image, то в данный параметр необходимо передать адрес, где лежит изображение
	*/
	public function getMapButton( $commentFieldId, $buttonType, $buttonText )
	{
		$this->fieldName = $fieldName;
		return '<script type="text/javascript" src="http://qiwipost.ru/widget/dropdown.php?dropdown_name=qp_machine"></script><div style="display: none;">'.self::getDrop( '', 'qp_machine', $commentFieldId, 'qp_select_select_map' ).'</div>'.self::getButton( $buttonType, $buttonText );
	}}
?>