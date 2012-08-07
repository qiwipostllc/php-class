<?php

include( '../qpwidget.php' );
$qp = new QPWidget( '', '', '150 руб.', 1, '../', 'Выбран терминал оплаты name', 1 );

$html = '';

$html .= '<div class="example">
	<h1>Выпадающий список с картой (кнопка image)</h1>'.$qp->getDropWithMap( 'my_select_map', 'machine2', 'comment2', 'image', 'map.png' ).'<br><textarea id="comment2" class="comment"></textarea></div>
	<h2>Код примера</h2>
	<div class="_4cs">
		<ol>
			<li class="li1"><div class="de1">include<span class="br0">(</span> \'qpwidget.<span class="me1">php</span>\' <span class="br0">)</span>;</div></li>
			<li class="li1"><div class="de1">&nbsp;</div></li>
			<li class="li1"><div class="de1">/**</div></li>
			<li class="li1"><div class="de1">* Инициализация объекта</div></li>
			<li class="li1"><div class="de1">* @param $phone &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; number &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Номер телефона для авторизации</div></li>
			<li class="li1"><div class="de1">* @param $passwd &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">string</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;пароль для авторизации</div></li>
			<li class="li1"><div class="de1">* @param $price &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">string</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Стоимость услуги, например, \'<span class="nu0">100</span> руб.\'</div></li>
			<li class="li1"><div class="de1">* @param $test &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; bool&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="nu0">1</span> - если тестовый доступ <span class="br0">(</span>в этом случае номер телефона и <li class="li1"><div class="de1">* @param $folder &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; string &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; относительный путь к папке с файлами</div></li>
			<li class="li1"><div class="de1">* @param $mess_template &nbsp; &nbsp; &nbsp; &nbsp; string &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Текст сообщения, которое вставляется автоматически в поле с комментарием после выбора терминала QiwiPost. Например: "Выбран терминал оплаты name", где name - будет заменено автоматически на ID терминала. Внимание, если в шаблоне сообщения не будет указан параметр name, то автоматически будет использован заданный по умолчанию шаблон.</div></li>
			<li class="li1"><div class="de1">* @param $jquery &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; bool &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="nu0">1</span> - необходимо подключить jquery, <span class="nu0">0</span> - не нужно подгружать библиотеку jquery, т.к. она уже загружена на странице</div></li>
			<li class="li1"><div class="de1">* @param $encode &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; string &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Кодировка, в которой будут загружены данные о терминалах через api QiwiPost</div></li>
			<li class="li1"><div class="de1">*/</div></li>
			<li class="li1"><div class="de1">$qp <span class="sy0">=</span> new QPWidget<span class="br0">(</span> \'\', \'\', \'<span class="nu0">150</span> руб.\', <span class="nu0">1</span>, \'\', \'Выбран терминал оплаты QiwiPost @name\', <span class="nu0">1</span>, \'utf-8\' <span class="br0">)</span>;</div></li>
			<li class="li1"><div class="de1">&nbsp;</div></li>
			<li class="li1"><div class="de1">/**</div></li>
			<li class="li1"><div class="de1">* Выдает html-код выпадающего списка доступных терминалов с возможностью выбора на карте</div></li>
			<li class="li1"><div class="de1">* @param $objectClass &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">string</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;css-класс выдаваемого html-объекта</div></li>
			<li class="li1"><div class="de1">* @param $fieldName &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">string</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;название поля для выбора терминала</div></li>
			<li class="li1"><div class="de1">* @param $commentFieldId &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">string</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ID поля с комментарием</div></li>
			<li class="li1"><div class="de1">* @param $buttonType &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">string</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;тип ссылки на карту: button <span class="br0">(</span>кнопка<span class="br0">)</span>, image <span class="br0">(</span>рисунок<span class="br0">)</span>. По-умолчанию - ссылка.</div></li>
			<li class="li1"><div class="de1">* @param $buttonText &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">string</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Текст кнопки или ссылки. Если тип - image, то в данный параметр необходимо передать адрес, где лежит изображение</div></li>
			<li class="li1"><div class="de1">*/</div></li>
			<li class="li1"><div class="de1">echo $qp-<span class="sy0">&gt;</span>getDropWithMap<span class="br0">(</span> \'my_select_map\', \'machine2\', \'comment2\', \'image\', \'map.<span class="me1">png</span>\' <span class="br0">)</span>;</div></li>
		</ol>
	</div>
	<div>
		<ul>
			<li><a href="example1.php">Пример 1 "Выпадающий список"</a></li>
			<li><a href="example2.php">Пример 2 "Выпадающий список с картой (кнопка button)"</a></li>
			<li><a href="example3.php">Пример 3 "Выпадающий список с картой (кнопка image)"</a></li>
			<li><a href="example4.php">Пример 4 "Выпадающий список с картой (ссылка)"</a></li>
			<li><a href="example5.php">Пример 5 "Раскрытый список в виде таблицы"</a></li>
			<li><a href="example6.php">Пример 6 "Ссылка на карту (кнопка button)"</a></li>
			<li><a href="example7.php">Пример 7 "Ссылка на карту (кнопка image)"</a></li>
			<li><a href="example8.php">Пример 8 "Ссылка на карту (ссылка)"</a></li>
			<li><a href="example9.php">Пример 9 "Совместное использование QiwiPost с другими способами доставки"</a></li>
		</ul>
	</div>
	<div>(C) 2012, Zoya Schegolihina <a href="mailto:zschegolihina@qiwipost.ru">zschegolihina@qiwipost.ru</a></div>
	<h2>Поддержка</h2>
	<div>По всем вопросам, связанным с поддежкой данного продукта Вы можете обратиться к его Автору или на адрес: <a href="mailto:support@qiwipost.ru">support@qiwipost.ru</a></div>';

echo '<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>PHP-widget QiwiPost - примеры</title>
		<style>
			body { font-family: Arial; font-size: 10pt; color: #222222; }
			code { display: block; margin: 10px 0px 10px 0px; padding: 5px 0px 5px 15px; border-width: 0px 0px 0px 5px; border-color: #aaaaaa; border-style: solid; }
			.comment { width: 500px; height: 150px; }
			.example { margin: 0px 0px 20px 0px; }
		</style>
		<link href="geshi.css" rel="stylesheet">
	</head>
	<body>'.$html.'</body>
</html>';

?>