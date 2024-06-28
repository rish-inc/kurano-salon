window.addEventListener( 'load', function ( e ) {
	const updateButton = document.querySelector( '.editor-post-publish-button__button' );
	updateButton.addEventListener( 'click', function ( e ) {
		const error_statuses = [];
		const error_flg = [];
		for ( let index = 0; index < datas.length; index++ ) {
			let postbox = document.querySelector( '#customer_data' + index );
			let field_items = postbox.querySelectorAll( '.customer_form_field__multibox__item' );
			let error_date = postbox.querySelector( '.is-date' );
			let error_menus = postbox.querySelectorAll( '.is-staff' );
			let selectorStaffs = postbox.querySelectorAll( '.js-menu-staff' );
			if ( ! postbox.classList.contains( 'closed' ) ) {
				error_statuses.push( validateTime ( postbox, error_date, index ) );
				for ( let item_count = 0; item_count < field_items.length; item_count++ ) {
					error_statuses.push( validateStaff( postbox, error_menus, index, field_items,  item_count ) );
				}
			}
		};
		if ( error_statuses.includes( 'error' ) ) {
			return false;
		}
	} );
} );

let validateTime = ( postbox, error_date, index ) => {
	let getTime = postbox.querySelector( 'input[name="customer_visit_datetime_customer_data_report' + index + '"]' );
	if ( ! getTime?.value ) {
		error_date.style.display = 'block';
		return 'error';
	} else {
		error_date.style.display = 'none';
		return 'success';
	}
}

let validateStaff = ( postbox, error_menus, index, field_items, item_count ) => {
	let item = postbox.querySelectorAll( '.customer_form_field__multibox__item' );
	let labels = field_items[ item_count ].querySelector( '.js-check-menu-title' );
	let selectors = field_items[ item_count ].querySelector( '.js-menu-staff' );
	for ( let i = 0; i < selectors.length; i++ ) {
		if ( labels.classList.contains( 'is-open' ) && selectors[i].selected ) {
			error_menus[item_count].style.display = 'block';
			return 'error';
		} else {
			error_menus[item_count].style.display = 'none';
			return 'success';
		}
	}
}
