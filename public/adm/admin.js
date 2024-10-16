$(document).ready(function(){
	
	if ($('.editor').length>0){
		$('.editor').each(function(e){
			var h = '450';
			if($(this).data('h')){
				h = $(this).data('h');
			}
			h +='px';
			CKEDITOR.replace( this.id, { 
				height: h,
				extraPlugins:'justify',
				allowedContent: true,
				filebrowserBrowseUrl: "/ckfinder/browser?Type=Files",
				filebrowserImageBrowseUrl: "/ckfinder/browser?Type=Images",
				filebrowserFlashBrowseUrl: "/ckfinder/browser?Type=Flash",
				filebrowserUploadUrl: "/ckfinder/connector?command=QuickUpload&type=Files",
				filebrowserImageUploadUrl: "/ckfinder/connector?command=QuickUpload&type=Images",
				filebrowserFlashUploadUrl: "/ckfinder/connector?command=QuickUpload&type=Flash"
			});
		});
	}
	
	// Загрузчик файлов
	function selectFileWithCKFinder( elementId ) {
		CKFinder.config( { connectorPath: '/ckfinder/connector' } );
		CKFinder.popup( {
			chooseFiles: true,
			width: 800,
			height: 600,
			onInit: function( finder ) {
				finder.on( 'files:choose', function( evt ) {
					var file = evt.data.files.first();
					/*var output = document.getElementById( elementId );
					output.value = file.getUrl();*/
					elementId.val(file.getUrl());
				} );
				finder.on( 'file:choose:resizedImage', function( evt ) {
					/*var output = document.getElementById( elementId );
					output.value = evt.data.resizedUrl;*/
					elementId.val(evt.data.resizedUrl);
				} );
			}
		} );
	}
	$(document).on('click', '.ckfinder-modal-button', function(e) {	
	  e.preventDefault();
	  input = $(this).closest('.input-group').find(".ckfinder-input");
	  selectFileWithCKFinder( input );
	});
	
	//Initialize File Elements
	bsCustomFileInput.init();
	
    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
	
	$(".milti_select2").select2({
		tags: true,
		tokenSeparators: [',']
	})
	
	//Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
	
    $('[data-event_time]').inputmask('9999-99-99 99:99:99', { 'placeholder': '2021-12-31 15:30:00' })

    //Timepicker
    $('#created_at').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss',
	  sideBySide: true
    });
    $('#event_date_start').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss',
	  sideBySide: true
    });
    $('#event_date_end').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss',
	  sideBySide: true
    });
    $('#tender_done').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss',
	  sideBySide: true
    });
    $('#tender_bid_date_start').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss',
	  sideBySide: true
    });
    $('#tender_bid_date_end').datetimepicker({
      format: 'YYYY-MM-DD HH:mm:ss',
	  sideBySide: true
    });
	
	if($('#reservationtime').length>0){
		var start = $('#date_start').val();
		var end = $('#date_end').val();
		function cb(start, end) {
		  //$('#reservationtime span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
		  $('#date_start').val(start.format('YYYY-MM-DD'));
		  $('#date_end').val(end.format('YYYY-MM-DD'));
		}
		$('#reservationtime').daterangepicker({
		  startDate: new Date(start),
		  endDate: new Date(end),
		  locale: {
				"format": 'YYYY-MM-DD',
				"applyLabel": "Ок",
				"cancelLabel": "Отмена",
				"fromLabel": "От",
				"toLabel": "До",
				"customRangeLabel": "Произвольный",
				"daysOfWeek": [
					"Вс",
					"Пн",
					"Вт",
					"Ср",
					"Чт",
					"Пт",
					"Сб"
				],
				"monthNames": [
					"Январь",
					"Февраль",
					"Март",
					"Апрель",
					"Май",
					"Июнь",
					"Июль",
					"Август",
					"Сентябрь",
					"Октябрь",
					"Ноябрь",
					"Декабрь"
				],
				firstDay: 1
			},
		  ranges: {
			 'Сегодня': [moment(), moment()],
			 'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			 'Посление 7 дней': [moment().subtract(6, 'days'), moment()],
			 'Посление 30 дней': [moment().subtract(29, 'days'), moment()],
			 'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
			 'Прошлый месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		  }
		},cb);
		//cb(start, end);
		$('#reservationtime').on('apply.daterangepicker', function(ev, picker) {
			 $('#revisions_filter_form').submit();
		});
	}
	
	$('.to_page').on('click',function(e){
		var el_url = $(this).closest('.input-group').find('input[type="text"]');
		var path = el_url.data('add_path')+el_url.val();		
		$(this).attr('href','..'+path);		
	});
	$('.re_url').on('click',function(e){
		e.preventDefault();
		TR($(this).closest('.row').find('.name_field'));
		//.trigger('keyup');		
	});
	
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$('.ajax_check input[name="active"]').on('click',function(e){
		var id = $(this).closest('tr').data('id');
		var url = $(this).closest('tr').data('url');
		var data_type = $(this).closest('tr').data('type');
		var v = 0;
		if($(this).is(":checked")){
			v = 1;
		}
		var error = '';
		$.ajax({
            type: 'post',
            url: url,
            cache: false,
            data: {
                'id': id,
                'active': v,
                'update_type': 'ajax',
                'data_type': data_type,
                '_method': 'put',
                '_token': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(answ)
            {
                
				if(answ != 'ajax_update_active'){
					error = 'yes';
				}
            },
        });
	});

	$('.auto_verify').on('click',function(e){
		var _th = $(this);
		var id = $(this).closest('tr').data('id');
		var url = $(this).closest('tr').data('url');
		var error = '';
		$.ajax({
            type: 'post',
            url: url,
            cache: false,
            data: {
                'id': id,
                'auto_verify': 1,
                'update_type': 'ajax',
                '_method': 'put',
                '_token': $('meta[name="csrf-token"]').attr('content'),
            },
			beforeSend: function() {
				_th.closest('td').find('.auto_verify_label').hide();
				_th.closest('td').find('.auto_verify').hide();
				_th.closest('td').find('.auto_verify_loading').show();
			},
            success: function(answ)
            {
				if(answ != 'ajax_update_auto_verify'){
					error = 'yes';
				} else {
					_th.closest('td').find('.auto_verify_loading').hide();
					_th.closest('td').find('.auto_verify_ok').show();					
					_th.closest('tr').find('.ajax_check input:checkbox').attr('checked', true).trigger('refresh');
				}				
            },
        });
	});
	
	function generatepasswordword() {
		var length = 12,
			charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-!@#$%^&*",
			retVal = "";
		for (var i = 0, n = charset.length; i < length; ++i) {
			retVal += charset.charAt(Math.floor(Math.random() * n));
		}
		return retVal;
	}
	
	$('.auto_create_password').val(generatepasswordword());
	
	$('.no_submit').on('click', function(e){
		e.preventDefault();		
	});
	$('.create_password_key').on('click', function(e){
		e.preventDefault();		
		var p = generatepasswordword();
		$('.new_pass input').val(p);
		//console.log(p);
	});
	$('.create_new_pass').on('click', function(e){
		e.preventDefault();
		$(this).closest('div').find('.new_pass').removeClass('hide');
	});;
	$('.trigger_btn_save').on('click', function(e){
		e.preventDefault();
		$('.trigger_btn').trigger('click');		
	});	
	
	function TR(e){
		var w = e.val();
		w=w.toLowerCase();

		// polish
		w = w.replace('ą', 'a');
		w = w.replace('ć', 'c');
		w = w.replace('ę', 'e');
		w = w.replace('ł', 'l');
		w = w.replace('ń', 'n');
		w = w.replace('ó', 'o');
		w = w.replace('ś', 's');
		w = w.replace('ź', 'z');
		w = w.replace('ż', 'z');

		// german
		w = w.replace('ä', 'a');
		w = w.replace('ö', 'o');
		w = w.replace('ü', 'u');
		w = w.replace('ß', 's');

		// czech
		w = w.replace('á', 'a');
		w = w.replace('č', 'c');
		w = w.replace('ď', 'd');
		w = w.replace('é', 'e');
		w = w.replace('ě', 'e');
		w = w.replace('í', 'i');
		w = w.replace('ň', 'n');
		w = w.replace('ó', 'o');
		w = w.replace('ř', 'r');
		w = w.replace('š', 's');
		w = w.replace('ť', 't');
		w = w.replace('ú', 'u');
		w = w.replace('ů', 'u');
		w = w.replace('ý', 'y');
		w = w.replace('ž', 'z');

		// symbols
		w = w.replace('?', '');
		w = w.replace('вЂ“', '-');
		w = w.replace('в„–', 'n');
		w = w.replace('вЂ™', '');

		var v=0;
		var tr='a b v g d e ["zh","j"] z i y k l m n o p r s t u f h c ch sh ["shh","shch"] ~ y ~ e yu ya ~ ["jo","e"]'.split(' ');
		var ww=''; 
		for(i=0; i<w.length; ++i) {
			cc=w.charCodeAt(i); ch=(cc>=1072?tr[cc-1072]:w[i]);
			if(ch.length<3) ww+=ch; else ww+=eval(ch)[v];
		}
		
		var trn=ww.replace(/[^a-zA-Z0-9\-]/g,'-').replace(/[-]{2,}/gim, '-').replace( /^\-+/g, '').replace( /\-+$/g, '');
		if($('[name=url]').length>0){
			$('[name=url]').val(trn);
		}
		$('.duble_post_'+e.closest('.tab-pane').data('lang')).val(e.val());
		$('.duble_post_url_'+e.closest('.tab-pane').data('lang')).val(trn);
		$('.duble_post').val(e.val());
	}
	$('.create_post').on('keyup', function(){		
		TR($(this));		
	});
	
	// Сохранение
	$(document).on('click', '.form_zone button[type="submit"], .form_zone submit', function(e) {
		var c = 0;
		$('.form_zone *[required]').each(function(e){
			if($(this).val() == '' || $(this).val() == 0){
				c++;
			}
		});
		if($(this).hasClass('create_password_and_send_to_user')){
			var p = generatepasswordword();
			$('input[name="password"]').val(p);
			console.log(p);
			//return false;
		}
		if(c>0){
			console.log('Не заполненых полей: '+c);
		} else {		
			$('.form_zone > .content-header, .form_zone > .content').fadeOut(200);
			setTimeout(function(){
				$('.form_zone > .fz_loagind').fadeIn(200);
			}, 201);
		}
		
	});
	$(document).on('click', '.form_zone submit', function(e) {
		$(this).closest('form').submit();
	});
	
	
	
});