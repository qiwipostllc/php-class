<?php

include( '../qpwidget.php' );
$qp = new QPWidget( '', '', '150 руб.', 1, '../', 'Выбран терминал оплаты name', 1, 'utf-8' );

$html = '';

$html .= '<script type="text/javascript">
			function afterWindowLoad()
			{
				$( \'input[name="delivery"]\' ).bind( \'click\', function(){					if ( $( this ).val() == \'QiwiPost\' )
					{
						qpChangeStatus( 1 );
					}
					else
					{
						qpChangeStatus( 0 );
						qpDelQiwiPostInfo();
					}				});
			}
		</script>
		<div class="example">
		<h1>Совместное использование QiwiPost с другими способами доставки</h1>
		<div><input type="radio" name="delivery" value="QiwiPost" checked> '.$qp->getDropWithMap( 'my_select_map', 'machine2', 'comment2', 'button', 'Показать карту' ).' 100 руб.</div>
		<div><input type="radio" name="delivery" value="Почта России"> Почта России 200 руб.</div>
		<div><input type="radio" name="delivery" value="Курьер по Москве"> Курьер по Москве 300 руб.</div>
		<br><textarea id="comment2" class="comment"></textarea>
	</div>
	<h2>Код примера</h2>
	<div class="_4cs">
		<ol><li class="li1"><div class="de1"><span class="sy0">&lt;</span>script type<span class="sy0">=</span><span class="st0">"text/javascript"</span><span class="sy0">&gt;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; $<span class="br0">(</span> \'<span class="kw1">input</span><span class="br0">[</span>name<span class="sy0">=</span><span class="st0">"delivery"</span><span class="br0">]</span>\' <span class="br0">)</span>.<span class="me1">bind</span><span class="br0">(</span> \'click\', <span class="kw1">function</span><span class="br0">(</span><span class="br0">)</span><span class="br0">{</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">if</span> <span class="br0">(</span> $<span class="br0">(</span> this <span class="br0">)</span>.<span class="me1">val</span><span class="br0">(</span><span class="br0">)</span> <span class="sy0">==</span> \'QiwiPost\' <span class="br0">)</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; qpChangeStatus<span class="br0">(</span> <span class="nu0">1</span> <span class="br0">)</span>;&nbsp; &nbsp; <span class="co1">// сделать выпадающий список и кнопку активными</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="kw1">else</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">{</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; qpChangeStatus<span class="br0">(</span> <span class="nu0">0</span> <span class="br0">)</span>;&nbsp; &nbsp; <span class="co1">// дезактивировать выпадающий список и кнопку</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; qpDelQiwiPostInfo<span class="br0">(</span><span class="br0">)</span>;&nbsp; &nbsp; <span class="co1">// удалить информацию о QiwiPost из комментария</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">}</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="br0">}</span><span class="br0">)</span>;</div></li>
<li class="li1"><div class="de1"><span class="sy0">&lt;</span>/script<span class="sy0">&gt;</span></div></li>
<li class="li1"><div class="de1"><span class="sy0">&lt;</span>div<span class="sy0">&gt;</span></div></li>
<li class="li1"><div class="de1">&nbsp; &nbsp; &nbsp; &nbsp; <span class="sy0">&lt;</span><span class="kw1">input</span> type<span class="sy0">=</span><span class="st0">"radio"</span> name<span class="sy0">=</span><span class="st0">"delivery"</span> value<span class="sy0">=</span><span class="st0">"QiwiPost"</span> checked<span class="sy0">&gt;</span> <span class="sy0">&lt;</span>!-- здесь вставляется код, выдаваемый одним из методов QPWidget-класса --<span class="sy0">&gt;</span>QiwiPost <span class="nu0">100</span> руб.</div></li>
<li class="li1"><div class="de1"><span class="sy0">&lt;</span>/div<span class="sy0">&gt;</span></div></li>
<li class="li1"><div class="de1"><span class="sy0">&lt;</span>div<span class="sy0">&gt;&lt;</span><span class="kw1">input</span> type<span class="sy0">=</span><span class="st0">"radio"</span> name<span class="sy0">=</span><span class="st0">"delivery"</span> value<span class="sy0">=</span><span class="st0">"Почта России"</span><span class="sy0">&gt;</span> Почта России <span class="nu0">200</span> руб.<span class="sy0">&lt;</span>/div<span class="sy0">&gt;</span></div></li>
<li class="li1"><div class="de1"><span class="sy0">&lt;</span>div<span class="sy0">&gt;&lt;</span><span class="kw1">input</span> type<span class="sy0">=</span><span class="st0">"radio"</span> name<span class="sy0">=</span><span class="st0">"delivery"</span> value<span class="sy0">=</span><span class="st0">"Курьер по Москве"</span><span class="sy0">&gt;</span> Курьер по Москве <span class="nu0">300</span> руб.<span class="sy0">&lt;</span>/div<span class="sy0">&gt;</span></div></li>
<li class="li1"><div class="de1"><span class="sy0">&lt;</span>div<span class="sy0">&gt;&lt;</span>textarea id<span class="sy0">=</span><span class="st0">"comment2"</span> class<span class="sy0">=</span><span class="st0">"comment"</span><span class="sy0">&gt;&lt;</span>/textarea<span class="sy0">&gt;&lt;</span>/div<span class="sy0">&gt;</span></div></li>
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
	<body onload="afterWindowLoad();">'.$html.'</body>
</html>';

?>