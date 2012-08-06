#Подключение
Чтобы использовать класс, его необходимо первоначально подключить.

`
	include( 'qpwidget.php' );
	$qp = new QPWidget( '89991234567', '123456', '100 руб.', 0 );
`	
	
* *89991234567* - номер телефона для авторизации
* *123456* - пароль для авторизации
* *100 руб.* - стоимость доставки
* *0* - реальный доступ (не тестовый)

#Список терминалов в виде выпадающего списка

Метод getDrop возвращает html-код выпадающего списка.

`
	echo $qp->getDrop( 'my_select', 'machine', 'comment' );
`	

* *my_select* - css-класс html-объекта (атрибут class)
* *machine* - название html-объекта (атрибут name)
* *comment* - ID html-поля на форме с комментарием (в это поле будет автоматически добавлен ИД терминала)

#Список терминалов в виде выпадающего списка с картой

Метод getDropWithMap возвращает html-код выпадающего списка + ссылку на окно с картой для выбора терминала. Ссылка может быть в виде кнопки (тип button), картинки (тип image) или текстовой ссылки (тип link по-умолчанию).

`	
	echo $qp->getDropWithMap( 'my_select_map', 'machine_map', 'comment', 'button', 'Показать карту' );
`

* *my_select_map* - css-класс html-объекта (атрибут class)
* *machine_map* - название html-объекта (атрибут name)
* *comment* - ID html-поля на форме с комментарием (в это поле будет автоматически добавлен ИД терминала)
* *button* - тип ссылки на карту
* *Показать карту* - текст ссылки на карту


#Список терминалов в виде раскрытого списка (таблица)

Метод getTable возвращает html-код раскрытого списка.

`
	echo $qp->getTable( 'my_list', 'machine_list', 'comment' );
`	

* *my_list* - css-класс html-объекта (атрибут class)
* *machine_list* - название html-объекта (атрибут name)
* *comment* - ID html-поля на форме с комментарием (в это поле будет автоматически добавлен ИД терминала)

