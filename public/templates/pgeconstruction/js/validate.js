$(function (){
  
	// FORMS validate	
	// Загрузка файлов
	var types = ['pdf','jpg','jpeg','png','svg','webp','doc','docx','xls','xlsx','ppt','pptx','txt','psd','ai','cwd','zip','rar'];
	joinedTypes = types.join(', ');
	newFileItem = '<div class="attach__item"><label><div class="attach__up"><span>'+$('.attach').data('title')+'</span></div><input class="attach__input" type="file" name="userfile[]" /></label><div class="attach__name"></div><div class="attach__delete"></div></div>'; // разметка нового поля
	newUserFile = '<input class="attach__input" type="file" name="userfile[]">'; // разметка нового поля
	$('.file_error span').text(joinedTypes);
	$('.attach').each(function() { // на случай, если таких групп файлов будет больше одной
	  var attach = $(this),
		fieldClass = 'attach__item', // класс поля
		attachedClass = 'attach__item--attached', // класс поля с файлом
		fields = attach.find('.' + fieldClass).length, // начальное кол-во полей
		fieldsAttached = 0; // начальное кол-во полей с файлами

	  // При изменении инпута
	  attach.on('change', '.attach__input', function(e) {		
		var item = $(this).closest('.' + fieldClass),
		  fileName = '',
		  r = false;
		if (e.target.value) { // если value инпута не пустое
		  fileName = e.target.value.split('\\').pop(); // оставляем только имя файла и записываем в переменную
			var file_type = e.target.value.split('.').pop(); // оставляем только имя файла и записываем в переменную
			r = types.includes(file_type);
		}
		if (fileName) { // если имя файла не пустое
		  item.find('.attach__name').text(fileName); // подставляем в поле имя файла
		  if (!item.hasClass(attachedClass)) { // если в поле до этого не было файла
			item.addClass(attachedClass); // отмечаем поле классом
			fieldsAttached++;
		  }
		  if (fields < 3 && fields == fieldsAttached) { // если полей меньше 10 и кол-во полей равно
			item.after($(newFileItem)); // добавляем новое поле
			fields++;
		  }		  
		  if(!r){
			 item.find('.attach__delete').trigger('click');
			 $('.file_error').show();
		  }
			
		} else { // если имя файла пустое
		  if (fields == fieldsAttached + 1) {
			item.remove(); // удаляем поле
			fields--;
		  } else {
			item.replaceWith($(newFileItem)); // заменяем поле на "чистое"
		  }
		  fieldsAttached--;

		  if (fields == 1) { // если поле осталось одно
			attach.find('.attach__up span').text(attach.data('title')); // меняем текст
		  }
		}
	  });

	  // При нажатии на "DOŁĄCZ PLIK"
	  attach.on('click', '.attach__up', function() {
		$('.file_error').hide();
	  });

	  // При нажатии на "Изменить"
	  attach.on('click', '.attach__edit', function() {
		$('.file_error').hide();
		$(this).closest('.attach__item').find('.attach__input').trigger('click'); // имитируем клик на инпут
	  });

	  // При нажатии на "Удалить"
	  attach.on('click', '.attach__delete', function() {
		$('.file_error').hide();
		var item = $(this).closest('.' + fieldClass);
		if (fields > fieldsAttached) { // если полей больше, чем загруженных файлов
		  item.remove(); // удаляем поле
		  fields--;
		} else { // если равно
		  attach.append($(newFileItem)); // добавляем новое поле
		  item.remove(); // удаляем старое
		}
		fieldsAttached--;
		if (fields == 1) { // если поле осталось одно
		  attach.find('.attach__up span').text(attach.data('title')); // меняем текст
		}
	  });
	});
	
  // Validate
  $('[data-submit]').on('click', function (e){
    e.preventDefault();
    $(this).hasId('contact').submit();
  })
  
	// Текст maxlength 2000 (без учета пробелов)
	$( '[name="message"]' ).each(function( index ) {
		var this_massage = $(this);
		var max_chr_cnt = this_massage.data('max') || 2000;
		var ctrlDown = false;	
		function clear_chr(el, max){
			max = max - 1;
			let L = el.val().substr(0, max);
			if(L.replace(/\s/g, '').length>max_chr_cnt){
				clear_chr(el, max);
			} else {
				el.val(L);
				return false;
			}	
		}
		
		this_massage.keydown(function(e) {
			if (e.keyCode == 17 || e.keyCode == 91) ctrlDown = true;
		}).keyup(function(e) {
			if (e.keyCode == 17 || e.keyCode == 91) ctrlDown = false;
		});	
		this_massage.on('keydown', function (e){
			let l = this_massage.val().replace(/\s/g, '').length;
			if (l >= max_chr_cnt) {
				if (
					   e.keyCode != 8 
					&& e.keyCode != 16 
					&& e.keyCode != 17 
					&& e.keyCode != 46 
					&& e.keyCode != 33 
					&& e.keyCode != 34 
					&& e.keyCode != 35 
					&& e.keyCode != 36 
					&& e.keyCode != 37 
					&& e.keyCode != 38 
					&& e.keyCode != 39 
					&& e.keyCode != 40
					&& (!ctrlDown || (e.keyCode != 65))
					&& (!ctrlDown || (e.keyCode != 67))
					&& (!ctrlDown || (e.keyCode != 86))
					&& (!ctrlDown || (e.keyCode != 88))
					){
						e.preventDefault();
				}
			}
		});  
		this_massage.on('keyup', function (e){
			let l = this_massage.val().replace(/\s/g, '').length;
			if (l < max_chr_cnt) { 
				this_massage.next('.massage__chr_cnt').text(l+'/'+(this_massage.data('max') || 2000));
				this_massage.next('.massage__chr_cnt').removeClass('chr_red');
			} else {
				this_massage.next('.massage__chr_cnt').text(max_chr_cnt+'/'+(this_massage.data('max') || 2000));
				this_massage.next('.massage__chr_cnt').addClass('chr_red');
				let el = this_massage;
				clear_chr(el, max_chr_cnt+600);
				e.preventDefault();
			}
			this_massage.next('.massage__chr_cnt').show();
		});
	});
  
  $.validator.addMethod("regex", function(value, element, regexp) {
    var re = new RegExp(regexp);
    return this.optional(element) || re.test(value);
    },
    "Check input fields"
  );
  
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var lang_errors = [];
	var lang = $('html').attr('lang');
		if(!lang) lang = 'pl';
	lang_errors['pl'] = {
		firstName: {
			required: 'Pole nie może być puste',
			regex: 'Podaj poprawne Imię',
			minlength: 'Wpisz co najmniej 2 znaki',
			maxlength: 'Wpisz nie więcej niż 40 znaków',
		},
		phone: {
			required: 'Pole nie może być puste',
			regex: 'Wpisz poprawny numer telefonu',
			minlength: 'Wpisz co najmniej 9 znaków',
			maxlength: 'Wpisz nie więcej niż 15 znaków',
		},
		email: {
			required: 'Pole wymagane',
			email: 'Proszę wpisać aktualny adres e-mail'
		},
		policy: {
			required: 'Pole wymagane',
		},
		checkbox: {
			required: 'Pole wymagane',
		}
	};
	lang_errors['en'] = {
		firstName: {
			required: 'The field cannot be empty',
			regex: 'Enter a valid Name',
			minlength: 'Enter at least 2 characters',
			maxlength: 'Enter no more than 40 characters',
		},
		phone: {
			required: 'The field cannot be empty',
			regex: 'Enter a valid phone number',
			minlength: 'Enter at least 9 characters',
			maxlength: 'Enter no more than 15 characters',
		},
		email: {
			required: 'Required field',
			email: 'Please enter a valid email address'
		},
		policy: {
			required: 'Required field',
		},
		checkbox: {
			required: 'Required field',
		}
	};
	lang_errors['de'] = {
		firstName: {
			required: 'Das Feld darf nicht leer sein',
			regex: 'Geben Sie einen gültigen Namen ein',
			minlength: 'Geben Sie mindestens 2 Zeichen ein',
			maxlength: 'Geben Sie nicht mehr als 40 Zeichen ein',
		},
		phone: {
			required: 'Das Feld darf nicht leer sein',
			regex: 'Geben Sie eine gültige Telefonnummer ein',
			minlength: 'Geben Sie mindestens 9 Zeichen ein',
			maxlength: 'Geben Sie nicht mehr als 15 Zeichen ein',
		},
		email: {
			required: 'Pflichtfeld',
			email: 'Bitte geben Sie eine gültige E-Mail-Adresse ein'
		},
		policy: {
			required: 'Pflichtfeld',
		},
		checkbox: {
			required: 'Pflichtfeld',
		}
	};

  function valEl(el) {
    el.validate({
      rules: {
        phoneNumber: {
          required: true,
          regex: "[0-9]+",
          minlength: 9,
          maxlength: 15
        },
		
        phone: {
          required: true,
          regex: "[0-9]+",
          minlength: 9,
          maxlength: 15
        },

        polityka: {
          required: true
        },

        checkbox1: {
          required: true
        },

        checkbox4: {
          required: true
        },

        firstName: {
          required : true,
          regex: "[A-Za-zА-Яа-я]",
          minlength: 2,
          maxlength: 40
        },

        email: {
          required: true
        }
      },
  
      messages: {
        firstName: {
			required: lang_errors[lang].firstName.required,
			regex: lang_errors[lang].firstName.regex,
			minlength: lang_errors[lang].firstName.minlength,
			maxlength: lang_errors[lang].firstName.maxlength
        },
        lastName: {
			required: lang_errors[lang].firstName.required,
			regex: lang_errors[lang].firstName.regex,
			minlength: lang_errors[lang].firstName.minlength,
			maxlength: lang_errors[lang].firstName.maxlength
        },
		phone: {
			required: lang_errors[lang].phone.required,
			regex: lang_errors[lang].phone.regex,
			minlength: lang_errors[lang].phone.minlength,
			maxlength: lang_errors[lang].phone.maxlength
		},
		email: {
			required: lang_errors[lang].email.required,
			required: lang_errors[lang].email.email
		},
		policy: {
			required: lang_errors[lang].policy.required
		},
        phoneNumber: {
			required: lang_errors[lang].phone.required,
			regex: lang_errors[lang].phone.regex,
			minlength: lang_errors[lang].phone.minlength,
			maxlength: lang_errors[lang].phone.maxlength
        },
        polityka: {
			required: lang_errors[lang].policy.required
        },
        checkbox1: {
			required: lang_errors[lang].policy.required
        },
        checkbox4: {
			required: lang_errors[lang].policy.required
        },
        add_check_1: {
			required: lang_errors[lang].policy.required
        },
        add_check_2: {
			required: lang_errors[lang].policy.required
        }
      },
  
      submitHandler: function(form) {
        let $form = $(form);
            $form.addClass('sending');
			$form.find('.attach__item').each(function() {
				/*if(!$(this).hasClass('attach__item--attached')){
					$(this).find('.attach__input').remove();
				}*/
			});
			
		setTimeout(function(){                
			$.ajax({
			  type: 'POST',
			  url: $form.attr('action'),
			  data: new FormData($form[0]),
			  async: false, 
			  cache: false, 
			  contentType: false, 
			  processData: false, 
			})
			.done(function(){
			  // console.log('Sucsess');
			})
			.fail(function(){
			  // console.log('Fail');
			})
			.always(function(data_result){
			  console.log(data_result);
			  
				  setTimeout(function(){
					if(data_result == 'send'){
						
						$form.trigger('reset');
						if($('.attach').length > 0){
							$form.find('.attach__item.attach__item--attached .attach__delete').each(function() {
								$(this).trigger('click');
							});
							if(!$('.attach').hasClass('.attach__item') && $('.attach').find('.attach__input').length==0){
								$('.attach').find('label').append($(newUserFile));
							}
						}
						
						/*$.fancybox.open('#thx');
						setTimeout(function(){ 
							$('.fancybox-close').trigger('click');
						}, 3000);*/
						$form.addClass('sended');
						setTimeout(function(){ 
							$form.removeClass('sending');
							$form.removeClass('sended');
							if($form.attr('id')){
								// gtag('event', $form.attr('id')+'_send');
								//console.log('event: '+$form.attr('id')+'_send');
							}
						}, 3000);
					} else {
						//$.fancybox.open('#error');
						$form.addClass('sendError');
						setTimeout(function(){ 
							$form.removeClass('sending');
							$form.removeClass('sendError');
							if($form.attr('id')){
								// gtag('event', $form.attr('id')+'_no_send');
								//console.log('event: '+$form.attr('id')+'_no_send');
							}
						}, 3000)
					}
					
				  }, 700);
			});
			
		}, 100);
            
        return false;
      }
    });
  };
  $('.js-form').each(function() {
    valEl($(this));
  });
  });